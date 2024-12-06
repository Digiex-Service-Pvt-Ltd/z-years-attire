<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class SettingController extends Controller
{
    public function index(){
        return view('admin.maincontents.changepassword');
    }

    public function change_password(Request $request)
    {

        $request->validate([
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|max:15|confirmed',
        ]);

        // Old Password Matched //
        $currentAdmin = Auth::guard('admin')->user();
        $passwordStatus = Hash::check($request->old_password, $currentAdmin->password);
        if($passwordStatus){
            Admin::findOrFail($currentAdmin->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return redirect()->route('admin.changepassword')
        ->with(['toast'=>'1','status'=>'success','title'=>'Password Change','message'=>'Success! Password updated successfully.']);
        }else{
            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Password Not Match','message'=>"Old Password Doesn't Match!"]);
        }
    }
}
