@extends('layouts.default')
@section('content')
    <style>
        hr {
            border:0; height:2px; background-color:#FFAC12;
            color:#d4d4d4
        }
    </style>


    <div class="row">
        <div class="col-md-12">
            <h2><a onclick=history.back()> <font color="black">機器管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font>  {{$machines->Machine_name}}</h2>
        </div>
    </div>
    <br><br><br>
    <strong><font color="#FFAC12" size="5">建 立 者 資 料</font></strong>
    <HR><br>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>帳號:</strong>
            <input type="text" name="id" class="form-control" value="<?php
            $serverName = "163.17.9.113";
            $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            $sql_m="select Member_name from DB_Member where id=".$machines->id;
            $result=sqlsrv_query($conn,$sql_m)or die("sql error".sqlsrv_errors());
            while($row=sqlsrv_fetch_array($result)){
                echo $row[0]; }?>" readonly>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>採購部門:</strong>
            <input type="text" name="Create_id" class="form-control" value="<?php echo $machines->Purchasing_department?>" readonly>
        </div>
    </div><br><br><br><br><br>

    <strong><font color="#FFAC12" size="5">機 器 資 料</font></strong>
    <HR><br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>機器編號:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $machines->Machine_No?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>機器名稱:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $machines->Machine_name?>" readonly>

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>採購日期:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo date('Y-m-d',strtotime($machines->Purchase_date))?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>狀態:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $machines->Status?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>機器價格:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $machines->Machine_prices?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>使用年限:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $machines->Service_life?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>儀器分類:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $machines->Instrument_sort?>" readonly>
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>製造廠商:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $machines->Manfaucturer?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>型號:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $machines->Model?>" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <br><br>
            <button class="btn btn-warning" onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</button>
        </div>

    </div>

@endsection