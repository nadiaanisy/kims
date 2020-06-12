<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
use Hash;
use Image; //Intervention Image

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function index()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
        return view('staff.staff-home', ['profile' => $profile]);
    }

    public function staffprofile()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
        return view('staff.staff-profile', ['profile' => $profile]);
    }

    public function stfUpdateInfo(Request $request)
    {
        $this->validate($request,[
            'contactno' => 'string|max:20',
            'email' => 'string|email|max:255',
        ]);

        $userid = Auth::user()->id;
        $contactno = $request->input('contactno');
        $email = $request->input('email');

        DB::update('UPDATE staff SET email=?, contact=?, updated_at=now() WHERE id=?', [$email, $contactno, $userid]);

        return redirect()->back()->with("success","You have successfully updated your personal info.");
    }

    public function passwordchange()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
        return view('staff.staff-passchg', ['profile' => $profile]);
    }

    public function staffchangePassword(Request $request)
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

     public function gallery(Request $request)
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();

       $gallery = DB::table('gallery')
                ->join('staff', 'gallery.staffid', '=', 'staff.id')
                ->select('gallery.id AS gid', 'gallery.filename', 'gallery.image', 'gallery.staffid', 'gallery.created_at', 'gallery.updated_at', 'staff.name', 'staff.email', 'staff.role', 'staff.faculty')
                ->orderBy('gallery.updated_at', 'DESC')
                ->paginate(4);

        return view('staff.staff-gallery', ['profile' => $profile], compact('gallery'));
    }
     public function showupload()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
                
        $gallery = DB::table('gallery')
                ->join('staff', 'gallery.staffid', '=', 'staff.id')
                ->select('gallery.id AS gid', 'gallery.filename', 'gallery.image', 'gallery.staffid', 'gallery.created_at', 'gallery.updated_at', 'staff.name', 'staff.email', 'staff.role', 'staff.faculty')
                ->orderBy('gallery.updated_at', 'DESC')
                ->paginate(4);
        return view('staff.staff-uploadimg', ['profile' => $profile], compact('gallery'));
    }

     public function uploadPost(Request $request)
    {
        $userid = Auth::user()->id;

        $this->validate($request,[
            'title' => 'required',
            'title.*' => 'max:255',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->hasfile('image')) //kalau ada request untuk upload gambar
        {
            $i = 0;
            foreach($request->file('image') as $image)
            {
                $title = Input::get('title');

                //get filename with extension
                $name = $image->getClientOriginalName();

                //get filename without extension
                $namewe = pathinfo($name, PATHINFO_FILENAME);
                
                //get file extension
                $extension = $image->getClientOriginalExtension();

                //filename to store
                $filenametostore = $namewe.'_'.uniqid().'.'.$extension;


                //Resize image here
                $thumbnailpath = $image->move(public_path().'/images/', $name); 
                //$img = Image::make($thumbnailpath)->save($thumbnailpath);
                $img = Image::make($thumbnailpath)->save($thumbnailpath);
                //$img->save($thumbnailpath);
                $titlename = $title[$i]; //sbb input kat form array, so panggil dlm bentuk array.
                DB::table('gallery')->insert(['filename' =>  $titlename, 'image' => $name, 'staffid' => $userid, 'created_at' => now(), 'updated_at' => now()]);
                $i++;
            }
        }
        return back()->with('success', 'Your image(s) has been successfully uploaded!');
    }

    public function delImage($id)
    {
         DB::table('gallery')
                ->select('gallery.*')
                ->where('id', $id)
                ->delete();
        return redirect()->back()->with("success", "Image has been deleted successfully");  
    }

    public function attendance()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
        $g= DB::select(DB::raw("SELECT * FROM modulexstaff WHERE staffid='$userid' AND msyear=YEAR(CURDATE()) ORDER BY msgroup ASC"));
        
        $datas = DB::select(DB::raw("SELECT * FROM studentxmodules sm JOIN students u ON sm.studentid=u.id WHERE smyear=YEAR(CURDATE())"));

        $v3=DB::SELECT(DB::RAW("SELECT ms.staffid, ms.modid, ms.msyear, ms.msdate, ms.msplace, sm.id, sm.studentid, sm.smsession, sm.status, s.name, s.cprog, s.part, sm.smgroup FROM modulexstaff ms JOIN studentxmodules sm ON sm.modid=ms.modid AND ms.msgroup=sm.smgroup JOIN students s ON sm.studentid=s.id WHERE staffid='$userid' AND msyear=YEAR(CURDATE())"));
        $end=DB::SELECT(DB::RAW("SELECT sxm.studentid, sxm.modid, m.modname, sxm.smsession, sxm.time, sxm.status, mxs.staffid, mxs.msgroup, mxs.msyear, mxs.msdate, mxs.msplace, t.nama_tempat FROM studentxmodules sxm JOIN modulexstaff mxs ON sxm.modid=mxs.modid and sxm.smyear=mxs.msyear JOIN modules m on sxm.modid=m.id JOIN tempat t on mxs.msplace=t.id WHERE mxs.staffid='1001' and mxs.msdate=curdate() limit 1"));
        

        return view('staff.staff-attendance', ['profile' => $profile])->with(compact('v3'))->with(['end' => $end]);
    }

    public function endki(Request $request)
    {
        $mod = $request->get('modid');
        $mgroup = $request->get('mgroup');
        $day = $request->get('day');
        $place = $request->get('place');
        $end = $request->get('endki');
        
        $a=DB::SELECT(DB::RAW("SELECT * FROM studentxmodules WHERE smyear=YEAR(NOW()) AND modid='$mod' AND smgroup='$mgroup' AND status IS NULL"));

        foreach($a as $b)
        {
             $m = $b->modid;
             $g = $b->smgroup;
             $y = $b->smyear;
             $s = $b->status;

            DB::table('studentxmodules')->where('modid', $m)->where('smgroup', $g)->where('smyear', $y)->where('status', $s)->update(['status' => 'NOT ATTENDED'], ['updated_at' => now()]);
        }
        return redirect()->back()->with("success", "The module has ended!"); 
    }

    public function show($smid)
    {
        /*$student = DB::SELECT(DB::RAW("SELECT * FROM students WHERE id = '$id'"));
        $module = DB::SELECT(DB::RAW("SELECT * FROM studentxmodules JOIN modules ON studentxmodules.modid = modules.id WHERE studentid='$id' ORDER BY studentxmodules.id DESC LIMIT 1"));*/
        $v3=DB::SELECT(DB::RAW("SELECT ms.modid, sm.id, sm.studentid, sm.status, s.name, s.contact, m.modname FROM modulexstaff ms JOIN studentxmodules sm ON sm.modid=ms.modid AND ms.msgroup=sm.smgroup JOIN students s ON sm.studentid=s.id join modules m on ms.modid=m.id WHERE sm.id='$smid'"));
        
        /*if(empty($module))
        {
            $a = array(1 => "NO MODULE");
        }
        else
        {
            $a = array(1 => "HAVE MODULE");
        }
        $result = array_merge($a, $student, $module);
        return response()->json($result);*/
        return response()->json($v3);
    }

    public function module()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();

        $data ['data'] = DB::select(DB::raw("SELECT * from modulexstaff ms JOIN staff s ON ms.staffid=s.id JOIN modules m ON ms.modid=m.id where s.id= '$userid' AND msyear=YEAR(CURDATE()) ORDER BY msdate"));
        
        return view('staff.staff-module', ['profile' => $profile], $data);
    }

    public function showModule($id)
    {
        $userid = Auth::user()->id;
        $module = DB::select(DB::raw("SELECT * from modulexstaff ms JOIN modules m ON ms.modid=m.id join tempat t on ms.msplace=t.id where ms.staffid= '$userid' AND msyear=YEAR(CURDATE()) AND msgroup='$id'"));
        return response()->json($module);
    }
}
