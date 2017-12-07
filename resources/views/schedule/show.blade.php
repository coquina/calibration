@extends('layouts.default')
@section('content')
    <div class="row">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a  href="{{ route('schedule.index') }}"> <font color="black">排程管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 細部內容</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('schedule.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <br><br>
    <strong><font color="#FFAC12" size="5">校 驗 廠 商 資 料</font></strong>
    <HR><br>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>校正廠商:</strong>
            <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Correction_company?>" readonly>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>收件日期:</strong>
            <input type="text" name="Create_id" class="form-control" value="{{date('Y-m-d',strtotime($schedules->Next_calibration_date))}}" readonly>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>校正地點:</strong>
            <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Location?>" readonly>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>追溯單位:</strong>
            <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Traceability?>" readonly>
        </div><br>
    </div>
    <strong><font color="#FFAC12" size="5">校 正 廠 商 資 料</font></strong>
    <HR><br>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>建議下次校驗日期:</strong>
            <input type="text" name="Create_id" class="form-control" value="<?php if($schedules->Suggested_date==null){
                echo "無建議下次校驗日期";
                }else{
                    echo $schedules->Suggested_date;
                }?>" readonly>
            </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>校驗結果:</strong>
            <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Test_result_status?>" readonly>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>申請者:</strong>
            <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Applicant?>" readonly>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>檢測結果原始檔:</strong>
            <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->TestResult_raw_file?>" readonly>
        </div>
    </div>
    <br><br>
    <strong><font color="#FFAC12" size="5">校 正 計 畫 資 料</font></strong>
    <HR><br>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>下次校驗日期:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo date('Y-m-d',strtotime($schedules->Next_calibration_date))?>" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>版次: </strong>
                    <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Version?>" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>機型:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Model?>" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>序號:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Serial_Number?>" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>校正程序:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Procedure_Used?>" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>溫度:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Temperature."℃"?>" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>相對溫度:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Relative_Humidity."%"?>" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>顧客地址:</strong>
                    <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Consumer_Address?>" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>報告號碼:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Report_No?>" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>標準器有效日期:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo date('Y-m-d',strtotime($schedules->Due_Date))?>" readonly>
            </div>
        </div>
    </div>
@endsection