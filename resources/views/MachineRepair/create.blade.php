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
                <h2><a onclick=history.back()> <font color="gray">維修 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 新增維修</h2>
            </div>
            <div >
            </div>



    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <br><br><br> <br><br><br>
    {!! Form::open(array('route' => 'MachineRepair.store','method'=>'POST')) !!}
      <strong><font color="#FFAC12" size="5">建 立 者 資 料</font></strong>

            <HR><br>
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立者:</strong>
                <input type="hidden" name="Create_Id" class="form-control" value="<?php echo Auth::user()->id?>" readonly>
                <input type="text" class="form-control" value="<?php echo Auth::user()->Member_name?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>機器流水號:</strong>
                <?php
                $serverName = "163.17.9.113\SQLEXPRESS";
                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                $sql="select * from DB_Machine where  Machine_name ='".$_GET['m_id']."'" ;
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                while($row=sqlsrv_fetch_array($result)){
                $ma_name = $row[2];
                    $ma_id = $row[0];
                    }?>
                <input name="ma_name"   type="text" class="form-control" value=" <?php echo $ma_name ?>" readonly>
                <input name="Machine_id"   type="hidden" class="form-control" value=" <?php echo $ma_id ?>" >


            </div>
        </div>

        <br><br><br><br> <strong><font color="#FFAC12" size="5">維修資料</font></strong><HR><br>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>維修單號:</strong>
                {!! Form::text('Repair_No', null, array('placeholder' => '維修編號','class' => 'form-control')) !!}
            </div>
        </div>


                <?php
                date_default_timezone_set('Asia/Taipei');
                $datetime = date ("Y-m-d H:i:s");?>
                <input type="hidden" name="Service_date" value=<?php echo $datetime;?>>


        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>保養項目:</strong>
                {!! Form::text('Maintain', null, array('placeholder' => '保養項目','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>刻度檢查:</strong>
                {!! Form::text('Degree_scale', null, array('placeholder' => '刻度檢查','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>歸零檢查:</strong>
                {!! Form::text('Zeroing_calibration', null, array('placeholder' => '歸零檢查','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>鎖固螺絲檢查:</strong>
                {!! Form::text('Screw_lock', null, array('placeholder' => '鎖固螺絲檢查','class' => 'form-control')) !!}
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>加油潤滑保養:</strong>
                {!! Form::text('lubrication_maintenance', null, array('placeholder' => '加油潤滑保養','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>異常紀錄:</strong>
                {!! Form::text('Abnormality_log', null, array('placeholder' => '異常紀錄','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>年度:</strong>
                {!! Form::text('Annual', null, array('placeholder' => '年度','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>維修狀態:</strong>
                <select name="MachineRepair_status" id="MachineRepair_status" class="form-control">
                    <option  value="0">正常</option>
                    <option  value="1">異常</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>備註:</strong>
                {!! Form::text('Remark', null, array('placeholder' => '備註','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong></strong>
                <?php
                date_default_timezone_set('Asia/Taipei');
                $datetime = date ("Y-m-d H:i:s");?>
                <input type="hidden" name="Create_time" value=<?php echo $datetime;?>>
            </div>
        </div>






        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <a href="{{ route('MachineRepair_1.index') }}" class="btn btn-warning"><span class="glyphicon glyphicon-log-out"></span> 返回</a>
            <br><br>
        </div>

    </div>
    {!! Form::close() !!}
@endsection