@extends('layouts.dashboard')
@section('title_section' ,'Book')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Add Book</li>
@endsection
@section('content')

    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" >
    @csrf
        @include('dashboard.products.form', [
    'button_label' => 'Create'
])
</form>
@endsection
