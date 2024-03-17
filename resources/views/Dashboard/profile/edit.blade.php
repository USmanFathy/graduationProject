@extends('layouts.dashboard')
@section('title_section' ,'Edit Profile')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection
@section('content')

    <x-alert type="success"/>

    <form action="{{route('dashboard.profile.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="first_name" label="Name" :value="$user->first_name"/>
            </div>
            <div class="col-md-6">
                <x-form.input name="last_name" label="Last Name" :value="$user->last_name"/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="birthday" label="Birthday" type="date" :value="$user->birthday"/>
            </div>
            <div class="col-md-6">
                <x-form.checkbox name="gender" label="Gender" :options="['male'=>'Male','female'=>'Female']" :checked="$user->gender"/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <x-form.input name="street_address" label="Street Address" :value="$user->street_address"/>
            </div>
            <div class="col-md-4">
                <x-form.input name="city" label="City" :value="$user->city"/>
            </div>
            <div class="col-md-4">
                <x-form.input name="state" label="State" :value="$user->state"/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <x-form.input name="postal_code" label="Postal Code" :value="$user->postal_code"/>
            </div>
            <div class="col-md-4">
                <x-form.select name="country" label="Country" :options="$countries" :selected="$user->country"/>
            </div>
            <div class="col-md-4">
                <x-form.select name="local" label="Local" :options="$locals" :selected="$user->local"/>

            </div>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>


@endsection
