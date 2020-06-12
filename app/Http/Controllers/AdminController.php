<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use Hash;
use Image; //Intervention Image
use File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin');
    }

    public function index()
    {
    	$userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();

        return view('admin.admin-home', ['profile' => $profile]);
    }

    public function adminprofile()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
        return view('admin.admin-profile', ['profile' => $profile]);
    }

    public function adminUpdateInfo(Request $request)
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

    public function adpasswordchange()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
        return view('admin.admin-passchg', ['profile' => $profile]);
    }

    public function adchangePassword(Request $request)
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

        return view('admin.admin-gallery', ['profile' => $profile], compact('gallery'));
    }

    public function adshowupload()
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
        return view('admin.admin-uploadimg', ['profile' => $profile], compact('gallery'));
    }

    public function aduploadPost (Request $request)
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
                $thumbnailpath = $image->move('images/', $name); 
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

    public function addelImage($id)
    {
        $pic = DB::table('gallery')
                ->select('gallery.*')
                ->where('id', $id)
                ->first();

       $image_path = base_path().'/public/images/'.$pic->image;
       unlink($image_path);

         //$pic->delete();

        DB::table('gallery')
                ->select('gallery.*')
                ->where('id', $id)
                ->delete();

        return redirect()->back()->with("success", "Image has been deleted successfully");
    }

    public function adattendance()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();
        return view('admin.admin-attendance', ['profile' => $profile]);
    } 

    public function report()
    {
        $userid = Auth::user()->id;
        $profile = DB::table('staff')
                ->select('staff.*')
                ->where(['id'=> $userid])
                ->first();

        $a = DB::table('studentxmodules')
            ->join('modules', 'studentxmodules.modid', '=', 'modules.id')
            ->select(DB::raw('count(DISTINCT studentxmodules.studentid) as counter'), 'studentxmodules.modid', 'studentxmodules.smyear', 'studentxmodules.status', 'modules.modname')
            ->groupBy('studentxmodules.status', 'studentxmodules.modid', 'studentxmodules.smyear')
            ->get();
            //DB::SELECT(DB::RAW("SELECT COUNT(id) as counter, modid, status FROM studentxmodules GROUP BY status, modid"));

            $valueNotYetAtt    = 0;
            $valueNotAtt    = 0;
            $valueAtt       = 0;

            if(!empty($a))
            {
                foreach ($a as $v)
                {
                    if($v->status == "NOT YET ATTENDED") {
                        $valueNotYetAtt++;
                    }
                    else if ($v->status == "NOT ATTENDED")
                    {
                        $valueNotAtt++;
                    }
                    else {
                       $valueAtt++;
                    }
                }
            }

            $dataPoints = array(
                array("label" => "NOT YET ATTEND", "y" => $valueNotYetAtt),
                array("label" => "NOT ATTENDED", "y" => $valueNotAtt),
                array("label" => "ATTEND", "y" => $valueAtt)
            );

        return view('admin.admin-report',['profile' => $profile, "dataPoints" => $dataPoints], compact('a'));
    }
}
