@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1> <a onclick=history.back()>計畫管理</a></h1>
        </div>
    </div>

            <div class="pull-right">
                <a class="btn btn-primary" onclick=history.back()> Back</a>
            </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>計劃流水號:</strong>
                {{ $projects->Project_id }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>機器編號:</strong>
                {{ $projects->Project_No }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>機器名稱:</strong>
                {{ $projects->Standard_id }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>採購日期:</strong>
                {{ $projects->Project_name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>狀態:</strong>
                {{ $projects->Check_method }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>機器價格:</strong>
                {{ $projects->Cycle }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>使用年限:</strong>
                {{ $projects->Create_id }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>儀器分類:</strong>
                {{ $projects->Create_time }}
            </div>
        </div>
    </div>

@endsection