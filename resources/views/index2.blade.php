@extends('layouts.layout')
@section('content')


            <div class="col-sm-9">
                <!-- Display Product list-->
                <div>
                    @if(count($productList)>0)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Current Product List
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped product-table">
                                    <thead>
                                    <th>Product</th>
                                    </thead>
                                    <tbody>
                                    <!-- Display single product details-->
                                    @foreach($productList as $product)

                                        <tr>
                                            <td class="table-text">
                                            </td>
                                            <!-- Product Name -->
                                            <td class="table-text">
                                                Product name : {{ $product->name }}
                                                <br><br>
                                                Product Web:  {{ $product->web_link }}
                                                <br><br>
                                                {{--TODO: clean up code and call right supplier. dont load full list--}}

                                                @foreach($supplierList as $supplier)
                                                    @if($supplier->id=== $product->supplier_id)
                                                        supplier name:  {{ $supplier->name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            {{--show one photo as thumbnail--}}
                                            {{--TODO : fix the href to open all photos--}}

                                            <td>
                                                <a class="thumbnail" href="{{asset($product->images[0]->file)}}">
                                                    <img class="img-responsive" src="{{asset($product->images[0]->file)}}" alt="">
                                                </a>
                                            </td>

                                            <!-- Product show Button-->
                                            <td>
                                                <form action="/products/{{ $product->id }}" method="get">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-info">
                                                        <i class="fa fa-btn fa-box"></i>
                                                        show Product</button>
                                                </form>
                                                <br>
                                                {{--Edit button--}}

                                                <form action="/products/edit/{{ $product->id }}" method="get">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-info">
                                                        <i class="fa fa-btn fa-box"></i>
                                                        Edit Product</button>
                                                </form>
                                                <br>
                                                <!-- Product Delete Button-->
                                                <form action="/products/{{ $product->id }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>
                                                        Delete Product</button>
                                                </form>
                                                <br>
                                                {{--image count in gallery--}}
                                                Product images count:{{ count($product->images) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    @else
                                        <div>No resutls</div>
                                    @endif
                                </table>
                            </div>
                        </div>
                </div>
            </div>

@endsection