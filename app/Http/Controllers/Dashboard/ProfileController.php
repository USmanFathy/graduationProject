<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit()
    {
        $countries = Countries::getNames('EN');
        $locals = Languages::getNames('EN');
        $user = auth()->guard('admin')->user();
        return view('Dashboard.profile.edit',compact('user','countries' ,'locals'));
    }

    public function update (Request $request)
    {
        $request->validate([
            'first_name' => ['required' , 'string' , 'max:255','min:4'],
            'last_name' => ['required' , 'string' , 'max:255','min:4'],
            'birthday' => ['nullable' , 'date' , 'before:today'],
            'gender'   =>['in:male,female'],
            'country'  =>['required' , 'string' ,'size:2']
        ]);
        $admin =auth()->guard('admin')->user();
        $admin->update($request->all());

        return redirect()->route('dashboard')
            ->with('success' ,'Admin Updated Successfully');
    }
}
