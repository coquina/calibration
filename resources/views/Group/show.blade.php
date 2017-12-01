@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2><a href="{{ route('Group.index') }}"> <font color="gray"> 群組管理</font></a> &raquo;  詳細資訊</h2>

        </div>
    </div>
    <br>
    <div class="row">

        <div class="col-lg-12 margin-tb">
            <CENTER><h4><b><font color="#ffac12" size="5">群組流水號: {{$gr->Group_id}}</font></b></h4></CENTER>
            <hr>
        </div>
    </div>
    <br><br>
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>群組編號:</strong>
                <input type="text" name="id" class="form-control" value="<?php echo $gr->Group_No?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>群組名稱:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $gr->Group_name?>" readonly>
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
                <input type="text" name="Create_id" class="form-control" value="<?php echo date('Y-m-d',strtotime($gr->Create_time))?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>說明:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $gr->Description?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>狀態:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $gr->Status?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <a class="btn btn-warning"  onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</a>
            <br><br>
        </div>

    </div>

@endsection