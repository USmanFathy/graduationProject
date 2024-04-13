@extends('layouts.dashboard')
@section('title_section' ,'Borrow Requests')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Borrow Requests</li>
@endsection
@section('content')



    <x-alert type="danger"/>

    <table class="table table-striped table-info table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Product Name</th>
            <th>User NAme</th>
            <th>Start Date </th>
            <th>To Date</th>
            <th>status</th>
            <th>Created At</th>


        </tr>
        </thead>
        <tbody>

        @forelse($borrows as $borrow)
            <tr>
                <td>{{$borrow->id}}</td>
                <td>{{$borrow->product->name}}</td>
                <td>{{$borrow->user->name}}</td>
                <td>{{$borrow->from_date}}</td>
                <td>{{$borrow->to_date}}</td>
                <td>{{$borrow->status}}</td>
                <td>{{$borrow->created_at}}</td>
                <th colspan="3"></th>


                <td>
                    <form action="{{route('borrows.destroy' , $borrow->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
               @if($borrow->status == 'pending')
                    <td>
                        <form action="{{route('borrows.approve' , $borrow->id)}}" method="post">
                            @csrf
                            <button class="btn btn-sm btn-outline-success">Approve</button>
                        </form>

                    </td>
                    <td>
                        <form action="{{route('borrows.reject' , $borrow->id)}}" method="post">
                            @csrf
                            <button class="btn btn-sm btn-outline-warning">Reject</button>
                        </form>
                    </td>
               @endif
            </tr>
        @empty
            <tr>
                <td colspan="10" >No borrows Defined .</td>
            </tr>
        @endforelse


        </tbody>
    </table>

    {{$borrows->withQueryString()->links()}}

    <!-- /.row -->

@endsection
