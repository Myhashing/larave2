@extends('layouts.layout')
@section('content')
    <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Current Supplier Profile
            </div>
        </div>
        <div class="panel-body">
            <div class="panel-body">
                {{--Form to add new Supplier--}}
                @if(Session::has('success'))
                    <div class="alert-box success">
                        <h2>{!! Session::get('success') !!}</h2>
                    </div>
                @endif
                {{--TODO: add supplier edit to form--}}
                <form action="/suppliers/edit/{{$supplier->id}}" method="post" files="true" class="form-horizontal"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="supplier-name" class="col-sm-3 control-label"> Supplier name</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="supplier-name" class="form-control"
                                   value="{{$supplier->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="supplier-web" class="col-sm-3 control-label"> Supplier Web</label>
                        <div class="col-sm-6">
                            <input type="text" name="web" id="supplier-web" class="form-control"
                                   value="{{$supplier->web}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="supplier-person" class="col-sm-3 control-label"> Supplier Web</label>
                        <div class="col-sm-6">
                            <input type="text" name="person" id="supplier-person" class="form-control"
                                   value="{{$supplier->person}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="supplier-phone" class="col-sm-3 control-label"> Supplier Phone:</label>
                        <div class="col-sm-6">
                            <input type="text" name="phone" id="supplier-phone" class="form-control"
                                   value="{{$supplier->phone}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="supplier-email" class="col-sm-3 control-label"> Supplier email:</label>
                        <div class="col-sm-6">
                            <input type="text" name="email" id="supplier-email" class="form-control"
                                   value="{{$supplier->email}}">
                        </div>
                    </div>

                    <div>
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-btn fa-box"></i>
                                Edit Supplier
                            </button>
                        </div>
                    </div>
                </form>
                {{--End Form--}}
                <form action="/suppliers/{{ $supplier->id }}" method="get">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-btn fa-info"></i>
                        Back to Supplier
                    </button>
                </form>

            </div>

        </div>
    </div>
@endsection