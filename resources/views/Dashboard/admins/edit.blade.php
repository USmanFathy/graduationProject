@extends('layouts.dashboard')
@section('title_section' ,'Edit Product')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Product</li>
@endsection
@section('content')

        <form action="{{route('admins.update' , $admin->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-row">
                <div class="col-md-6">
                    <x-form.input name="first_name" label="Name" :value="$admin->first_name"/>
                </div>
                <div class="col-md-6">
                    <x-form.input name="last_name" label="Last Name" :value="$admin->last_name"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <x-form.input name="birthday" label="Birthday" type="date" :value="$admin->birthday"/>
                </div>
                <div class="col-md-6">
                    <x-form.checkbox name="gender" label="Gender" :options="['male'=>'Male','female'=>'Female']" :checked="$admin->gender"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4">
                    <x-form.input name="street_address" label="Street Address" :value="$admin->street_address"/>
                </div>
                <div class="col-md-4">
                    <x-form.input name="city" label="City" :value="$admin->city"/>
                </div>
                <div class="col-md-4">
                    <x-form.input name="state" label="State" :value="$admin->state"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4">
                    <x-form.input name="postal_code" label="Postal Code" :value="$admin->postal_code"/>
                </div>
                <div class="col-md-4">
                    <x-form.select name="country" label="Country" :options="$countries" :selected="$admin->country"/>
                </div>
                <div class="col-md-4">
                    <x-form.select name="local" label="Local" :options="$locals" :selected="$admin->local"/>

                </div>
            </div>
            <x-form.checkbox  name="status" :options="['active' =>'Active' , 'draft'=>'Draft','archived' => 'Archived']" :checked="$admin->status" />

            <div class="form-row">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>



@endsection
