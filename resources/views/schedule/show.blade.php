@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1><a href="{{ route('schedule.index') }}"> 排程管理</a> &raquo;  細部內容</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('schedule.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>排程編號:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Schedule_id?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>機器選單編號:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Machine_list_id?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>下次校驗日期:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo date('Y-m-d',strtotime($schedules->Next_calibration_date))?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>建議下次校驗日期:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Suggested_date?>" readonly>
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
                <strong>版次: </strong>
                    <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Version?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>檢測結果原始檔:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->TestResult_raw_file?>" readonly>
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
                <strong>校正廠商:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Correction_company?>" readonly>
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
                <strong>收件日期:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Received_Date?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>溫度:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Temperature?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>相對溫度:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Relative_Humidity?>" readonly>
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
                <strong>校正地點:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Location?>" readonly>
                {{ $schedules->Location }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>追溯單位:</strong>
                    <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Traceability?>" readonly>
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
                <input type="text" name="Create_id" class="form-control" value="<?php echo $schedules->Due_Date?>" readonly>
            </div>
        </div>


    </div>

@endsection