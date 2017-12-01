@extends('layouts.default')

@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">

            </div>

        </div>
    </div>
    <h2><a onclick=history.back()> <font color="gray"> 次功能管理</font> </a><font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 編輯次功能</h2>
    <hr>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            {{--<strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($minors, ['method' => 'PATCH','route' => ['Minor_function_list.update', $minors->Minor_function_id]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>次功能編號:</strong>
                {{--<input type="text" id="Minor_function_No" name="Minor_function_No" class="form-control" required>--}}
                {!! Form::text('Minor_function_No', null, array('placeholder' => '次功能編號','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>次功能名稱:</strong>
                {{--<input type="text" id="Minor_function_name" name="Minor_function_name" class="form-control" required>--}}
                {!! Form::text('Minor_function_name', null, array('placeholder' => '次功能名稱','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>主功能流水號:</strong>

                {!! Form::text('Main_function_id', null, array('placeholder' => '主功能流水號','class' => 'form-control'))  !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立者:</strong>
                <input type="hidden" name="Create_id" class="form-control" value="<?php echo Auth::user()->id?>" readonly>
                <input type="text" class="form-control" value="<?php echo Auth::user()->Member_name?>" readonly>

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立日期:</strong>
                <?php
                date_default_timezone_set('Asia/Taipei');
                $datetime = date ("Y-m-d H:i:s");?>
                <input type="text" name="Create_time" value=<?php echo $datetime;?> class = 'form-control' readonly>
                {{--{!! Form::date('Create_time', null, array('placeholder' => '建立日期','class' => 'form-control')) !!}--}}
            </div>
        </div>
        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>建立日期:</strong>--}}
                {{--<input type="text" id="Create_time" name="Create_time" class="form-control" required>--}}
                {{--{!! Form::date('Create_time', null, array('placeholder' => '建立日期','class' => 'form-control')) !!}--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>說明:</strong>
                {{--<input type="text" id="Description" name="Description" class="form-control" required>--}}
                {!! Form::text('Description', null, array('placeholder' => '說明','class' => 'form-control')) !!}
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong><font color="#FF0000">* </font>狀態:</strong>
                <select name="Status" id="Status" class="form-control">
                    <option  value={{$minors->Status}}><?php if($minors->Status==1){
                            echo "啟用";
                        }elseif($minors->Status==0){
                            echo "停用";
                        }?> </option>
                    <option  value="1">啟用</option>
                    <option  value="0">停用</option>

                </select>
                {{--<strong>狀態:</strong>--}}
                {{--<input type="text" id="Status" name="Status" class="form-control" required>--}}
                {{--{!! Form::text('Status', null, array('placeholder' => '狀態','class' => 'form-control')) !!}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>次功能程式:</strong>
                {{--<input type="text" id="Minor_function_program" name="Minor_function_program" class="form-control" required>--}}
                {!! Form::text('Minor_function_program', null, array('placeholder' => '次功能程式','class' => 'form-control')) !!}
            </div>
        </div>



    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
        <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
        <a class="btn btn-warning" onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</a>
        <br><br>
    </div>
    {!! Form::close() !!}

@endsection