@extends('layouts.dashboard')
@section('title_section' ,'Add Category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Add Category</li>
@endsection
@section('content')

    <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data" >
    @csrf
        @include('Dashboard.categories.form', [
    'button_label' => 'Create'
])
</form>
@endsection
