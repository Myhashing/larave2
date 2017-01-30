@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Product
                </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'apply/multiple_upload','method'=>'POST','files'=>true)) !!}
                {!! Form::file('images[]', array('multiple'=>true)) !!}
                <div class="text-content">
                    <div class="span7 offset1">
                        @if(Session::has('success'))
                            <div class="alert-box success">
                                <h2>{!! Session::get('success') !!}</h2>
                            </div>
                            @endif
                        <div class="secure">Upload form</div>
                        {!! Form::open(array('url'=>'apply/multiple_upload','method'=>'POST','files'=>true) !!}
                        <div class="control-group">
                            <div class="controls">
                                {!! Form::file('images[]',array('multiple'=>true)) !!}
                                <p class="errors">{!! $errors->first('images') !!}</p>
                                @if(Session::has('error'))
                                    <p class="errors">{!! Session::get('error') !!}</p>
                                    @endif
                            </div>
                        </div>
                        {!! Form::submit('Submit',array('class'=>'send-btn')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>



                <form action="/products" method="post" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="product-name" class="col-sm-3 control-label"> Product name</label>
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
                        <label for="supplier-name" class="col-sm-3" id="supplier-name">Suppler name</label>
                        <div class="col-sm-6">
                            <select name="supplier[]" multiple class="form-control" id="supplier-list">
                                @foreach($supplierList as $supplier)
                                    <option value="{{ $supplier['id'] }}" {{ $supplier['selected'] }}>{{ $supplier['name'] }}</option>
                                @endforeach
                            </select>                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userfile">Image File</label>
                        <input type="file" class="form-control" name="userfile">
                    </div>

                    <div class="form-group">
                        <label for="caption">Caption</label>
                        <input type="text" class="form-control" name="caption" value="">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div>
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-plus"></i>Add product
                            </button>
                        </div>
                    </div>
                </form>
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
                                    <div>Product name : {{ $product->name }}</div>
                                </td>
                                <td class="table-text">
                                   Product Web:  {{ $product->web_link }}
                                </td>
                                {{--TODO: clean up code and call right supplier. dont load full list--}}

                                <td class="table-text">
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
                                <td class="table-text">
                                    Product images count:  {{ count($product->images) }}
                                </td>

                                <!-- Product show Button-->
                                <td>
                                    <form action="/products/{{ $product->id }}" method="get">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-info">
                                            <i class="fa fa-btn fa-box"></i>
                                            show Product</button>
                                    </form>
                                </td>
                                <!-- Product Delete Button-->
                                <td>
                                    <form action="/products/{{ $product->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>
                                            Delete Product</button>
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