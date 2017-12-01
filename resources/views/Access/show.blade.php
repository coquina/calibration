@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a onclick=history.back()> <font color="gray"> 權限管理</font></a><font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 顯示權限</h2>
            </div>

        </div>
    </div>

    <strong><font color="#FFAC12" size="5">權 限 資 料</font></strong>
    <HR><br>
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>權限編號:</strong>
                <input type="text" name="id" class="form-control" value="<?php echo $as->Access_id?>" readonly>
                {{--{{ $minors->Minor_function_id }}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>群組流水號:</strong>
                <input type="text" name="id" class="form-control" value="<?php echo $as->Group_id?>" readonly>
                {{--{{ $minors->Minor_function_id }}--}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>次功能流水號:</strong>
                <input type="text" name="id" class="form-control" value="<?php echo $as->Minor_function_id?>" readonly>
                {{--{{ $minors->Minor_function_id }}--}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
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

                {{--{{ $minors->Create_id }}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立日期:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo date('Y-m-d',strtotime($as->Create_time))?>" readonly>
                {{--{{date('Y-m-d',strtotime($minors->Create_time))}}--}}
                {{--{{ $minors->Create_time }}--}}
            </div>
        </div>


        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>權限編號:</strong>--}}
                {{--{{ $ms->Access_id }}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>群組編號:</strong>--}}
                {{--{{ $ms->Group_id }}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>次功能編號:</strong>--}}
                {{--{{ $ms->Minor_function_id }}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>建立者編號:</strong>--}}
                {{--{{ $ms->Create_id }}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>建立日期:</strong>--}}
                {{--{{ $ms->Create_time }}--}}
            {{--</div>--}}
        {{--</div>--}}



    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button class="btn btn-warning" onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</button>
        <br><br>
    </div>
@endsection