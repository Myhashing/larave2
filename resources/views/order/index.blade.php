@extends('layouts.layout')
@section('content')
    <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Product
            </div>
            <div class="panel-body">
                @foreach($orders as $order)
                    <table class="table table-striped supplier-table">
                        <thead>
                        <th>Orders</th>
                        </thead>
                        <tbody>
                        <tr>
                        @foreach($products as $product)
                            @if($product->id == $order->product_id)
                                <!-- Supplier Name -->
                        <tr class="table-text">
                            <td>Product name :</td>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr class="table-text">
                            <td>Quantity:</td>
                            <td>{{ $order->quantity }}</td>
                        </tr>
                        <tr class="table-text">
                            <td>Order date:</td>
                            <td>{{ $order->order_date }}</td>
                        </tr>
                        <tr class="table-text">
                            <td>Price:</td>
                            <td>${{ $product->price }}</td>
                        </tr>
                        <tr class="table-text">
                            <td>
                                <a class="thumbnail" href="{{asset($product->images[0]->file)}}">
                                    <img class="img-responsive" src="{{asset($product->images[0]->file)}}" alt="">
                                </a>
                            </td>
                            <td>
                                <!-- Order Delete Button-->
                                <form action="/orders/{{ $order->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>
                                        Delete Order
                                    </button>
                                </form>
                                <br>
                                <!-- Order Edit Button-->
                                <form action="/orders/{{ $order->id }}" method="get">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-btn fa-trash"></i>
                                        Edit Order
                                    </button>
                                </form>
                            </td>

                        </tr>
                        </tr>
                        </tbody>
                    </table>
            </div>
            @endif
            @endforeach
            @endforeach
        </div>
    </div>
@endsection