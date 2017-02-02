@extends('layouts.layout')
@section('content')
    <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Current Category
            </div>
            <div class="panel-body">
                <div class="panel-body">
                    {{--Form to add new Category--}}
                    @if(Session::has('success'))
                        <div class="alert-box success">
                            <h2>{!! Session::get('success') !!}</h2>
                        </div>
                    @endif
                    {{--TODO: add category edit to form--}}
                    <form action="/categories/edit/{{$category->id}}" method="post" files="true" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="category-name" class="col-sm-3 control-label"> Category name</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" id="category-name" class="form-control" value="{{$category->name}}">
                            </div>
                        </div>
                        <div>
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-btn fa-box"></i>
                                    Edit Category</button>
                            </div>
                        </div>
                    </form>
                    {{--End Form--}}
                    <form action="/categories/{{ $category->id }}" method="get">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-btn fa-info"></i>
                            Back to Category</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection