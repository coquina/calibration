@extends('layouts.default')
@section('content')
    <style>
        hr {
            border:0; height:2px; background-color:#FFAC12;
            color:#d4d4d4
        }
    </style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a onclick=history.back()> 機器管理 </a><font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 編輯機器</h2>
            </div>

        </div>
    </div>
<BR>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($machines, ['method' => 'PATCH','route' => ['machine.update', $machines->Machine_id]]) !!}
    <strong><font color="#FFAC12" size="5">建 立 者 資 料</font></strong>
    <HR><br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>帳號:</strong>
            {!! Form::text('id', null, array('placeholder' => '帳號','class' => 'form-control')) !!}
        </div>
    </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>採購部門:</strong>
            {!! Form::text('Purchasing_department', null, array('placeholder' => '採購部門','class' => 'form-control')) !!}
        </div>
    </div><br><br><br><br><br>
    <strong><font color="#FFAC12" size="5">機 器 資 料</font></strong>
    <HR>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>機器編號:</strong>
                {!! Form::text('Machine_No', null, array('placeholder' => '機器編號','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>機器名稱:</strong>
                {!! Form::text('Machine_name', null, array('placeholder' => '機器名稱','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>採購日期:</strong>
                <input class="form-control" type="input" name="Purchase_date" value=<?php echo date('Y-m-d',strtotime($machines->Purchase_date))?> readonly>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>狀態:</strong>
                <select name="Status" id="Status" class="form-control">
                    <option  value="1">正常</option>
                    <option  value="0">維修</option>
                    <option  value="9">報廢</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>機器價格:</strong>
                {!! Form::text('Machine_prices', null, array('placeholder' => '機器價格','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>使用年限:</strong>
                {!! Form::text('Service_life', null, array('placeholder' => '使用年限','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>儀器分類:</strong>
                <select name="Instrument_sort" id="Instrument_sort" class="form-control">
                    <option  value={{$machines->Instrument_sort}}>{{$machines->Instrument_sort}}</option>
                    <option  value="層析">層析</option>
                    <option  value="質譜">質譜</option>
                    <option  value="光譜">光譜</option>
                    <option  value="熱脫附">熱脫附</option>
                    <option  value="熱裂解">熱裂解</option>
                    <option  value="粒徑分析">粒徑分析</option>
                    <option  value="自動化前處理/進樣">自動化前處理/進樣</option>
                    <option  value="實驗室氣體產生器">實驗室氣體產生器</option>
                    <option  value="移動實驗車">移動實驗車</option>
                </select>
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>製造廠商:</strong>
                {!! Form::text('Manfaucturer', null, array('placeholder' => '製造廠商','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>型號:</strong>
                {!! Form::text('Model', null, array('placeholder' => '型號','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <button class="btn btn-warning" onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection