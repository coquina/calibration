@extends('layouts.default')

@section('content')


        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a href="{{ route('member.index') }}"> <font color="black">人員管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 修改資料</h2>
            <br><br></div>
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
    <br><br>

    {!! Form::model($ms, ['method' => 'PATCH','route' => ['member.update', $ms->id]]) !!}

    <strong><font color="#FFAC12" size="5">帳 號 資 料</font></strong>
    <HR><br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>帳號:</strong>
                {!! Form::text('Account_number', null, array('placeholder' => '帳號','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-20 col-sm-20 col-md-4">
            <div class="form-group">
                <strong>密碼:</strong>
                <input type="password" placeholder="密碼" class="form-control" id="password" name="password">
{{--                {!! Form::text('password', null, array('placeholder' => '密碼','class' => 'form-control')) !!}--}}
            </div>
        </div><br><br><br><br>
        <strong><font color="#FFAC12" size="5">個 人 資 料</font></strong>
        <HR><br>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>姓名:</strong>
                {!! Form::text('Member_name', null, array('placeholder' => '姓名','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>電子郵件:</strong>
                {!! Form::text('email', null, array('placeholder' => '電子郵件','class' => 'form-control')) !!}
            </div>
        </div><br><br><br><br>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>職稱:</strong>
                {!! Form::text('Job_title', null, array('placeholder' => '職稱','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>聯絡電話:</strong>
                {!! Form::text('Member_phone', null, array('placeholder' => '聯絡電話','class' => 'form-control')) !!}
            </div>
        </div><br><br><br><br>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>手機:</strong>
                {!! Form::text('Cell_phone', null, array('placeholder' => '手機','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>聯絡地址:</strong>
                {!! Form::text('Member_address', null, array('placeholder' => '聯絡地址','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <button class="btn btn-warning" onclick="history.back()"><span class="glyphicon glyphicon-log-out"></span> 返回</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection