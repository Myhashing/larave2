@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">

        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Product Profile
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped supplier-table">
                                <thead>
                                <th>Product</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <!-- Product Name -->
                                    <td class="table-text">
                                        <div>Product name : {{ $product->name }}</div>
                                    </td>
                                    <td class="table-text">
                                       <div> Product Web:  {{ $product->web_link }}</div>
                                    </td>
                                    {{--add new image--}}

                                <!-- related products Show Button
                                <td>
                                    <form action="/suppliers/products/" method="post">

                                        <button type="submit" class="btn btn-info">

                                            show related products</button>
                                    </form>
                                </td> -->

                                </tr>
                                </tbody>
                            </table>


                        </div>
                        @include('products.error-notification')
                        {!! Form::open(['url'=>'/image', 'method'=>'POST', 'files'=>'true']) !!}

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
                        {{--TODO send the product id into post variable --}}

                        <input class="form-control" name="product_id" value="{{$product->id}}">

                        <button type="submit" class="btn btn-primary">Upload</button>
                        <a href="{{ url('/image') }}" class="btn btn-warning">Cancel</a>

                        {!! Form::close() !!}
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