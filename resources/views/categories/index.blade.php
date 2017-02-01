@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Category
                </div>
                <div class="panel-body">
                    {{--Add new Category form--}}
                    <form action="/categories" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="category-name" class="col-sm-3 control-label"> Category name</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" id="category-name" class="form-control">
                            </div>
                        </div>
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i>Add category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div>
                    @if(count($categories)>0)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Current Category List
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped category-table">
                                    <thead>
                                    <th>Category</th>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <!-- Category Name -->
                                            <td class="table-text">
                                                <div>Category name : {{ $category->name }}</div>
                                            </td>

                                            <!-- Category Show Button-->
                                            <td>
                                                <form action="/categories/{{ $category->id }}" method="get">
                                                    {{ csrf_field() }}
                                                    {{ method_field('show') }}

                                                    <button type="submit" class="btn btn-info">

                                                        show category</button>
                                                </form>
                                            </td>
                                            <!-- Category Delete Button-->
                                            <td>
                                                <form action="/categories/{{ $category->id }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>
                                                        Delete Category</button>
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