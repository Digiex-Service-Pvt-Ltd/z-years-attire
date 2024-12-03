<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class AdminLoginController extends Controller
{
    public function __construct(){
        //$this->middleware('guest:admin')->except('logout');
    }

    public function index(){
        return view('admin.login');
    }

    public function login(Request $request){

        //echo $password = Hash::make('123456');
        //validate login credentials
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:6|max:15'
        ],[
            'email.exists' => 'The email is not registered in our account.'
        ]);
        $check = array('email'=>$request->email, 'password'=>$request->password, 'account_status'=>'A');
        if(Auth::guard('admin')->attempt($check)){
            /*$user = Auth::guard('admin')->user()->toArray();
            print_r($user);*/
            return redirect()->route('admin.dashboard')->with('success', 'Welcome to dashboard.');
        }else{
            return redirect()->back()->with('error', 'Please enter a valid credentials.');
        }
        
       
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
