<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::where('id','!=',auth()->guard('admin')->user()->id)->paginate();

        return view('Dashboard.admins.index' ,['admins'=>$admins]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('Dashboard.admins.create' ,['admin'=>new  Admin()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $admin = Admin::create($request);
        return redirect()->route('admins.index')
            ->with('success' ,'Admin Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $countries = Countries::getNames('EN');
        $locals = Languages::getNames('EN');
        return view('Dashboard.admins.edit' ,['admin'=>$admin,'countries'=>$countries ,'locals'=>$locals ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $admin->update($request);

        return redirect()->route('admins.index')
            ->with('success' ,'Admin Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->route('admins.index');
    }
}
