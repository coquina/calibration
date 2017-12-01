@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2><a href="{{ route('Group.index') }}"> <font color="gray"> 群組管理</font></a> &raquo;  修改</h2>
                    </div>
                </div>
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

    {!! Form::model($gr, ['method' => 'PATCH','route' => ['Group.update', $gr->Group_id]]) !!}
    <div class="row">

<hr>

        <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
                {{--<strong>群組流水號:</strong>--}}
                <input class="form-control" type="hidden" name="Group_id" value=<?php echo $gr->Group_id?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>群組編號:</strong>
                <input class="form-control" type="input" name="Group_No" value=<?php echo $gr->Group_No?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>群組名稱:</strong>
                {!! Form::text('Group_name', null, array('placeholder' => '群組名稱','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立者名稱:</strong>
                <input type="text" class="form-control" id="Member_name" name="Member_name"  VALUE="<?php echo Auth::user()->Member_name?>" required readonly>
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立日期:</strong>
                <input class="form-control" type="input" name="Create_time" value=<?php echo date('Y-m-d',strtotime($gr->Create_time))?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>說明:</strong>
                {!! Form::text('Description', null, array('placeholder' => '說明','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>狀態:</strong>
                <select name="Status" id="Status" class="form-control">
                    <option  value={{$gr->Status}}></option>
                    <option  value="1">啟用</option>
                    <option  value="0">未啟用</option>
                </select>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <a class="btn btn-warning"  onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</a>
            <br><br>
        </div>
    </div>
    {!! Form::close() !!}

@endsection