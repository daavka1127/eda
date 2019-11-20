<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use DB;
use Crypt;
use App\userMine;
use App\employee;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function testAndroidJson(){
        $emps=DB::table('tbemployee')
            ->get();
        // $emps = employee::all();
        // return $emps;
        return Response::json($emps);
        // return "AA";
    }

    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Таны хуучин нууц үг буруу байна.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Шинэ нууц үг болон давтаж хийсэн нууц үг хоорондоо таарахгүй байна.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Нууц үг солигдлоо !");
    }

    public function showAdmins(){
        $email = Auth::user()->email;
        $admins = DB::table('users')
            ->where('users.email', '!=', $email)
            ->get();
        return view('auth.admin.admins', compact('admins'));
    }

    public function getCheckPasswordview(Request $req){
        $adminID = $req->id;
        return view('auth.admin.adminCheckPassword', compact('adminID'));
    }

    public function checkPassword(Request $req){
        $adminID = $req->id;
        $admin = DB::table('users')
            ->where('id', '=', $req->id)
            ->first();
        if (!(Hash::check($req->checkPassword, Auth::user()->password))) {
            return "error";
        }
        else{
            return view('auth.admin.adminDetails', compact("admin", "adminID"));
        }
    }

    public function updateAdmin(Request $req){
        $user = userMine::find($req->id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->permission = $req->permission;
        $user->save();

        $email = Auth::user()->email;
        $admins = DB::table('users')
            ->where('users.email', '!=', $email)
            ->get();
        $successMessage = "Амжилттай хадгаллаа.";
        return view('auth.admin.admins', compact('admins', 'successMessage'));
    }

    public function showPasswordReset(Request $req){
        $id=$req->id;
        return view('auth.admin.resetPasswordAdmin', compact('id'));
    }

    public function resetPassword(Request $req){
        $email = Auth::user()->email;
        $admins = DB::table('users')
            ->where('users.email', '!=', $email)
            ->get();
        if (!(Hash::check($req->authPassword, Auth::user()->password))) {
            // The passwords matches
            $error = "Таны өөрийн нууц үг буруу байна.";
            return view('auth.admin.admins', compact('admins', 'error'));
        }
        if($req->password != $req->passwordRepeat){
            //Current password and new password are same
            $error = "Шинэ нууц үг болон давтаж хийсэн нууц үг хоорондоо таарахгүй байна.";
            return view('auth.admin.admins', compact('admins', 'error'));
        }
        else{
            $user = userMine::find($req->id);
            $user->password = bcrypt($req->password);
            $user->save();
            $success = "Нууц үг солигдлоо.";
            return view('auth.admin.admins', compact('admins', 'success'));
        }
    }












    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['success_message' => '']);
        session(['error_message' => '']);
        return view('layouts.layout_main');
    }

    public function ajaxRequest()
    {
        return view('ajaxRequest');
    }

    public function ajaxRequestPost(Request $request)
    {
        $input = $request->all();
        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }
}
