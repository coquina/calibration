@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a onclick=history.back()><font color="gray"> 群組人員管理</font> </a> &raquo;  修改</h2>
            </div>

        </div>
    </div>
<hr>
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
    {!! Form::model($pe, ['method' => 'PATCH','route' => ['Group_personnel.update', $pe->Group_personnel_id]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>群組人員編號:</strong>
                <input class="form-control" type="input" name="id" value=<?php echo $pe->id?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>群組編號:</strong>
                <input type="hidden" name="g_id" value=<?php echo $pe->Group_id?>>
                <select name="Group_id" id="Group_id" class="form-control">
                    <option  value=<?php echo $pe->Group_id?>><?php echo $pe->Group_id?> </option>
                    <?php
                    $serverName = "163.17.9.113\SQLEXPRESS";
                    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                    $conn = sqlsrv_connect( $serverName, $connectionInfo);
                    $sql="select*from DB_Group";
                    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                    $x=0;	$array[][]=0;
                    while($row=sqlsrv_fetch_array($result)){
                    $array[$x][0]=$row[0];
                    $array[$x][1]=$row[1];
                    $array[$x][2]=$row[2];
                    ?>

                    <option  value=<?php echo $array[$x][0]?>><?php echo $array[$x][2];?></option><?php  $x++; } ?>
                </select>
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>帳號:</strong>
                <input class="form-control" type="input" name="Group_personnel_id" value=<?php echo $pe->Group_personnel_id?> readonly>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立者編號:</strong>
                <input class="form-control" type="input" name="Create_id" value=<?php echo $pe->Create_id?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立日期:</strong>
                <input class="form-control" type="input" name="Create_time" value=<?php echo date('Y-m-d',strtotime($pe->Create_time))?> readonly>
            </div>
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
        <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
        <a class="btn btn-warning"  onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</a>
        <br><br>
    </div>

    {!! Form::close() !!}

@endsection