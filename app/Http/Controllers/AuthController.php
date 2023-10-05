<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //functio to show register form new users
    public function viewReg(){
        return view('Auth.register');
    }

    //function to register user default as a normal user
    public function register(Request $request){
    $user=new Users();
    $user->name=$request['full_name'];
    $user->email=$request['email'];
    //encrypt the password using hash function
    if ($request['password']==$request['cpassword']) {
        $user->password=Hash::make($request['password']);
    }else {
        $response="Password not match";
        return redirect('/reg_form')->with('error',$response);
    }
    $user->role='user';

    if ($user->save()==1) {
        $response="Account created successfully";
        return redirect('/')->with('success',$response);
    }else {
        $response="Error while crateing an account";
        return redirect('/reg_form')->with('error',$response);
    }
    }

    //authentication method
    protected function signin(Request $request){
        $email=$request['email'];
        $pwd=$request['password'];
        $countUser=Users::where('email',$email)->count();
        if ($countUser==1) {
            $user=Users::where('email',$email)->first();
            $fname=$user['name'];
            $dbpwd=$user['password'];
            $role=$user['role'];
                if (Hash::check($pwd,$dbpwd)) {//verify password using hashing function if they are same
                    //counts total comments that available that commented on certain tasks
                    //Tasks that have comments
                    $countsComms=DB::table('users')->join('comments','users.user_id','=','comments.user_id')
                    ->join('attachments','comments.task_id','=','attachments.task_id')
                    ->join('tasks','attachments.task_id','=','tasks.task_id')
                    ->select('users.name','tasks.title','comments.comment','comments.created_at')->count();

                    session()->put('totalComments',$countsComms);
                    // return session('totalComments');
                    if ($role=="manager") {
                        session()->put('manager',$email);
                        session()->put('role','manager');
                        return redirect('/managers');
                    }elseif ($role=="user") {
                        session()->put('user',$email);
                        session()->put('role','user');
                        return redirect('/users');
                    }else{
                        session()->put('admin',$email);
                        session()->put('role','admin');
                        return redirect('/admins');
                    }
                }else{
                    $response="Wrong username or password";
                    return redirect('/')->with('error',$response);
                }
        }else{
            $response="Email do not exist";
            return redirect('/')->with('error',$response);
        }
    }

    //method to logout
    public function signout(Request $request){
        if (session()->has('admin')) {
           $request->session()->forget('admin'); //removes specific session data/item
           session()->flush();//removes all sessions data
        }elseif (session()->has('manager')) {
            $request->session()->forget('manager');
            session()->flush();
        }else {
            $request->session()->forget('manager');
            session()->flush();
        }
        $response="Sign out successfull";
        return redirect('/')->with('success',$response);
    }
}
