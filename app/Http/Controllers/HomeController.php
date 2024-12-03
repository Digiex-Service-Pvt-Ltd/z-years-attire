<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index(){
        return view('maincontents/home');
    }

    public function aboutus(){
        return view('maincontents/about');
    }

    public function contactus(){
        return view('maincontents/contact');
    }

    public function submit_contact(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        //echo "<pre>"; print_r($request->session()->all()); die;
        
        $contact = new Contact;
        $contact->name = $request['name'];
        $contact->email = $request['email'];
        $contact->subject = $request['subject'];
        $contact->message = $request['message'];

        $contact->save();
        $request->session()->flash('msg', 'Contact saved successfully');
        return redirect('/contact');
    }
}
