@extends('layouts.default')
@section('content')
    <style>
        hr {
            border:0; height:2px; background-color:#FFAC12;
            color:#d4d4d4
        }
    </style>
<?php if($schedules->Test_result_status==0){ ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2><a  href="{{ route('schedule.index') }}"> <font color="black">排程管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 校驗確認</h2>
        </div>
    </div>
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

{!! Form::model($schedules, ['method' => 'PATCH','route' => ['schedule.update', $schedules->Schedule_id]]) !!}
    <br><br><br>
<strong><font color="#FFAC12" size="5">校 驗 廠 商 資 料</font></strong>
<HR><br>
<div class="row">
    <div class="col-xs-6 col-sm-3 ">
        <div class="form-group">
            <strong>校正廠商:</strong>
            {!! Form::text('Correction_company', null, array('placeholder' => '校正廠商','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-3">
        <div class="form-group">
            <strong>收件日期:</strong>
            {!! Form::date('Received_Date',null, array('placeholder' => '收件日期','class' => 'form-control')) !!}
        </div>
    </div>

    <input type="hidden" name="Test_result_status" value="2">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <br><br><br>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
        <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
        <a class="btn btn-warning"  href="{{ route('schedule.index') }}"><span class="glyphicon glyphicon-log-out"></span> 返回</a>
    </div>
</div>



<?php }else{ ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a href="{{ route('schedule.index') }}"><font color="gray">排程管理&nbsp;</font></a><font color="gray" size="5"><span class="glyphicon glyphicon-menu-right"></span></font><font color="black">&nbsp;校驗結果輸入</font></h2>
            </div>
        </div>
    </div><br><br><br>
    <strong><font color="#FFAC12" size="5">校 正 廠 商 資 料</font></strong>
    <HR><br>
    @if (count($errors) > 0)
        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($schedules, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['schedule.update', $schedules->Schedule_id]])!!}
    {{csrf_field()}}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>校正廠商:</strong>
                <input type="text" name="Correction_company" class="form-control" value="{{$schedules->Correction_company}}" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>收件日期:</strong>
                <input type="text" name="Received_Date" class="form-control" value="{{date('Y-m-d',strtotime($schedules->Received_Date))}}" readonly>
                {{--{!! Form::hidden('Received_Date',null,array('placeholder' => '收件日期','class' => 'form-control')) !!}--}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>校正地點:</strong>
                {!! Form::text('Location', null, array('placeholder' => '校正地點','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>追溯單位:</strong>
                {!! Form::text('Traceability', null, array('placeholder' => '追溯單位','class' => 'form-control')) !!}
            </div>
        </div>
        <br><br>
        <strong><font color="#FFAC12" size="5">校 正 計 畫 資 料</font></strong>
        <HR><br>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>建議下次校驗日期:</strong>
                {!! Form::date('Suggested_date', null, array('placeholder' => '建議下次校驗日期','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>校驗結果:</strong>
                {!! Form::select('Test_result_status', ['1' => '正常','9' => '異常','5' => '已完成'],null,array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>申請者:</strong>
                {!! Form::text('Applicant', null, array('placeholder' => '申請者','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>檢測結果原始檔:</strong>
                <input type="file" placeholder="檢測結果原始檔" class="from-control" id="TestResult_raw_file" name="TestResult_raw_file">
            </div><br>
        </div>
        <strong><font color="#FFAC12" size="5">校 正 結 果 資 料</font></strong>
        <HR><br>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>機型:</strong>
                {!! Form::text('Model', null, array('placeholder' => '機型','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>序號:</strong>
                {!! Form::text('Serial_Number', null, array('placeholder' => '序號','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>校正程序:</strong>
                {!! Form::text('Procedure_Used', null, array('placeholder' => '校正程序','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>溫度:</strong>
                {!! Form::text('Temperature', null, array('placeholder' => '溫度','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>相對溫度:</strong>
                {!! Form::text('Relative_Humidity', null, array('placeholder' => '相對溫度','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>顧客地址:</strong>
                {!! Form::text('Consumer_Address', null, array('placeholder' => '顧客地址','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>報告號碼:</strong>
                {!! Form::text('Report_No', null, array('placeholder' => '報告號碼','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>標準器有效日期:</strong>
                {!! Form::date('Due_Date', null, array('placeholder' => '標準器有效日期','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <a class="btn btn-warning"  href="{{ route('schedule.index') }}"><span class="glyphicon glyphicon-log-out"></span> 返回</a>
        </div>

    </div>

{!! Form::close() !!}
        <?php } ?>


@endsection