@extends('layouts.default')

@section('content')

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2><a href="{{ route('member.index') }}"> <font color="black">人員管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 顯示資料</h2>
            <br><br></div>
    </div>
    <strong><font color="#FFAC12" size="5">帳 號 資 料</font></strong>
    <HR><br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>帳號:</strong>
                <input type="text" value="{{ $ms->Account_number }}" class="form-control" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>密碼:</strong>
                <input type="text" value="{{ $ms->password }}" class="form-control" readonly>
            </div>
        </div><br><br><br><br>
        <strong><font color="#FFAC12" size="5">帳 號 資 料</font></strong>
        <HR><br>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>姓名:</strong>
                <input type="text" value="{{ $ms->Member_name }}" class="form-control" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>E-mail:</strong>
                <input type="text" value="{{ $ms->email }}" class="form-control" readonly>
            </div>
        </div><br><br><br><br>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>職稱:</strong>
                <input type="text" value="{{ $ms->Job_title }}" class="form-control" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>聯絡電話:</strong>
                <input type="text" value="{{ $ms->Member_phone }}" class="form-control" readonly>
            </div>
        </div><br><br><br><br>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>手機:</strong>
                <input type="text" value="{{ $ms->Cell_phone }}" class="form-control" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>聯絡地址:</strong>
                <input type="text" value="{{ $ms->Member_address }}" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button class="btn btn-warning" onclick="history.back()"><span class="glyphicon glyphicon-log-out"></span> 返回</button>
    </div>

@endsection