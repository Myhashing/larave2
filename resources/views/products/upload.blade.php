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

                    <div class="text-content">
                        <div class="span7 offset1">
                            @if(Session::has('success'))
                                <div class="alert-box success">
                                    <h2>{!! Session::get('success') !!}</h2>
                                </div>
                            @endif
                            <div class="secure">Upload form</div>
                            {!! Form::open(array('url'=>'apply/upload','method'=>'POST', 'files'=>true)) !!}
                            <div class="control-group">
                                <div class="controls">
                                    {!! Form::file('images[]', array('multiple'=>true)) !!}
                                    <p class="errors">{!!$errors->first('images')!!}</p>
                                    @if(Session::has('error'))
                                        <p class="errors">{!! Session::get('error') !!}</p>
                                    @endif
                                </div>
                            </div>
                            {!! Form::submit('Submit', array('class'=>'send-btn')) !!}
                            {!! Form::close() !!}
                        </div>

                    </div>
        </div>
    </div>

    @endsection