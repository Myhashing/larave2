@extends('layouts.layout')
@section('content')
    <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Category Profile
            </div>
            <div class="panel-body">
                <table class="table table-striped category-table">
                    <thead>
                    <th>Category</th>
                    </thead>
                    <tbody>

                    <tr>
                        <!-- Supplier Name -->
                    <tr class="table-text">
                        <td>Category name :</td>
                        <td>{{ $category->name }}</td>
                    </tr>
                    </tr>
                    <!-- Category Show Button-->
                    <td>
                        <form action="/categories/edit/{{ $category->id }}" method="get">
                            {{ csrf_field() }}
                            {{ method_field('show') }}
                            <button type="submit" class="btn btn-info">
                                Edit Category
                            </button>
                        </form>
                    </td>
                    <!-- Supplier Delete Button-->
                    <td>
                        <form action="/categories/{{ $category->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>
                                Delete Supplier</button>
                        </form>
                    </td>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- PRODUCTS CATALOG-->
        @foreach($category->products as $product)
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="/products/edit/{{ $product->id }}">
                    <img class="img-responsive" src="{{asset($product->images[0]->file)}}" alt="">
                </a>
                <td class="table-text">
                    Product Name: {{$product->name  }}
                </td>
                <br>
            </div>

        @endforeach
    </div>
@endsection