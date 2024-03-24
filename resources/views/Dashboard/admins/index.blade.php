@extends('layouts.dashboard')
@section('title_section' ,'Admin')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admin</li>
@endsection
@section('content')



    <x-alert type="danger"/>

    <form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Search By Name" class="mx-2" :value="request('name')"/>
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status')== 'active')>Active</option>
            <option value="archived" @selected(request('status')== 'archived')>Archived</option>
            <option value="draft" @selected(request('status')== 'draft')>Draft</option>

        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>
    <table class="table table-striped table-info table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>UserName</th>
            <th>PhoneNumber</th>
            <th>status</th>
            <th>Created At</th>


        </tr>
        </thead>
        <tbody>

        @forelse($admins as $admin)
            <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->username}}</td>
                <td>{{$admin->phone_number}}</td>
                <td>{{$admin->status}}</td>
                <td>{{$admin->created_at}}</td>

                <td>
                    <form action="{{route('admins.destroy' , $admin->id)}}" method="post">
                        @csrf
                      {{--  form method spoofing--}}
                        @method('delete')
                        <button class="btn btn-sm btn-outline-danger">Delete</button>


                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" >No admins Defined .</td>
            </tr>
        @endforelse


        </tbody>
    </table>

    {{$admins->withQueryString()->links()}}

    <!-- /.row -->

@endsection
