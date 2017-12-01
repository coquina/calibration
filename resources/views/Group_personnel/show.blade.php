@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2><a onclick=history.back()> <font color="gray"> 群組人員管理</font></a> &raquo;  詳細資訊</h2>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <CENTER><h4><b><font color="#ffac12" size="5">人員編號: {{$pe->Group_personnel_id}}</font></b></h4></CENTER>
        </div>
    </div>
    <hr>
    <br><br>
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>帳號:</strong>
                <input type="text" name="id" class="form-control" value="<?php echo $pe->id?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>群組流水號:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $pe->Group_id?>" readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立者編號:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo $pe->Create_id?>" readonly>

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立日期:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo date('Y-m-d',strtotime($pe->Create_time))?>" readonly>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a class="btn btn-warning"  onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</a>
        <br><br>
    </div>

@endsection