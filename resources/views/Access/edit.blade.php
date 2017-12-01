@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">

            </div>

        </div>

    </div>


    <h2><a onclick=history.back()> <font color="gray"> 權限管理</font> </a><font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 編輯權限</h2>
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

    {!! Form::model($as, ['method' => 'PATCH','route' => ['Access.update', $as->Access_id]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>群組流水號:</strong>
                <input type="text" id="Group_id" value="<?php echo $as->Group_id?>" name="Group_id" class = 'form-control' readonly>
                {{--{!! Form::text('Group_id', null, array('placeholder' => '群組編號','class' => 'form-control' ))  !!}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>次功能名稱:</strong>
                <input type="hidden" name="g_id" value=<?php echo $as->Minor_function_id?>>
                <select name="Minor_function_id" id="Minor_function_id" class="form-control">

                    <option  value=<?php echo $as->Minor_function_id?>><?php echo $as->Minor_function_name?> </option>
                    <?php
                    $serverName = "163.17.9.113\SQLEXPRESS";
                    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                    $conn = sqlsrv_connect( $serverName, $connectionInfo);
                    $sql="select*from DB_Minor_function_list";
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

        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>次功能流水號:</strong>--}}
                {{--{!! Form::text('Minor_function_id', null, array('placeholder' => '次功能編號','class' => 'form-control')) !!}--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <div class="form-group">
                    <strong>建立者:</strong>
                    <?php
                    $serverName = "163.17.9.113\SQLEXPRESS";
                    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                    $conn = sqlsrv_connect( $serverName, $connectionInfo);
                    $sql="select member_name from DB_Member where id='".$as->Create_id."'";

                    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());

                    while($row=sqlsrv_fetch_array($result)){
                    ?>
                    <input type="text" value=<?php echo $row[0]; }?> class = 'form-control' readonly>

                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立日期:</strong>
                <?php
                date_default_timezone_set('Asia/Taipei');
                $datetime = date ("Y-m-d H:i:s");?>
                <input type="text" name="Create_time" value=<?php echo $datetime;?> class = 'form-control' readonly>
            </div>
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
        <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
        <a class="btn btn-warning" onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</a>

        <br><br>
    </div>
    {!! Form::close() !!}

@endsection