@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a href="{{ route('member.index') }}"> <font color="gray">人員基本資料管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 新增資料</h2>
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
    <br> <br>
    {!! Form::open(array('route' => 'member.store','method'=>'POST')) !!}
    <strong><font color="#FFAC12" size="5">帳 號 資 料</font></strong>
    <HR><br>
    <div class="row">
        <form class="form-horizontal" role="form">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <font color="#FF0000">* </font><strong>帳號:</strong>
                        <input type="text" class="form-control" id="Account_number" name="Account_number"  placeholder = '帳號'  required >
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <font color="#FF0000">* </font><strong>密碼:</strong>
                        <input type="text" class="form-control" id="password" name="password"  placeholder = '密碼'  required >
                    </div>
                </div><br><br><br><br>
            <strong><font color="#FFAC12" size="5">個 人 資 料</font></strong>
            <HR><br>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <font color="#FF0000">* </font> <strong>姓名:</strong>
                        <input type="text" class="form-control" id="Member_name" name="Member_name"  placeholder = '姓名'  required >
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <font color="#FF0000">* </font><strong>電子郵件:</strong>
                        <input type="text" class="form-control" id="email" name="email"  placeholder = '電子郵件'  required >
                    </div>
                </div><br><br><br><br>

                    <?php
                    date_default_timezone_set('Asia/Taipei');
                    $datetime = date ("Y-m-d"); ?>
                    <input type="hidden" class="form-control" name="Create_time" id="Create_time" value=<?php echo $datetime?>>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <font color="#FF0000">* </font><strong>職稱:</strong>
                        <input type="text" class="form-control" id="Job_title" name="Job_title"  placeholder = '職稱'  required >
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <font color="#FF0000">* </font><strong>聯絡電話:</strong>
                        <input type="text" class="form-control" id="Member_phone" name="Member_phone"  placeholder = '聯絡電話'  required >
                    </div>
                </div><br><br><br><br>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <font color="#FF0000">* </font><strong>手機:</strong>
                        <input type="text" class="form-control" id="Cell_phone" name="Cell_phone"  placeholder = '手機'  required >
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <font color="#FF0000">* </font><strong>聯絡地址:</strong>
                        <input type="text" class="form-control" id="Member_address" name="Member_address"  placeholder = '聯絡地址'  required >
                    </div>
                </div><br><br><br><br>
        </form>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
                    <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
                    <a class="btn btn-warning" onclick="history.back()"><span class="glyphicon glyphicon-log-out"></span> 返回</a>
                </div>
     </div>

    {!! Form::close() !!}

@endsection