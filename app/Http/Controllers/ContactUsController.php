<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('front.contactus.index');
    }

    public function send(Request $request)
    {
        $data = $request->all();
        Mail::to(env('ContactEmail'))->send(new ContactUsEmail($data));
        return redirect()->back()->with('success','the mail was sent successfully');

    }
}
