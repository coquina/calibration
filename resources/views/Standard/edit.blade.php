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
                <h2><a onclick=history.back()> <font color="#808080">規範管理 </font> </a><font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 編輯規範</h2>
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




    <?php
    $serverName = "163.17.9.113";
    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
    $conn=sqlsrv_connect($serverName,$connectionInfo);
    $sql="select*from DB_Project where Standard_id=".$standard->Standard_id; //依Standard_id搜尋DB_Project資料表
    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
    $count[]=0; $n=0;
    while($row=sqlsrv_fetch_array($result)){
        $count[$n]=$row[2];               //取得Standard_id
        $n++;
    }if( $count[0]!=null){                 //計畫資料表有資料 同步新增資料至歷史版次
        $sql_Change="insert into DB_version_change
        (Standard_no,Standard_name,Create_id,Create_time,File_norm,File_norm_code,Cycle_R,S_Department,
        Issuse_Department,Citation,Version,Standard_Status)
        values(".$standard->Standard_no.",'".$standard->Standard_name."',".$standard->Create_id.",'".$standard->Create_time."','".$standard->File_norm."','".$standard->File_norm_code."',".
            $standard->Cycle_R.",'".$standard->S_Department."','".$standard->Issuse_Department."','".$standard->Citation."',".$standard->Version++.",".$standard->Standard_Status.')';
        $query=sqlsrv_query($conn,$sql_Change);
    }
    ?>
    {!! Form::model($standard, ['method' => 'PATCH','route' => ['Standard.update', $standard->Standard_id]]) !!}
    <div class="row">

        <br><br><br>
        <strong><font color="#FFAC12" size="5">建 立 者 資 料</font></strong>
        <HR><br>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <strong>建立者:</strong>
                    <input class="form-control" type="input" name="Create_time" value=<?php
                    $serverName = "163.17.9.113\SQLEXPRESS";
                    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                    $conn = sqlsrv_connect( $serverName, $connectionInfo);
                    $sql="select Member_name from DB_Member where id=".$standard->Create_id;
                    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                    $array[]=0;
                    while($row=sqlsrv_fetch_array($result)){
                        echo $row[0];
                    }
                    ?> readonly>
                </div>
            </div>
        </div>

        <br><br><br>
        <strong><font color="#FFAC12" size="5">規 範 資 料</font></strong>
        <HR><br>


        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>規範編號:</strong>
                {!! Form::text('Standard_no', null, array('placeholder' => '規範編號','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>規範名稱:</strong>
                {{--<input type="text" class="'form-control" id="Standard_name" name="Standard_name" placeholder="規範名稱" required>--}}
                {!! Form::text('Standard_name', null, array('placeholder' => '規範名稱','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立日期:</strong>
                {{--<input type="text" class="'form-control" id="Create_time" name="Create_time" placeholder="建立日期" required>--}}
                {{--{!! Form::date('Create_time', null, array('placeholder' => '建立日期','class' => 'form-control')) !!}--}}
                <input class="form-control" type="input" name="Create_time" value=<?php echo date('Y-m-d',strtotime($standard->Create_time))?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>原始文件規範檔名:</strong>
                {{--<input type="text" class="'form-control" id="File_norm" name="File_norm" placeholder="原始文件規範檔名" required>--}}
                {!! Form::text('File_norm', null, array('placeholder' => '原始文件規範檔名','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>系統文件規範編碼:</strong>
                {{--<input type="text" class="'form-control" id="File_norm_code" name="File_norm_code" placeholder="系統文件規範編碼" required>--}}
                {!! Form::text('File_norm_code', null, array('placeholder' => '系統文件規範編碼','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建議週期(月):</strong>
                {{--<input type="text" class="'form-control" id="Cycle_R" name="Cycle_R" placeholder="建議週期" required>--}}
                {!! Form::text('Cycle_R', null, array('placeholder' => '建議週期','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>規範所屬單位:</strong>
                {{--<input type="text" class="'form-control" id="S_Department" name="S_Department" placeholder="規範所屬單位" required>--}}
                {!! Form::text('S_Department', null, array('placeholder' => '規範所屬單位','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>發行單位:</strong>
                {{--<input type="text" class="'form-control" id="Issuse_Department" name="Issuse_Department" placeholder="發行單位" required>--}}
                {!! Form::text('Issuse_Department', null, array('placeholder' => '發行單位','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>引用出處:</strong>
                {{--<input type="text" class="'form-control" id="Citation" name="Citation" placeholder="引用出處" required>--}}
                {!! Form::text('Citation', null, array('placeholder' => '引用出處','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>版次:</strong>
                <input type="text" class="form-control" id="Version" name="Version" value="<?php ECHO $standard->Version?>" placeholder="版次" required readonly>
                {{--{!! Form::text('Version', null, array('placeholder' => '版次','class' => 'form-control')) !!}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>規範狀態:</strong>
                <select name="Standard_Status" id="Standard_Status" class="form-control">
                    <option  value="0">正常</option>
                    <option  value="1">刪除</option>
                </select>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <a class="btn btn-warning" href="{{ route('Standard.index') }}"><span class="glyphicon glyphicon-log-out"></span> 返回</a>
        </div>

    </div>
    {!! Form::close() !!}

@endsection