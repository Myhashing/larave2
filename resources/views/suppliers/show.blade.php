@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">

        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div>
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
                                <td class="table-text">
                                    <div>Supplier name : {{ $supplier->name }}</div>
                                </td>
                                <td class="table-text">
                                   Supplier Web:  {{ $supplier->web }}
                                </td>
                               <!-- related products Show Button
                                <td>
                                    <form action="/suppliers/products/" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('show') }}

                                        <button type="submit" class="btn btn-info">

                                            show related products</button>
                                    </form>
                                </td> -->

                            </tr>
                                </tbody>
                    </table>

                        </div>
                        </div>

                </div>
            </div>
        </div>
        <!-- PRODUCTS CATALOG-->
        @foreach($supplier->products as $product)
        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
            <a class="thumbnail" href="#">
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