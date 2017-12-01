@extends('layouts.default')
@section('content')
    <style>
        hr {
            border:0; height:2px; background-color:#FFAC12;
            color:#d4d4d4
        }
    </style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a onclick=history.back()> <font color="black">計畫管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 編輯計畫</h2>
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
    <br><br><br>

    {!! Form::model($projects, ['method' => 'PATCH','route' => ['project.update', $projects->Project_id]]) !!}
    <strong><font color="#FFAC12" size="5">計 畫 資 料</font></strong>
    <HR><br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>計劃編號:</strong>
                <input class="form-control" type="input" name="Project_No" value=<?php echo $projects->Project_No?> readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>計劃名稱:</strong>
                {!! Form::text('Project_name', null, array('placeholder' => '機器名稱','class' => 'form-control')) !!}
            </div>
        </div><br><br><br><br>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立者編號:</strong>
                <input class="form-control" type="input" name="Create_id" value=<?php echo $projects->Create_id?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立日期:</strong>
                <input class="form-control" type="input" name="Create_time" value=<?php echo date('Y-m-d',strtotime($projects->Create_time))?> readonly>
            </div>
        </div><br><br><br><br>
        <strong><font color="#FFAC12" size="5">規 範 資 料</font></strong>
        <HR><br>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>規範:</Strong>
                <input class="form-control" type="input" name="Standard_id" value=<?php
                $serverName = "163.17.9.113";
                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                $sql1="select Standard_name from DB_Standard WHERE Standard_id=".$projects->Standard_id;
                $result=sqlsrv_query($conn,$sql1)or die("sql error".sqlsrv_errors());
                while($row=sqlsrv_fetch_array($result)){
                    echo $row[0];
                }
                ?> readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>校驗方式:</strong>
                <input class="form-control" type="input" name="Check_method" value=<?php echo $projects->Check_method?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>週期:</strong>
                <input class="form-control" type="input" name="Cycle" value=<?php echo $projects->Cycle?> readonly>
            </div><br><br>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <br><br>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <a href="{{ route('project.index') }}" class="btn btn-warning"><span class="glyphicon glyphicon-log-out"></span> 返回</a>
        </div>

    </div>
    {!! Form::close() !!}

@endsection