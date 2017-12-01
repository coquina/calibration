@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a href="{{ route('Group.index') }}"> 群組管理</a> &raquo;  新增群組</h2>
            </div>
        </div>
    </div>
<hr>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            {{--<strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('route' => 'Group.store','method'=>'POST')) !!}
    <div class="row">


        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>群組編號:</strong>
                {!! Form::text('Group_No', null, array('placeholder' => '群組編號','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>群組名稱:</strong>
                {!! Form::text('Group_name', null, array('placeholder' => '群組名稱','class' => 'form-control')) !!}
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立者編號:</strong>
                <input type="text" class="form-control"  VALUE="<?php echo Auth::user()->Member_name?>" required readonly>
                <input type="hidden" class="form-control" id="Create_id" name="Create_id"  VALUE="<?php echo Auth::user()->id?>" required readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>說明:</strong>
                {!! Form::text('Description', null, array('placeholder' => '說明','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>狀態:</strong>
                <select name="Status" id="Status" class="form-control">
                    <option  value="1">啟用</option>
                    <option  value="0">未啟用</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <?php
                date_default_timezone_set('Asia/Taipei');
                $datetime = date ("Y-m-d H:i:s");?>
                <input type="hidden" name="Create_time" value=<?php echo $datetime;?>>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <a class="btn btn-warning"  onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</a>
            <br><br>
        </div>

    </div>
    {!! Form::close() !!}

@endsection