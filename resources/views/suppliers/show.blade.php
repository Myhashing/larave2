@extends('layouts.layout')
@section('content')
    <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Supplier Profile
            </div>
            <div class="panel-body">
                <table class="table table-striped supplier-table">
                    <thead>
                    <th>Supplier</th>
                    </thead>
                    <tbody>

                    <tr>
                        <!-- Supplier Name -->
                    <tr class="table-text">
                        <td>Supplier name :</td>
                        <td>{{ $supplier->name }}</td>
                    </tr>
                    <tr class="table-text">
                        <td>Supplier Web:</td>
                        <td>{{ $supplier->web }}</td>
                    </tr>
                    <!-- Supplier Name -->
                    <tr class="table-text">
                        <td>Supplier Person :</td>
                        <td>{{ $supplier->person }}</td>
                    </tr>
                    <tr class="table-text">
                        <td>Supplier phone:</td>
                        <td>{{ $supplier->phone }}</td>
                    </tr>
                    <!-- Supplier Name -->
                    <tr class="table-text">
                        <td>Supplier email :</td>
                        <td>{{ $supplier->email }}</td>
                    </tr>
                    <!-- Supplier Remarks -->
                    <tr class="table-text">
                        <td>Supplier Remarks :</td>
                        <td>{{ $supplier->remarks }}</td>
                    </tr>

                    </tr>
                    <!-- Supplier Show Button-->
                    <td>
                        <form action="/suppliers/edit/{{ $supplier->id }}" method="get">
                            {{ csrf_field() }}
                            {{ method_field('show') }}
                            <button type="submit" class="btn btn-info">
                                Edit Supplier
                            </button>
                        </form>
                    </td>
                    <!-- Supplier Delete Button-->
                    <td>
                        <form action="/suppliers/{{ $supplier->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>
                                Delete Supplier
                            </button>
                        </form>
                    </td>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- PRODUCTS CATALOG-->
        @foreach($supplier->products as $product)
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="/products/edit/{{ $product->id }}">
                    <img class="img-responsive" src="{{asset($product->images[0]->file)}}" alt="">
                </a>
                <td class="table-text">
                    Product Name: {{$product->name  }}
                </td>
                <br>
                <td class="table-text">
                    Product Name: {{$product->web_link  }}
                </td>
                <br>
            </div>

        @endforeach
    </div>
@endsection