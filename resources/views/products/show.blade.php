@extends('layouts.layout')
@section('content')
    <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Product Profile
            </div>
            {{--TODO : make the photo gallery and fix the lightbox--}}
            <div class="panel-body">
                <table class="table table-striped supplier-table">
                    <thead>
                    <th>Product</th>
                    </thead>
                    <tbody>
                    <tr>
                        <!-- Product Name -->
                    <tr class="table-text">
                        <td>Product name :</td>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr class="table-text">
                        <td> Product Web:</td>
                        <td>{{ $product->web_link }}</td>
                    </tr>
                    <tr class="table-text">
                        <td> Product Price:</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                    <tr class="table-text">
                        <td> Product MOQ:</td>
                        <td>{{ $product->moq }}</td>
                    </tr>
                    <tr class="table-text">
                        <td> Sample:</td>
                        <td>{{ $product->sample }}</td>
                    </tr>
                    <tr class="table-text">
                        <td> Sample:</td>
                        {{dd($product->Colors()->get(1))}}
                        <td>{{ $product->Colors()->color }}</td>
                    </tr>
                    <tr class="table-text">
                        <td> Supplier:</td>
                        <td>{{ $supplier->name }}</td>
                    </tr>
                    @foreach($product->remarks as $remark)
                        <tr class="table-text">
                            <td> Product Remaks:</td>
                            <td> {{ $remark->remark }}</td>
                        </tr>
                    @endforeach
                    <tr class="table-text">
                        <td> Product Categories:</td>
                        <td>
                            @foreach($product->categories as $category)
                                {{$category->name}},
                            @endforeach
                        </td>
                    </tr>


                    </tbody>
                </table>
                {{--Edit button--}}
                <table>
                    <tr>
                        <form action="/products/edit/{{ $product->id }}" method="get">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-btn fa-box"></i>
                                Edit Product
                            </button>
                        </form>
                    </tr>

                    <tr>
                        <!-- Product Delete Button-->
                        <form action="/products/{{ $product->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>
                                Delete Product
                            </button>
                        </form>
                    </tr>
                </table>
            </div>

        </div>
        <!-- PRODUCTS CATALOG-->
        <div id="gallery-images">
            @foreach($product->images as $image)
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" target="_blank" href="{{asset($image->file)}}" data-lightbox="roadtrip">
                        <img src="{{asset($image->file)}}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection