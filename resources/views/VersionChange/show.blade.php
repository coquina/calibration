@extends('layouts.default')

@section('content')
    <style>
        hr {
            border:0; height:2px; background-color:#FFAC12;
            color:#d4d4d4
        }
    </style>
    <?php
    use Illuminate\Support\Facades\Auth;
    $serverName = "calibration.database.windows.net";
    $connectionInfo = array( "Database"=>"calibration", "UID"=>"en", "PWD"=>"@sS10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    ?>
    <div class="row">
        <div class="col-md-12">
            <h2><a onclick=history.back()> <font color="black">歷史版次 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 細部內容 <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> {{$versionchange->Standard_id}}</h2>
        </div>
    </div>
    <br><br><br>
    <strong><font color="#FFAC12" size="5">建 立 者 資 料</font></strong>
    <HR><br>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>建立者：</strong>
            <input type="text" name="Standard_name" class="form-control" value="<?php
            $sql="select Member_name from DB_Member where id=".$versionchange->Create_id;
            $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
            $array[]=0;
            while($row=sqlsrv_fetch_array($result)){
                echo $row[0];
            }
            ?>" readonly>

        </div>
    </div>


    <br><br><br><br><br><br><br>

    <strong><font color="#FFAC12" size="5">歷 史 版 次 資 料</font></strong>
    <HR><br>


    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>規範流水號：</strong>
            <input type="text" name="Standard_id" class="form-control" value="<?php echo $versionchange->Standard_id?>" readonly>
            {{--{{ $standard->Standard_id }}--}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>規範編號：</strong>
            <input type="text" name="Standard_no" class="form-control" value="<?php echo $versionchange->Standard_no?>" readonly>
            {{--{{ $standard->Standard_no }}--}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>規範名稱：</strong>
            <input type="text" name="Standard_name" class="form-control" value="<?php echo $versionchange->Standard_name?>" readonly>
            {{--{{ $standard->Standard_name }}--}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>建立日期：</strong>
            <input type="text" name="Create_time" class="form-control" value="<?php echo $versionchange->Create_time?>" readonly>
            {{--{{ $standard->Create_time }}--}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>原始文件規範檔名：</strong>
            <input type="text" name="File_norm" class="form-control" value="<?php echo $versionchange->File_norm?>" readonly>
            {{--{{ $standard->File_norm }}--}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>系統文件規範編碼：</strong>
            <input type="text" name="File_norm_code" class="form-control" value="<?php echo $versionchange->File_norm_code?>" readonly>
            {{--{{ $standard->File_norm_code }}--}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>建議週期(月)：</strong>
            <input type="text" name="Cycle_R" class="form-control" value="<?php echo $versionchange->Cycle_R?>" readonly>
            {{--{{ $standard->Cycle_R }}--}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>規範所屬單位：</strong>
            <input type="text" name="S_Department" class="form-control" value="<?php echo $versionchange->S_Department?>" readonly>
            {{--{{ $standard->S_Department }}--}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>發行單位：</strong>
            <input type="text" name="Issuse_Department" class="form-control" value="<?php echo $versionchange->Issuse_Department?>" readonly>
            {{--{{ $standard->Issuse_Department }}--}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>引用出處：</strong>
            <input type="text" name="Citation" class="form-control" value="<?php echo $versionchange->Citation?>" readonly>
            {{--{{ $standard->Citation }}--}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>版次：</strong>
            <input type="text" name="Version" class="form-control" value="<?php echo $versionchange->Version?>" readonly>
            {{--{{ $standard->Version }}--}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>規範狀態：</strong>
            <input type="text" name="Standard_Status" class="form-control" value="<?php echo $versionchange->Standard_Status?>" readonly>
            {{--{{ $standard->Standard_Status }}--}}
        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <br><br>
        <button class="btn btn-warning" onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</button>
    </div>


    </div>

@endsection