@extends('layouts.dashboard')
@section('title_section' ,'Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your Form -->
                    <form action="{{route('categories.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Choose File</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="mb-5">
        <button type="submit" class="btn btn-sm btn-outline-success mr-2"  id="importButton">Import By Excel</button>
        <a href="{{route('categories.create')}}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
        <a href="{{route('categories.trash')}}" class="btn btn-sm btn-outline-dark">Trash</a>
    </div>
    <x-alert type="success"/>
    <x-alert type="info"/>
    <x-alert type="danger"/>

    <form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Search By Name" class="mx-2" :value="request('name')"/>
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status')== 'active')>Active</option>
            <option value="archived" @selected(request('status')== 'archived')>Archived</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>
    <table class="table table-striped table-info table-hover">
        <thead>
        <tr>
            <th>Image</th>
            <th>Id</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Books</th>
            <th>Status</th>
            <th>Created At</th>
            <th ></th>
            <th colspan="2"></th>

        </tr>
        </thead>
        <tbody>

        @forelse($categories as $category)
            <tr>
                <td><img height="50" src="{{asset('storage/'.$category->image)}}"></td>
                <td>{{$category->id}}</td>
                <td><a href="{{route('categories.show' , $category->id)}}">{{$category->name}}</a></td>
                <td>{{$category->parent->name }}</td>
                <td>{{$category->products_count}}</td>
                <td>{{$category->status}}</td>
                <td>{{$category->created_at}}</td>
                @if($category->featured == 0)
                    <td>
                        <form action="{{route('categories.feature' , $category->id)}}" method="post">
                            @csrf
                            {{--  form method spoofing--}}
                            <button class="btn btn-sm btn-outline-success">Feature</button>


                        </form>
                    </td>
                @else

                    <td>
                        <form action="{{route('categories.disable-feature' , $category->id)}}" method="post">
                            @csrf
                            {{--  form method spoofing--}}
                            <button class="btn btn-sm btn-outline-danger">Disable Feature</button>


                        </form>
                    </td>
                @endif
                <td>
                <a href="{{route('categories.edit' , $category->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                <form action="{{route('categories.destroy' , $category->id)}}" method="post">
                        @csrf
                        {{--  form method spoofing--}}
                        @method('delete')
                        <button class="btn btn-sm btn-outline-danger">Delete</button>


                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" >No Categories Defined .</td>
            </tr>
        @endforelse


        </tbody>
    </table>

    {{$categories->withQueryString()->links()}}

    <!-- /.row -->

@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-jzWKn4/f+8R3z/z12DJUqYQf6pbiEqJ2oY0XoWdeKbQrWfmCFBVq0Q6iOx8/LxjH" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('#importButton').click(function(){
                $('#importModal').modal('show');
            });
        });
    </script>

@endpush
