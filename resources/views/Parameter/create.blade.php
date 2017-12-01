@extends('layouts.default')
@section('content')
    <?php
    use Illuminate\Support\Facades\Auth;
    date_default_timezone_set('Asia/Taipei');
    $date = date ("Y-m-d");?>
    <style>
        hr {
            border:0; height:2px; background-color:#FFAC12;
            color:#d4d4d4
        }
    </style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a onclick=history.back()><font color="gray">參數管理&nbsp;</font></a><font color="gray" size="5"><span class="glyphicon glyphicon-menu-right"></span></font><font color="black">&nbsp;新增參數</font></h2>
            </div>
        </div>
    </div><br><br>
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
    {!! Form::open(array('route' => 'Parameter.store','method'=>'POST')) !!}
    <div class="row">
        <strong><font color="#FFAC12" size="5">參 數 資 料</font></strong>
        <HR><br>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong><font color="#FF0000">* </font>參數名稱:</strong>
                        {!! Form::text('Parameter_name', null, array('placeholder' => '','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong><font color="#FF0000">* </font>參數值:</strong>
                        {!! Form::text('Parameter', null, array('placeholder' => '','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>說明:</strong>
                        {!! Form::text('Description', null, array('placeholder' => '','class' => 'form-control')) !!}
                    </div>
                </div>
        <input type="hidden" class="form-control" name="Status" id="Status" value="1">
        <input type="hidden" id="Create_id" name="Create_id" value="<?php echo Auth::user()->id?>" class="form-control">
        <input type="hidden" class="form-control" id="Create_time" name="Create_time" value="<?php echo $date?>">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <button class="btn btn-warning"  href="{{ route('machine.index') }}"><span class="glyphicon glyphicon-log-out"></span> 返回</button>
            <br><br>
        </div>
     </div>
    {!! Form::close() !!}


@endsection