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
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a onclick=history.back()> <font color="gray">維修管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 細部維修</h2>
            </div>

        </div>
    </div>

    <BR>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    {!! Form::model($bbb, ['method' => 'PATCH','route' => ['MachineRepair.update', $bbb->Repair_id]]) !!}
    <strong><font color="#FFAC12" size="5">建 立 者 資 料</font></strong>
    <HR><br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>機器流水號:</strong>
                {{--{!! Form::text('Machine_id', null, array('placeholder' => '機器流水號','class' => 'form-control')) !!}--}}
                <input type="text" name="id" class="form-control" value="<?php echo $bbb->Machine_id?>" readonly>

            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>維修單號:</strong>
                {{--{!! Form::text('Repair_No', null, array('placeholder' => '維修編號','class' => 'form-control')) !!}--}}
                <input type="text" name="id" class="form-control" value="<?php echo $bbb->Repair_No?>" readonly>
            </div>
        </div>

        <br><br><br><br> <strong><font color="#FFAC12" size="5">維修資料</font></strong><HR><br>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>維修日期:</strong>
                {{--{!! Form::text('Service_date', null, array('placeholder' => '維修日期','class' => 'form-control')) !!}--}}
                <input type="text" class="form-control" name="Service_date" id="Service_date"  value=<?php echo $bbb->Service_date?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>保養項目:</strong>
                {{--{!! Form::text('Maintain', null, array('placeholder' => '保養項目','class' => 'form-control')) !!}--}}
                <input type="text" class="form-control" name="Service_date" id="Service_date"  value=<?php echo $bbb->Maintain?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>刻度檢查:</strong>
                {{--{!! Form::text('Degree_scale', null, array('placeholder' => '刻度檢查','class' => 'form-control')) !!}--}}
                <input type="text" class="form-control" name="Service_date" id="Service_date"  value=<?php echo $bbb->Degree_scale?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>歸零檢查:</strong>
                {{--{!! Form::text('Zeroing_calibration', null, array('placeholder' => '歸零檢查','class' => 'form-control')) !!}--}}
                <input type="text" class="form-control" name="Service_date" id="Service_date"  value=<?php echo $bbb->Zeroing_calibration?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>鎖固螺絲檢查:</strong>
                {{--{!! Form::text('Screw_lock', null, array('placeholder' => '鎖固螺絲檢查','class' => 'form-control')) !!}--}}
                <input type="text" class="form-control" name="Service_date" id="Service_date"  value=<?php echo $bbb->Screw_lock?> readonly>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>加油潤滑保養:</strong>
                {{--{!! Form::text('lubrication_maintenance', null, array('placeholder' => '加油潤滑保養','class' => 'form-control')) !!}--}}
                <input type="text" class="form-control" name="Service_date" id="Service_date"  value=<?php echo $bbb->lubrication_maintenance?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>異常紀錄:</strong>
                {{--{!! Form::text('Abnormality_log', null, array('placeholder' => '異常紀錄','class' => 'form-control')) !!}--}}
                <input type="text" class="form-control" name="Service_date" id="Service_date"  value=<?php echo $bbb->Abnormality_log?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>年度:</strong>
                {{--{!! Form::text('Annual', null, array('placeholder' => '年度','class' => 'form-control')) !!}--}}
                <input type="text" class="form-control" name="Service_date" id="Service_date"  value=<?php echo $bbb->Annual?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>維修狀態:</strong>
                <input type="text" name="id" class="form-control" value="<?php
                if( $bbb->MachineRepair_status=="0"){
                    echo "正常";
                }else{
                    echo "報廢";
                }?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>備註:</strong>
                {{--{!! Form::text('Remark', null, array('placeholder' => '備註','class' => 'form-control')) !!}--}}
                <input type="text" class="form-control" name="Service_date" id="Service_date"  value=<?php echo $bbb->Remark?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立日期:</strong>
                {{--{!! Form::text('Create_time', null, array('placeholder' => '建立日期','class' => 'form-control')) !!}--}}
                <input type="text" class="form-control" name="Service_date" id="Service_date"  value=<?php echo $bbb->Create_time?> readonly>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立者:</strong>
                <?php
                $sql="select Member_name from DB_Member where id=".$bbb->Create_Id;
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                while($row=sqlsrv_fetch_array($result)){
                ?>
                {{--{!! Form::text('Create_Id', null, array('placeholder' => '建立者','class' => 'form-control')) !!}--}}
                <input type="text" class="form-control" name="Service_date" id="Service_date"  value=<?php echo $row[0]; }?> readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <br><br>
            <a class="btn btn-warning" onclick=history.back()><span class=" glyphicon glyphicon-log-out"></span> 返回</a>
        </div>

    </div>
    {!! Form::close() !!}

@endsection