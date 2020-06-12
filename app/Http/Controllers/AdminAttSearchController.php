<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class AdminAttSearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showAttendance()
    {
    	$userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
        $student = DB::SELECT(DB::RAW("SELECT * FROM students ORDER BY name"));
        return view('admin.admin-attsearch', ['profile' => $profile])->with(compact('student'));
    }

    public function show($id)
    {
        $student = DB::SELECT(DB::RAW("SELECT * FROM students WHERE id = '$id'"));
        $module = DB::SELECT(DB::RAW("SELECT * FROM studentxmodules Join modules ON studentxmodules.modid = modules.id WHERE studentid='$id' ORDER BY studentxmodules.id"));// dapat semua line

        if(empty($module))
        {
            $a = array(1 => "NO MODULE");
        }
        else
        {
            $a = array(1 => "HAVE MODULE");
        }
        $result = array_merge($a, $student, $module);
        return response()->json($result);
    }
}
