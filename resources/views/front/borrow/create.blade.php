<x-front-layout :title='$product->name'>
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{$product->name}}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{route('front.products.index')}}">Products</a></li>
                            <li>{{$product->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>
    <section class="item-details section">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

    <form action="{{route('borrowing.store')}}" method="post" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="from_date" class="form-label">From Date:</label>
            <input type="date" id="from_date" name="from_date" class="form-control" required>
        </div>


        <div class="mb-3">
            <label for="to_date" class="form-label">To Date:</label>
            <input type="date" id="to_date" name="to_date" class="form-control" required>
        </div>
        <input type="hidden" value="{{ $product->id }}" name="product_id">

        <button type="submit" class="btn btn-primary">Submit Dates</button>
    </form>
        </div>
    </section>
</x-front-layout>
