<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use Hash;
use App\Student;
use PDF;

class StudentController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function index()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('students')
                ->select('students.*')
                ->where(['id'=> $userid])
                ->first();
        return view('student.stud-home', ['profile' => $profile]);
    }

    public function profile()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('students')
                ->select('students.*')
                ->where(['id'=> $userid])
                ->first();
        return view('student.stud-profile', ['profile' => $profile]);
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request,[
            'phonenumber' => 'string|max:20',
            'email' => 'string|email|max:255',
        ]);

        $userid = Auth::user()->id;
        $phonenumber = $request->input('phonenumber');
        $email = $request->input('email');
        DB::update('UPDATE students SET email=?, contact=?, updated_at=now() WHERE id=?', [$email, $phonenumber, $userid]);
        return redirect()->back()->with("success","You have successfully updated your personal info.");
    }

    public function passwordchange()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('students')
                ->select('students.*')
                ->where(['id'=> $userid])
                ->first();
        return view('student.stud-passchg', ['profile' => $profile]);
    }

    public function changePassword (Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }

    public function qrshow()
    {
        $currentuser = Auth::user()->id;
        $profile = DB::table('students')
                ->select('students.*')
                ->where(['id'=> $currentuser])
                ->first();
        $qrdata = DB::select(DB::raw("SELECT * FROM studentxmodules WHERE studentid = '$currentuser'"));
        return view('student.stud-qr', ['profile' => $profile], ['qrdata' => $qrdata]);
    }

    public function showattendance()
    {
        $currentuser = Auth::user()->id;
        $profile = DB::table('students')
                ->select('students.*')
                ->where(['id'=> $currentuser])
                ->first();
        $data ['data'] = DB::select(DB::raw("SELECT M.id, M.modname, M.modstatus, M.moddesc, M.modtime, SXM.smgroup, SXM.status, SXM.time, SXM.smsession, U.name, U.id FROM modules M JOIN studentxmodules SXM ON M.id = SXM.modid JOIN students U ON U.id = SXM.studentid WHERE U.id = '$currentuser' AND YEAR(SXM.time) = YEAR(CURDATE())"));
        $modNo = DB::select(DB::raw("SELECT * FROM modules"));
        return view('student.stud-attendance', $data, ['profile' => $profile])->with(compact('modNo'));
    }

    public function downloadPDF($id)
    {
        $user = Student::find($id);
        $currentuser = Auth::user()->id;
        $profile = DB::table('students')
                ->select('students.*')
                ->where(['id'=> $currentuser])
                ->first();
        $data ['data'] = DB::select(DB::raw("SELECT M.id, M.modname, M.modstatus, M.moddesc, M.modtime, SXM.smgroup, SXM.status, SXM.time, SXM.smsession, SXM.remark, U.name, U.id FROM modules M JOIN studentxmodules SXM ON M.id = SXM.modid JOIN students U ON U.id = SXM.studentid WHERE U.id = '$currentuser' AND YEAR(SXM.time) = YEAR(CURDATE())"));

       $pdf = \PDF::loadView('student.stud-print_Att', $data, ['profile' => $profile]);
        return $pdf->stream();
    }

    public function showmodule()
    {
        $currentuser = Auth::user()->id;
        $profile = DB::table('students')
                ->select('students.*')
                ->where(['id'=> $currentuser])
                ->first();
        $data['data'] = DB::SELECT(DB::RAW("SELECT * FROM modules m, studentxmodules sm, modulexstaff ms, tempat t WHERE m.id = sm.modid AND sm.studentid='$currentuser' AND sm.smyear=YEAR(NOW()) AND sm.status IS NULL AND sm.created_at=(SELECT MAX(created_at) FROM studentxmodules WHERE studentid='$currentuser' AND smyear=YEAR(NOW())) AND sm.smgroup=ms.msgroup and ms.msplace=t.id"));// DB::select(DB::raw("SELECT * FROM modules m JOIN studentxmodules sm WHERE m.id = sm.modid AND sm.studentid='$currentuser' AND sm.smyear=YEAR(NOW()) AND  sm.status IS NULL AND sm.created_at=(SELECT MAX(created_at) FROM studentxmodules WHERE studentid='$currentuser' AND smyear=YEAR(NOW()))"));

        return view('student.stud-module', $data, ['profile' => $profile]);
    }

    public function showsurveys()
    {
        $currentuser = Auth::user()->id;
        $profile = DB::table('students')
                ->select('students.*')
                ->where(['id'=> $currentuser])
                ->first();
        
        //$data ['data'] = DB::select(DB::raw("SELECT M.id, M.modname, M.modstatus, M.moddesc, M.modtime, SXM.smgroup, SXM.status, SXM.time, SXM.smsession, U.name, U.id FROM modules M JOIN studentxmodules SXM ON M.id = SXM.modid JOIN students U ON U.id = SXM.studentid WHERE U.id = '$currentuser' AND YEAR(SXM.time) = YEAR(CURDATE())"));
        
        //ambik module apa dia kena dtg. lepastu foreach, dlm foreach, kira berapa kali dia dtg. if == 2, select survey id where moduleid = ...
         $a = DB::select(DB::raw("SELECT DISTINCT modid FROM studentxmodules where studentid='$currentuser' ORDER BY created_at DESC limit 1"));

        if(count($a) == 0) {
            return view('student.stud-survey', ['profile' => $profile]);
        }
        else {
            foreach ($a as $b) {
                $modid = $b->modid;
            }

            $c = DB::select(DB::raw("SELECT * from studentxmodules where studentid='$currentuser' AND modid='$modid' AND status='ATTENDED'"));

            $d = count($c);

            if($d == 2) {
                $e = DB::select(DB::raw("SELECT * FROM surveys WHERE id = (SELECT surveyid FROM modules WHERE id='$modid')"));
            }
            else {
                return view('student.stud-survey', ['profile' => $profile])->with("Only attended once");
            }

            //return view('student.stud-survey', ['profile' => $profile])->with(['e' => $e]);

            //check DB
            $check = DB::SELECT(DB::RAW("SELECT * FROM responses where studentid='$currentuser' AND modid='$modid'"));

            if(count($check) > 0) {
                return view('student.stud-survey', ['profile' => $profile]);

            }
            else {
                return view('student.stud-survey', ['profile' => $profile])->with(['e' => $e]);
            }


        }
        
    }

    public function survey($id)
    {
        $currentuser = Auth::user()->id;
        $profile = DB::table('students')->select('students.*')->where(['id'=> $currentuser])->first();
        $sname = DB::table('surveys')->select('surveys.*')->where(['id' => $id])->first();
        $surveyd['surveyd'] = DB::SELECT(DB::RAW("SELECT * FROM surveys WHERE id='$id'"));

        $soalan = DB::select(DB::raw("SELECT m.id AS modid, m.surveyid, sq.id, sq.qid, q.quests, q.typequest FROM modules m, surveyxquest sq, questions q WHERE m.surveyid = sq.surveyid AND sq.qid = q.id AND sq.surveyid = '$id' ORDER BY sq.qid"));
        return view('student.stud-surveyQ',  ['profile' => $profile])->with(compact('sname'))->with(['soalan' => $soalan]);
        
    }

    public function soalan(Request $request)
    {
        $currentuser = Auth::user()->id;
        $profile = DB::table('students')->select('students.*')->where(['id'=> $currentuser])->first();
        $jawapan = Input::get('jawapan');
        $soalan = Input::get('soalan');
        $surveyid = Input::get('surveyid');
        $modid = Input::get('modid');

        if(!empty($jawapan))
        {
            $data = DB::select(DB::raw("SELECT * FROM surveyxquest sq, questions q WHERE sq.qid = q.id AND sq.surveyid = '$surveyid'"));
            $a = count($data);
            $jawapan1 = array();
            $soalan1 = array();

            foreach ($jawapan as $j) {
                $jawapan1[] = $j;
            }

            foreach ($soalan as $s) {
                $soalan1[] = $s;
            }

            for($i=0;$i<$a;$i++) {
                $j1 = $jawapan1[$i];
                $s1 = $soalan1[$i];
                DB::insert('INSERT INTO responses (ranswer, studentid, modid, sqid, created_at) values (?, ?, ?, ?, now())', [$j1, $currentuser, $modid, $s1]);
            }

        }

        return redirect('student-surveys');
    }
}
