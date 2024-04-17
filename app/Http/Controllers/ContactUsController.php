<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsEmail;
use App\Models\Admin;
use App\Notifications\ContactUsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('front.contactus.index');
    }

    public function send(Request $request)
    {
        $data = $request->all();
        $admins = Admin::all();
        foreach ($admins as $admin){
            $admin->notify(new ContactUsNotification($data));
        }
        return redirect()->back()->with('success','the mail was sent successfully');

    }
}
