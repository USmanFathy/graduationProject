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
                <x-form.input name="name" label="Name" :value="$user->name"/>
            </div>
            <div class="col-md-6">
                <x-form.input name="email" label="Last Name" :value="$user->email"/>
            </div>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>


@endsection
