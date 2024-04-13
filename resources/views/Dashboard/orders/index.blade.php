@extends('layouts.dashboard')
@section('title_section' ,'orders')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Orders</li>
@endsection
@section('content')



    <x-alert type="danger"/>

    <table class="table table-striped table-info table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>User Name</th>
            <th>Total</th>
            <th>Product </th>
            <th>address </th>

        </tr>
        </thead>
        <tbody>

        @forelse($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->total}}</td>
                <td>
                    <a href="#" class="view-products" data-toggle="modal" data-target="#orderModal{{$order->id}}">View Products</a>

                </td>
                <td><a href="#" class="view-address" data-toggle="modal" data-target="#orderModalAddress{{$order->id}}">View Address</a></td>
            </tr>

            <div class="modal fade" id="orderModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel{{$order->id}}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderModalLabel{{$order->id}}">Order {{$order->id}} Products</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                @foreach($order->products as $product)
                                    <li>Product Name :{{$product->$product_name}}</li>
                                    <li>Product Price :{{$product->$product_price}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="orderModalAddress{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel{{$order->id}}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderModalLabel{{$order->id}}">Order {{$order->id}} Products</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                @foreach($order->addresses  as $address)
                                    <li>Country :{{$address->country}}</li>
                                    <li>City :{{$address->city}}</li>
                                    <li>Street Address :{{$address->street_address}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <tr>
                <td colspan="5" >No Orders Defined .</td>
            </tr>
        @endforelse



        </tbody>
    </table>

    {{$orders->withQueryString()->links()}}

    <!-- /.row -->

@endsection

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.view-products').click(function(){
                var orderId = $(this).data('order-id');
                var modal = $('#orderModal'+orderId);
                modal.modal('show');
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.view-address').click(function(){
                var orderId = $(this).data('order-id');
                var modal = $('#orderModalAddress'+orderId);
                modal.modal('show');
            });
        });
    </script>

@endpush
