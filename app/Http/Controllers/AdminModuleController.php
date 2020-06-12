<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class AdminModuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function adModule() //returnpage
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
        $module = DB::table('modules')
                ->select('modules.*')
                ->get();
        $sa = DB::table('surveys')
                ->select('surveys.*')
                ->get();
        return view('admin.admin-module', ['profile' => $profile])->with(compact('module'))->with(['sa' => $sa]);
    }

    public function store(Request $request)
    {
        $data = json_decode($request);
        $modname = $request->modname;
        $moddesc = $request->moddesc;
        $modstatus = $request->modstatus;
        $modtime = '08:00-17:00';
        
        $module = DB::insert('INSERT INTO modules (modname, modstatus, moddesc, modtime, surveyid) values (?, ?, ?, ?)', [$modname, $modstatus, $moddesc, $modtime]);

        $q = DB::table('modules')->orderBy('CREATED_AT', 'desc')->first();

        $result = json_encode($q);
        echo $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($module_id)
    {
        $module = DB::table('modules')
                ->select('modules.*')
                ->where('id', $module_id)
                ->first();
        return response()->json($module);
    }

    
    public function update(Request $request, $module_id)
    {
        $data = json_decode($request);
        $modid = $request->modid;
        $modname = $request->modname;
        $moddesc = $request->moddesc;
        $modstatus = $request->modstatus;

        $module = DB::update('UPDATE modules SET modname=?, moddesc=?, modstatus=?, updated_at=now() WHERE id=?', [$modname, $moddesc, $modstatus, $modid]);
        $q = DB::table('modules')->orderBy('UPDATED_AT', 'desc')->first();

        $result = json_encode($q);
        //$result = json_encode($modid);
        echo $result;
        //echo $module_id;
    }

    public function destroy($module_id)
    {
        $module = DB::table('modules')->select('modules.*')->where('id', $module_id)->delete();
        return response()->json($module);
    }
}
