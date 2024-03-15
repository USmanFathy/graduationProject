@extends('layouts.dashboard')
@section('title_section' ,'DashBoard')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">DashBoard</li>
@endsection
    @section('content')
        <div class="container py-5">
            <h1 class="text-center mb-4">Statistics</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-light mb-4">
                        <div class="card-body text-center">
                            <h2>Users Count</h2>
                            <p>{{ $usersCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light mb-4">
                        <div class="card-body text-center">
                            <h2>Books Count </h2>
                            <p>{{ $booksCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light mb-4">
                        <div class="card-body text-center">
                            <h2>Categories Count</h2>
                            <p>{{ $categoriesCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light mb-4">
                        <div class="card-body text-center">
                            <h2>Admin Count</h2>
                            <p>{{ $adminsCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
