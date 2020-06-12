<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;

class AdminSurveyController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin');
    }

    public function question()
    {
    	$userid = Auth::user()->id;
        $profile = DB::table('staff')->select('staff.*')->where(['id'=> $userid])->first();
        $question = DB::table('questions')->select('questions.*')->get();
        return view('admin.admin-question', ['profile' => $profile])->with(compact('question'));
    }

    public function showQuest($id)
    {
    	$quest = DB::table('questions')->select('questions.*')->where('id', $id)->first();
        return response()->json($quest);
    }

    public function storeQuest(Request $request)
    {
        $data = json_decode($request);
        $soalan = $request->soalan;
        $jenis = $request->jenis;
        
        $quest = DB::insert('INSERT INTO questions (quests, typequest, created_at) values (?, ?, now())', [$soalan, $jenis]);

        $q = DB::table('questions')->orderBy('CREATED_AT', 'desc')->first();

        $result = json_encode($q);
        echo $result;
    }

    public function updateQuest(Request $request, $id)
    {
    	$data = json_decode($request);
    	$question_id = $request->question_id;
        $soalan = $request->soalan;
        $jenis = $request->jenis;

        $quest = DB::update('UPDATE questions SET quests=?, typequest=?, updated_at=now() WHERE id=?', [$soalan, $jenis, $question_id]);

        $q = DB::table('questions')->orderBy('UPDATED_AT', 'desc')->first();

        $result = json_encode($q);
        echo $result;
    }

    public function destroyQuest($id)
    {
        $quest = DB::table('questions')->select('questions.*')->where('id', $id)->delete();
        return response()->json($quest);
    }

    //--------------------------------------------------------------------------------------------//
    public function survey()
    {
    	$userid = Auth::user()->id;
        $profile = DB::table('staff')->where(['id'=> $userid])->first();
        $survey =  DB::table('surveys')->select('surveys.*')->get();
        return view('admin.admin-survey', ['profile' => $profile], compact('survey'));
    }

    public function showSurvey($id)
    {
    	$s = DB::table('surveys')->select('surveys.*')->where('id', $id)->first();
        return response()->json($s);
    }

    public function storeSurvey(Request $request)
    {
        $data = json_decode($request);
        $name = $request->surveyname;
        $status = $request->surveystatus;
        
        $quest = DB::insert('INSERT INTO surveys (surveyname, surveystatus, created_at) values (?, ?, now())', [$name, $status]);

        $q = DB::table('surveys')->orderBy('CREATED_AT', 'desc')->first();

        $result = json_encode($q);
        echo $result;
    }

    public function updateSurvey(Request $request, $id)
    {
        $data = json_decode($request);
        $surveyid = $request->surveyid;
        $name = $request->surveyname;
        $status = $request->surveystatus;

        $quest = DB::update('UPDATE surveys SET surveyname=?, surveystatus=?, updated_at=now() WHERE id=?', [$name, $status, $surveyid]);

        $q = DB::table('surveys')->orderBy('UPDATED_AT', 'desc')->first();

        $result = json_encode($q);
        echo $result;
    }

    public function destroySurvey($id)
    {
        $quest = DB::table('surveys')->select('surveys.*')->where('id', $id)->delete();
        return response()->json($quest);
    }

    //--------------------------------------------------------------------------------------------//
    public function surveyQuestion($id)
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
        $survey = DB::table('surveys')
                ->select('surveys.*')
                ->where('id',$id )
                ->first();       
        $question = DB::table('surveyxquest')
                ->join('questions','surveyxquest.qid','=','questions.id')
                ->select('surveyxquest.*','questions.*')
                ->where('surveyid',$id )
                ->get(); // ni. xde soalan en dlm db. x keluarlah. kalau ada dia keluar. yg berkait dgn dia


        $allQ = DB::table('questions')
                ->select('questions.*')
                ->get();

        return view('admin.admin-surveyQ',['profile' => $profile])->with(compact('question','allQ', 'survey'));
    }

    public function surveyQuestionUpdate($id)
    {
      
        $cbe = Input::get('cbE');
        if(empty($cbe))
        {
            DB::update('UPDATE surveyxquest SET view_status="disabled", updated_at=now() WHERE surveyid=?',[$id]);
        }
        if(!empty($cbe))
        {
            foreach($cbe as $e)
            {
                $data = DB::select(DB::raw("SELECT * FROM surveyxquest WHERE surveyid='$id' AND qid='$e'"));
                if($data) // kalau ada dalam db
                {
                    DB::update('UPDATE surveyxquest SET view_status="enable", updated_at=now() WHERE surveyid=? AND qid=?',[$id, $e]);
                    echo "dah update <br>";
                }
                else    // masalah dkt sini kot
                {
                    DB::insert('INSERT INTO surveyxquest (qid, surveyid, created_at, view_status) values (?, ?, now(), "enable")', [$e, $id]);
                    echo 'insert';
                }
            }
            DB::table('surveyxquest')->select('surveyxquest.*')->whereNotIn('qid', $cbe)->where('surveyid', $id)->update(['view_status' => 'disabled']);
        }
        return redirect()->back() ->with('alert', 'Questions updated!');
    }

    //--------------------------------------------------------------------------------------------//
    public function response()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
        
        $m = DB::SELECT(DB::RAW("SELECT r.id, r.ranswer, r.studentid, r.modid, r.sqid, m.modname, sm.smgroup, sm.smyear FROM responses r join modules m on r.modid=m.id join studentxmodules sm on r.studentid=sm.studentid group by r.modid"));
        //$m = DB::SELECT(DB::RAW("SELECT r.id, r.ranswer, r.studentid, r.modid,r.sqid, m.modname, sm.smyear FROM responses r join modules m on r.modid=m.id join studentxmodules sm on r.studentid=sm.studentid group by r.modid"));
        $c = count(DB::SELECT(DB::RAW("SELECT r.id, r.ranswer, r.studentid, r.modid, r.sqid, m.modname, sm.smgroup, sm.smyear FROM responses r join modules m on r.modid=m.id join studentxmodules sm on r.studentid=sm.studentid group by r.studentid")));
        //count($m);
        return view('admin.admin-surveyResponse', ['profile' => $profile])->with(compact('m'))->with(['c' => $c]);
        //dd($c);
    }

    public function responsesView($id)
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();

        $value = DB::table('responses')
                ->join('surveyxquest', 'responses.sqid', '=', 'surveyxquest.id')
                ->join('questions', 'surveyxquest.qid', '=', 'questions.id')
                ->join('surveys', 'surveyxquest.surveyid', '=', 'surveys.id')
                ->select('responses.id', DB::raw('avg(responses.ranswer) AS ranswer'), 'responses.modid', 'responses.sqid', 'surveyxquest.qid', 'surveyxquest.surveyid', 'questions.quests', 'questions.typequest', 'surveys.surveyname')
                ->groupBy('questions.quests')
                ->get();
                //SELECT r.id, avg(r.ranswer) as answer, r.modid, r.sqid, sq.qid, sq.surveyid, q.quests, q.typequest, s.surveyname FROM responses r join surveyxquest sq on r.sqid=sq.id join questions q on sq.qid = q.id join surveys s on sq.surveyid = s.id group by q.quests

        //DB::SELECT(DB::RAW("SELECT r.id, r.ranswer, r.modid, r.sqid, sq.qid, sq.surveyid, q.quests, q.typequest, sv.surveyname FROM responses r join surveyxquest sq on r.sqid=sq.id join questions q on sq.qid=q.id join surveys sv on sq.surveyid=sv.id limit 1"));

    	return view('admin.admin-surveyResponse-preview', ['profile' => $profile])->with(['id' => $id])->with(compact('value'));
    }
}
