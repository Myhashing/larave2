 @extends('layouts.app')
@section('content')
    <!-- Bootstrap Boilerplate... -->
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Current Product Profile
                    </div>
                    <div class="panel-body">
                        {{--Form to add new product--}}
                        @if(Session::has('success'))
                            <div class="alert-box success">
                                <h2>{!! Session::get('success') !!}</h2>
                            </div>
                        @endif
                        <form action="/products/edit/{{$product->id}}" method="post" files="true" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="product-name" class="col-sm-3 control-label"> Product SKU</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" id="product-name" class="form-control" value="{{$product->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product-web" class="col-sm-3 control-label"> Product Web</label>
                                <div class="col-sm-6">
                                    <input type="text" name="web_link" id="product-web" class="form-control" value="{{$product->web_link}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product-price" class="col-sm-3 control-label"> Price</label>
                                <div class="col-sm-2">
                                    <input type="text" name="price" id="price" class="form-control" value="{{$product->price}}">
                                </div>
                                <label for="product-moq" class="col-sm-1 control-label"> MOQ</label>
                                <div class="col-sm-2">
                                    <input type="text" name="moq" id="moq" class="form-control" value="{{$product->moq}}">
                                </div>
                                <div class="form-group">
                                    <label for="product-sample" class="col-sm-3 control-label"> Sample </label>
                                    <div class="col-sm-1">
                                        <label class="radio"><input type="radio" name="sample" id="sample"
                                                                    @if($product->sample == "on")
                                                                    checked
                                                                @endif>
                                            Yes</label>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label for="product-colors" class="col-sm-3 control-label"> Product Color</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="colors" id="colors" class="form-control" value="@foreach($product->Colors as $color){{$color->color}};@endforeach">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="col-sm-3" id="categories">Remarks</label>
                                <div class="col-sm-6">
                                    @foreach($product->remarks as $remark)
                                        <input type="text" name="remarks[]" multiple class="form-control" id="categories[]"
                                               value="{{ $remark['remark'] }}">
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="supplier-name" class="col-sm-3" id="supplier-name">Suppler name</label>
                                <div class="col-sm-6">
                                    <select name="supplier[]" multiple class="form-control" id="supplier-list[]">
                                        @foreach($supplierList as $supplier)
                                            <option value="{{ $supplier['id'] }}"
                                                    @if($supplier['name'] == $selcSupplier->name)
                                                    selected
                                                    @endif>{{ $supplier['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="col-sm-3" id="categories">Categories</label>
                                <div class="col-sm-6">
                                    @foreach($categoriesList as $category)
                                        <input type="checkbox" name="categories[]" multiple class="form-control" id="categories[]"
                                               value="{{ $category['id'] }}"
                                               @foreach($product->categories as $selectedCategory)
                                               @if($category->name == $selectedCategory->name )
                                               checked
                                                @endif
                                                @endforeach>
                                        {{ $category['name'] }}
                                    @endforeach
                                </div>
                            </div>
                            <div class="controls">
                                {!! Form::file('images[]', array('multiple'=>true)) !!}
                                <p class="errors">{!!$errors->first('images')!!}</p>
                                @if(Session::has('error'))
                                    <p class="errors">{!! Session::get('error') !!}</p>
                                @endif
                            </div>
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-btn fa-box"></i>
                                    Edit Product</button>
                            </div>
                        </form>
                        {{--End Form--}}
                        <form action="/products/{{ $product->id }}" method="get">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-btn fa-info"></i>
                                Back to Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{--TODO : make the photo gallery and fix the lightbox--}}
    <!-- PRODUCTS CATALOG-->

        <div id="gallery-images">
            @foreach($product->images as $image)
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="{{asset($image->file)}}"  data-lightbox="roadtrip">
                        <img src="{{asset($image->file)}}" >
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection