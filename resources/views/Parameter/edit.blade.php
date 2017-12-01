@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>編輯</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('Parameter.index') }}">返回</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($ParameterControllers, ['method' => 'PATCH','route' => ['Parameter.update', $ParameterControllers->Parameter_id]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>參數名稱:</strong>
                {!! Form::text('Parameter_name', null,array ('placeholder' => '' ,'class'=> 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>參數值:</strong>
                {!! Form::text('Parameter', null, array('placeholder' => '參數值','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>建立者編號:</strong>
                {!! Form::text('Create_id', null, array('placeholder' => '','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>建立日期:</strong>
                {!! Form::text('Create_time', null, array('placeholder' => '','class' => 'form-control')) !!}
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>說明:</strong>
                {!! Form::text('Description', null, array('placeholder' => '','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>狀態:</strong>
                {!! Form::text('Status', null, array('placeholder' => '','class' => 'form-control')) !!}
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">送出</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection