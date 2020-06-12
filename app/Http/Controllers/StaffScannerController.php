<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;

class StaffScannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function ScanDetail()
    {
    	$userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();

        $studId= Input::get('id');
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $v = date("H:i");
        if($v >= "08:00" && $v <= "13:00")
        {
            $session = "1";
        }
        else if($v >= "14:00" && $v <= "17:00")
        {
            $session = "2";
        }
        
        //check ada data ke x.
        $q = DB::select(DB::raw("SELECT name, id FROM students WHERE id='$studId'"));

        //check patut datang ke x
        $q2 = DB::SELECT(DB::raw("SELECT sm.id AS smno, sm.modid AS smmodid, modname AS smmodname, smgroup AS mssmgroup, ms.msplace, ms.staffid, t.nama_tempat as place, s.name AS staffname FROM modules m, studentxmodules sm, modulexstaff ms, tempat t, staff s WHERE m.id = sm.modid AND sm.studentid='$studId' AND smgroup=msgroup AND ms.msplace=t.id AND ms.staffid=s.id"));//DB::select(DB::raw("SELECT sm.id AS smno, sm.modid AS smmodid, modname AS smmodname, smgroup AS mssmgroup FROM modules m JOIN studentxmodules sm ON m.id = sm.modid WHERE sm.studentid='$studId' AND sm.smsession='$session'"));
        //DB::select(DB::raw("SELECT sm.id AS smno, sm.modid AS smmodid, modname AS smmodname, smgroup AS mssmgroup FROM modules m JOIN studentxmodules sm ON m.id = sm.modid WHERE sm.studentid='$studId'"));

        //check staff punya tempat module
        $q3 = DB::select(DB::raw("SELECT * FROM studentxmodules sm, modulexstaff ms, tempat t WHERE sm.modid = ms.modid AND sm.smgroup = ms.msgroup AND sm.smyear = ms.msyear AND ms.msplace=t.id AND sm.studentid='$studId' AND ms.staffid = '$userid' AND sm.smyear = YEAR(NOW())"));
        //DB::select(DB::raw("SELECT * FROM studentxmodules sm, modulexstaff ms WHERE sm.modid = ms.modid AND sm.smgroup = ms.msgroup AND sm.smyear = ms.msyear AND sm.studentid='$studId' AND ms.staffid = '$userid' AND sm.smyear = YEAR(NOW())"));

        if($q)      //data student ada
        {
            $responsedb = array(1 => "Ada data");
            $result = array_merge($responsedb, $q);

            if($q2)     //kena datang
            {
                $responsedb = array(1 => "Ada data , Kena datang");
                $result = array_merge($responsedb, $q, $q2);

                if($q3)    //tempat betul
                {
                    $responsedb = array(1 => "Ada data , Kena datang , Tempat betul");
                    $result = array_merge($responsedb, $q, $q2, $q3);
                }
                else        //tempat salah
                {
                    $responsedb = array(1 => "Ada data , Kena datang , Tempat salah");   //return "Student are not in correct place";
                    $result = array_merge($responsedb, $q, $q2);
                }
            }
            else        //x kena datang
            {
                $responsedb = array(1 => "Ada data , Tak kena datang"); //return "Student aren't assigned to attend any module yet.";
                $result = array_merge($responsedb, $q, $q2);
            }
        }
        else
        {
            $responsedb = array(1 => "Takada data");   //return "Invalid QR/ Student not in list";
            $result = array_merge($responsedb, $q, $q2);
        }

        $finalresult = json_encode($result);
        echo $finalresult;
    }

    public function ScanAttend()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();

        $studId= Input::get('studID');
        $smno= Input::get('smno');
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $v = date("H:i");
        if($v >= "08:00" && $v <= "13:00")
        {
            $session = "1";
        }
        else if($v >= "14:00" && $v <= "17:00")
        {
            $session = "2";
        }
        else
        {
            return "Time to scan is in between 8am-1pm and 2pm-5pm! Please scan in between the time stated.";
        }
        $attend = DB::update('UPDATE studentxmodules SET status="ATTENDED", time=now(), remark="-", updated_at=now() WHERE studentid=? AND id=? AND smsession=?', [$studId, $smno, $session]);
        return "Saved!";
    }
}
