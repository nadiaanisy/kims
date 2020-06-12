<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;

class AdminAssignerController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin');
    }

    public function adAssign()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')->select('staff.*')->where(['id'=> $userid])->first();
        $mod = DB::table('modules')->select('modules.*')->where('modstatus', '=', 'OPEN')->orderBy('created_at', 'ASC')->get();

        return view('admin.admin-assigner', ['profile' => $profile])->with(compact('mod'));
    }

    public function todo(Request $request)
    {
    	$userid = Auth::user()->id;
        $profile = DB::table('staff')->select('staff.*')->where(['id'=> $userid])->first();
        $mod = DB::table('modules')->select('modules.*')->where('modstatus', '=', 'OPEN')->get();

        $module = $request->get('module');
        $group = $request->get('group');
    	
        $m = DB::table('modules')->select('modules.*')->where('id', $module)->get();


        $s1 = DB::SELECT(DB::RAW("SELECT * FROM students WHERE id NOT IN (SELECT studentid FROM studentxmodules WHERE modid='$module' ORDER BY RAND())"));
        $s2 = DB::SELECT(DB::RAW("SELECT * FROM students WHERE id IN (SELECT studentid FROM studentxmodules WHERE modid='$module' AND status IS NULL AND smyear!=YEAR(NOW()) ORDER BY RAND()) AND id NOT IN (SELECT studentid FROM studentxmodules WHERE modid='$module' AND status IS NULL AND smyear=YEAR(NOW()) ORDER BY RAND())"));
        $result = array_merge($s1, $s2);
        $counter = count($result);
        $each = intval($counter / $group);
        $finalresult = $result;
      
        return view('admin.admin-assigner', ['profile' => $profile], compact('mod'))->with(['m' => $m])->with(['group' => $group])->with(['counter' => $counter])->with(['each' => $each])->with(['finalresult' => $finalresult]);
    }

    public function saving(Request $request)
    {
        $year = date('Y');
        $modid = $request->get('modid');
        $nogroup = $request->get('nogroup');
        $each = $request->get('each');

        $m = DB::table('modules')->select('modules.*')->where('id', $modid)->get();

        for($i=1; $i<= $nogroup; $i++) //group ada berapa
        {
            ${"oldinput".$i} = $request->get('input_name'.$i);
            ${"newinput".$i} = unserialize(${"oldinput".$i});

            $org = 0;

            echo $each;
            while($org < $each)
            {
                DB::table('studentxmodules')->insert(['studentid' => ${"newinput".$i}[$org], 'modid' => $modid, 'smgroup' => $i, 'smsession' => '1', 'smyear' => $year, 'created_at' => NOW()]);    //sesi1
                DB::table('studentxmodules')->insert(['studentid' => ${"newinput".$i}[$org], 'modid' => $modid, 'smgroup' => $i, 'smsession' => '2', 'smyear' => $year, 'created_at' => NOW()]);    //sesi2
                $org++;
            }

            DB::table('modulexstaff')->insert(['modid' => $modid, 'msgroup' => $i, 'msyear' => $year, 'created_at' => NOW()]);
        }
        
        foreach($m as $n)
        {
            return redirect()->back()->with("success","You have successfully created group(s) for ".$n->modname);
        }
    }

//-----------------------------------------------------------------------------------------//
    public function view()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')->select('staff.*')->where(['id'=> $userid])->first();
        
        $data = DB::SELECT(DB::RAW("SELECT SM.id, SM.modid, M.modname, SM.smgroup, SM.smyear, SM.studentid, s.name, SM.status FROM studentxmodules SM JOIN modules M ON SM.modid=M.id JOIN students S on SM.studentid=S.id WHERE SM.SMYEAR=YEAR(NOW()) AND SM.STATUS IS NULL GROUP BY SM.studentid, SM.modid ORDER BY SM.modid, SM.SMGROUP, s.name ASC"));
        $all = DB::SELECT(DB::RAW("SELECT * from students ORDER BY name ASC"));
        $m = DB::SELECT(DB::RAW("SELECT * from modules where modstatus='OPEN' ORDER BY modname ASC"));
        
        return view('admin.admin-stud-list', ['profile' => $profile], compact('m'))->with(['data' => $data])->with(['all' => $all]);
    }

    public function show($mid)
    {
        $m = DB::table('modules')->select('modules.*')->where('id', $mid)->get();
        $s1 = DB::SELECT(DB::RAW("SELECT * FROM students WHERE id NOT IN (SELECT studentid FROM studentxmodules WHERE modid='$mid') ORDER BY name"));
        $s2 = DB::SELECT(DB::RAW("SELECT * FROM students WHERE id IN (SELECT studentid FROM studentxmodules WHERE modid='$mid' AND status IS NULL AND smyear!=YEAR(NOW())) AND id NOT IN (SELECT studentid FROM studentxmodules WHERE modid='$mid' AND status IS NULL AND smyear=YEAR(NOW()))"));
        $result = array_merge($s1, $s2);
        return json_encode($result);
    }

    public function getdata($sxmid)
    {
        $s = DB::SELECT(DB::RAW("SELECT SM.id, SM.modid, M.modname, SM.smgroup, SM.smyear, SM.studentid, s.name, SM.status FROM studentxmodules SM JOIN modules M ON SM.modid=M.id JOIN students S on SM.studentid=S.id WHERE SM.id='$sxmid'"));

        $result = json_encode($s);
        echo $result;
    }

    public function store(Request $request)
    {
        $year = date('Y');
        $data = json_decode($request);
        $mid = $request->mn;
        $studname = $request->studname;
        $group = $request->group;
        
        DB::table('studentxmodules')->insert(['studentid' => $studname, 'modid' => $mid, 'smgroup' => $group, 'smsession' => '1', 'smyear' => $year, 'created_at' => NOW()]);    //sesi1
        DB::table('studentxmodules')->insert(['studentid' => $studname, 'modid' => $mid, 'smgroup' => $group, 'smsession' => '2', 'smyear' => $year, 'created_at' => NOW()]);    //sesi2//

        $v = DB::SELECT(DB::RAW("SELECT * FROM modulexstaff WHERE modid='$mid' AND msgroup='$group' AND msyear='$year'"));
        $k = count($v);

        $a=$k;
        $b = 1;
        if($a == 0)
        {
            DB::table('modulexstaff')->insert(['modid' => $mid, 'msgroup' => $group, 'msyear' => $year, 'created_at' => NOW()]);
        }
        $q = DB::SELECT(DB::RAW("SELECT SM.id, SM.modid, M.modname, SM.smgroup, SM.smyear, SM.studentid, s.name, SM.status FROM studentxmodules SM JOIN modules M ON SM.modid=M.id JOIN students S on SM.studentid=S.id WHERE SM.SMYEAR=YEAR(NOW()) AND SM.STATUS IS NULL GROUP BY SM.studentid ORDER BY SM.id DESC LIMIT 1"));

        $result = json_encode($q);
        echo $result;
    }

    public function update(Request $request, $sxmid)
    {
        $year = date('Y');
        $data = json_decode($request);
        $mid = $request->mn;
        $stud = $request->studname;
        $group = $request->group;
        $group1 = $request->group1;

        DB::update('UPDATE studentxmodules SET smgroup=?, updated_at=now() WHERE modid=? AND studentid=? AND smyear=?', [$group, $mid, $stud, $year]);

        //check dh add dkt staff
        $v = DB::SELECT(DB::RAW("SELECT * FROM modulexstaff WHERE modid='$mid' AND msgroup='$group' AND msyear='$year'"));
        $k = count($v);
        $a=$k;
        if($a == 0)
        {
            DB::table('modulexstaff')->insert(['modid' => $mid, 'msgroup' => $group, 'msyear' => $year, 'created_at' => NOW()]);
        }

        //check num of student
        $v1 = DB::SELECT(DB::RAW("SELECT * FROM studentxmodules WHERE modid='$mid' AND smgroup='$group1' AND smyear='$year'"));
        $k1 = count($v1);
        $a1=$k1/2;
        if($a1 == 0)
        {
            DB::table('modulexstaff')->where('modid',$mid)->where('msgroup', $group1)->where('msyear', $year)->delete();
        }

        $q = DB::SELECT(DB::RAW("SELECT SM.id, SM.modid, M.modname, SM.smgroup, SM.smyear, SM.studentid, s.name, SM.status FROM studentxmodules SM JOIN modules M ON SM.modid=M.id JOIN students S on SM.studentid=S.id WHERE SM.id='$sxmid'"));
        $result = json_encode($q);
        echo $result;
    }

    public function destroy($sxmid)
    {
        $r = DB::SELECT(DB::RAW("SELECT SM.id, SM.modid, M.modname, SM.smgroup, SM.smyear, SM.studentid, s.name, SM.status FROM studentxmodules SM JOIN modules M ON SM.modid=M.id JOIN students S on SM.studentid=S.id WHERE SM.id='$sxmid'"));

        foreach ($r as $rr)
        {
            $mid = $rr->modid;
            $stud = $rr->studentid;
            $year = $rr->smyear;
        }
        
        $l= DB::table('studentxmodules')->select('studentxmodules.*')->where('modid', $mid)->where('studentid', $stud)->where('smyear', $year)->delete();
        return response()->json($l);
    }

    //-----------------------------------------------------------------------------------------//
    public function assignFaci()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')->select('staff.*')->where(['id'=> $userid])->first();
        $year = date('Y');
        
        $data = DB::SELECT(DB::RAW("SELECT mxs.id, m.modname, mxs.msgroup, mxs.msdate, t.nama_tempat, mxs.msyear, mxs.staffid, s.name FROM modulexstaff mxs, staff s, modules m, tempat t WHERE mxs.staffid = s.id AND mxs.modid = m.id AND mxs.msplace = t.id AND mxs.msyear = '$year'"));     //yg dh diassign

        $data2 = DB::SELECT(DB::RAW("SELECT mxs.id, m.modname, mxs.msgroup, mxs.msyear  FROM modulexstaff mxs, modules m WHERE mxs.modid = m.id AND mxs.msyear = '$year' AND mxs.staffid IS NULL"));     //yg belum diassign

        $faci = DB::SELECT(DB::RAW("SELECT id, name FROM staff WHERE id NOT IN (SELECT staffid FROM modulexstaff WHERE staffid IS NOT NULL)"));

        $t = DB::SELECT(DB::RAW("SELECT * FROM tempat WHERE id NOT IN (SELECT msplace FROM modulexstaff)"));

        return view('admin.admin-assigner-faci',['profile' => $profile],  compact('data'))->with(['data2' => $data2]); 
    }

    public function showData($mxsid)
    {
        $a = DB::table('modulexstaff')->select('modulexstaff.*')->where('id', $mxsid)->get();

        //check dlu dia dh dia assign ke tak. kalau dh, guna data kalau belum guna data2
        $data = DB::SELECT(DB::RAW("SELECT mxs.id, m.modname, mxs.msgroup, mxs.msdate, t.id AS tid, t.nama_tempat, mxs.msyear, mxs.staffid, s.name FROM modulexstaff mxs, staff s, modules m, tempat t WHERE mxs.staffid = s.id AND mxs.modid = m.id AND mxs.msplace = t.id AND mxs.id = '$mxsid'"));     //yg dh diassign
        $kira = count($data);

        if($kira > 0)   //dh diassignkn
        {
            return $data;
        }
        else        //belum diassignkn
        {
            $data2 = DB::SELECT(DB::RAW("SELECT mxs.id, m.modname, mxs.msgroup, mxs.msyear  FROM modulexstaff mxs, modules m WHERE mxs.modid = m.id AND mxs.id = '$mxsid'"));     //yg belum diassign
            return $data2;
        }
    }

    public function getPlace($tarikh)
    {
        $tempat = DB::SELECT(DB::RAW("SELECT * FROM tempat WHERE id NOT IN (SELECT msplace FROM modulexstaff WHERE msdate = '$tarikh')"));

        $result = json_encode($tempat);
        echo $result;
    }

    public function getFaci($tarikh)
    {
        $faci = DB::SELECT(DB::RAW("SELECT id, name FROM staff WHERE id NOT IN (SELECT staffid FROM modulexstaff WHERE msdate = '$tarikh')"));

        $result = json_encode($faci);
        echo $result;
    }

    public function storeFaci(Request $request)
    {
        $year = date('Y');
        $data = json_decode($request);
        $mxsid = $request->sid;
        $mid = $request->mn;
        $group = $request->group;
        $dates = $request->dates;
        $place = $request->place;
        $faci = $request->faci;
        
        DB::update('UPDATE modulexstaff SET staffid=?, msdate=?, msplace=?, updated_at=NOW() WHERE id=?', [$faci, $dates, $place, $mxsid]);

        $data = DB::SELECT(DB::RAW("SELECT mxs.id, m.modname, mxs.msgroup, mxs.msdate, t.id AS tid, t.nama_tempat, mxs.msyear, mxs.staffid, s.name FROM modulexstaff mxs, staff s, modules m, tempat t WHERE mxs.staffid = s.id AND mxs.modid = m.id AND mxs.msplace = t.id AND mxs.id = '$mxsid'"));     //yg dh diassign
        $kira = count($data);

        if($kira > 0)   //dh diassignkn
        {
            return $data;
        }
        else        //belum diassignkn
        {
            $data2 = DB::SELECT(DB::RAW("SELECT mxs.id, m.modname, mxs.msgroup, mxs.msyear  FROM modulexstaff mxs, modules m WHERE mxs.modid = m.id AND mxs.id = '$mxsid'"));     //yg belum diassign
            return $data2;
        }
    }

    public function destroyFaci($mxsid)
    {
        $l= DB::table('modulexstaff')->select('modulexstaff.*')->where('id', $mxsid)->delete();
        return response()->json($l);
    }
}
