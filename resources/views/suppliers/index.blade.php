@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Supplier
                </div>
            <div class="panel-body">
                <form action="/suppliers" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="supplier-name" class="col-sm-3 control-label"> Supplier name</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="supplier-name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="supplier-web" class="col-sm-3 control-label"> Supplier Web</label>
                        <div class="col-sm-6">
                            <input type="text" name="web" id="supplier-web" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-plus"></i>Add supplier
                            </button>
                        </div>
                    </div>
                </form>
            </div>

                <div>
                    @if(count($suppliers1)>0)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Current Supplier List
                            </div>
                        <div class="panel-body">
                            <table class="table table-striped supplier-table">
                                <thead>
                                <th>Supplier</th>
                                </thead>
                                <tbody>
                        @foreach($suppliers1 as $supplier)
                            <tr>
                                <!-- Supplier Name -->
                                <td class="table-text">
                                    <div>Supplier name : {{ $supplier->name }}</div>
                                </td>
                                <td class="table-text">
                                   Supplier Web:  {{ $supplier->web }}
                                </td>
                                <!-- Supplier Show Button-->
                                <td>
                                    <form action="/suppliers/{{ $supplier->id }}" method="get">
                                        {{ csrf_field() }}
                                        {{ method_field('show') }}

                                        <button type="submit" class="btn btn-info">

                                            show Supplier</button>
                                    </form>
                                </td>
                                <!-- Supplier Delete Button-->
                                <td>
                                    <form action="/suppliers/{{ $supplier->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>
                                            Delete Supplier</button>
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