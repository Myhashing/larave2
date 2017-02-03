@extends('layouts.layout')
@section('content')
<div class="col-sm-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            New Product
        </div>
        <div class="panel-body">
{{--Form to add new product--}}
            @if(Session::has('success'))
                <div class="alert-box success">
                    <h2>{!! Session::get('success') !!}</h2>
                </div>
            @endif
            {!! Form::open(array('url'=>'/products','method'=>'POST', 'files'=>true,'class'=>'form-horizontal')) !!}
            {{ csrf_field() }}
{{-- Form for inseret new product : name,web_link,price,moq,sample,categories,supplier,images--}}
            <div class="form-group">
                <label for="product-name" class="col-sm-3 control-label"> Product SKU</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="product-name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="product-web" class="col-sm-3 control-label"> Product Web</label>
                <div class="col-sm-6">
                    <input type="text" name="web_link" id="product-web" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="product-price" class="col-sm-3 control-label"> Price</label>
                <div class="col-sm-1">
                    <input type="text" name="price" id="price" class="form-control">
                </div>
                <label for="product-moq" class="col-sm-1 control-label"> MOQ</label>
                <div class="col-sm-1">
                    <input type="text" name="moq" id="moq" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="product-sample" class="col-sm-3 control-label"> Sample </label>
                <div class="col-sm-1">
                    <label class="radio"><input type="radio" name="sample" id="sample" value=true>Yes</label>
                    <label class="radio"><input type="radio" name="sample" id="sample" value=false>No</label>
                </div>
            </div>
            <div class="form-group">
                <label for="product-remarks" class="col-sm-3 control-label"> Product remarks</label>
                <div class="col-sm-6">
                    <input type="text" name="remarks" id="remarks" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="product-colors" class="col-sm-3 control-label"> Product Color</label>
                <div class="col-sm-6">
                    <input type="text" name="colors" id="colors" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="categories" class="col-sm-3" id="categories">Categories</label>
                <div class="col-sm-6">
                    @foreach($categoriesList as $category)
                        <input type="checkbox" name="categories[]" multiple class="form-control" id="categories[]"
                               value="{{ $category['id'] }}">{{ $category['name'] }}
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="supplier-name" class="col-sm-3" id="supplier-name">Suppler name</label>
                <div class="col-sm-6">
                    <select name="supplier[]" multiple class="form-control" id="supplier-list">
                        @foreach($supplierList as $supplier)
                            <option value="{{ $supplier['id'] }}" {{ $supplier['selected'] }}>{{ $supplier['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    {!! Form::file('images[]', array('multiple'=>true)) !!}
                    <p class="errors">{!!$errors->first('images')!!}</p>
                    @if(Session::has('error'))
                        <p class="errors">{!! Session::get('error') !!}</p>
                    @endif
                </div>
            </div>
            <div>
                <div class="col-sm-offset-3 col-sm-6">
                    {!! Form::submit('Submit', array('class'=>'btn btn-default')) !!}
                    {!! Form::close() !!}

                    {{--End Form--}}
                </div>
            </div>
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
                                        <!-- Product Name -->
                                        <td class="table-text">
                                            Product name : {{ $product->name }}
                                            <br><br>
                                            Product Web  : {{ $product->web_link }}
                                            <br><br>
                                            Product Price: {{ $product->price }}
                                            <br><br>
                                            Product MOQ  : {{ $product->moq }}
                                            <br><br>
                                            {{--TODO: clean up code and call right supplier. dont load full list--}}
                                            @foreach($supplierList as $supplier)
                                                @if($supplier->id=== $product->supplier_id)
                                                    supplier name:  {{ $supplier->name }}
                                                @endif
                                            @endforeach
                                            <br><br>
                                            {{--image count in gallery--}}
                                            Product images count:{{ count($product->images) }}
                                            <br><br>
                                            @if(Session::has('success'))
                                                <div class="alert-box success">
                                                    <h2>{!! Session::get('success') !!}</h2>
                                                </div>
                                            @endif
                                        </td>
                                        {{--show one photo as thumbnail--}}
                                        {{--TODO : fix the href to open all photos--}}
                                        <td>
                                            <a class="thumbnail" href="{{asset($product->images[0]->file)}}">
                                                <img class="img-responsive" src="{{asset($product->images[0]->file)}}" alt="">
                                            </a>
                                        </td>

                                        <td>
                                            <!-- Product show Button-->
                                            <form action="/products/{{ $product->id }}" method="get">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-info">
                                                    <i class="fa fa-btn fa-box"></i>
                                                    show Product
                                                </button>
                                            </form>
                                            <br>
                                            {{--Edit button--}}
                                            <form action="/products/edit/{{ $product->id }}" method="get">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-info">
                                                    <i class="fa fa-btn fa-box"></i>
                                                    Edit Product
                                                </button>
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
                                            {{--#Add Order button--}}
                                            <form target="_blank" action="/orders/add/{{ $product->id }}" method="post">
                                                {{ csrf_field() }}
                                                <label>Quantity:</label>
                                                <input name="quantity" id="product-quantity" type="text">
                                                <br>
                                                <label>Order Date:</label>
                                                <input name="order_date" id="order_date" type="date">
                                                <br>
                                                <button type="submit" class="btn btn-info">
                                                    <i class="fa fa-btn fa-box"></i>
                                                    Add order
                                                </button>
                                            </form>
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
    </div>
</div>
@endsection