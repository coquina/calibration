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
                <h2><a onclick=history.back()> <font color="gray">主功能管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 細部說明</h2>
            </div>
            <div >
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
            <br><br><br> <br><br><br>
            {!! Form::open(array('route' => 'Main_function_list.store','method'=>'POST')) !!}
            <strong><font color="#FFAC12" size="5">建 立 者 資 料</font></strong>

            <HR><br>
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>建立者編號:</strong>
                        <input type="hidden" name="Create_id" class="form-control" value="<?php echo Auth::user()->id?>" readonly>
                        <input type="text" class="form-control" value="<?php echo Auth::user()->Member_name?>" readonly>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>主功能編號:</strong>
                        {{--{!! Form::text('Main_function_No', null, array('placeholder' => '主功能編號','class' => 'form-control')) !!}--}}
                        <input type="text" name="id" class="form-control" value="<?php echo $aaa->Main_function_No?>" readonly>
                    </div>
                </div>

                <br><br><br><br><br> <strong><font color="#FFAC12" size="5">功能資料</font></strong><HR><br>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>主功能名稱:</strong>
                        {{--{!! Form::text('Main_function_name', null, array('placeholder' => '主功能名稱','class' => 'form-control')) !!}--}}
                        <input type="text" name="id" class="form-control" value="<?php echo $aaa->Main_function_name?>" readonly>
                    </div>
                </div>



                <?php
                date_default_timezone_set('Asia/Taipei');
                $datetime = date ("Y-m-d H:i:s");?>
                <input type="hidden" name="Create_time" value=<?php echo $datetime;?>>


                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>說明:</strong>
                        {{--{!! Form::text('Description', null, array('placeholder' => '說明','class' => 'form-control')) !!}--}}
                        <input type="text" name="id" class="form-control" value="<?php echo $aaa->Description?>" readonly>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong><font color="#FF0000"></font>狀態:</strong>

                        <input type="text" name="id" class="form-control" value="<?php
                        if( $aaa->Status=="0"){
                            echo "停用";
                            }else{
                                echo "啟用";
                            }?>" readonly>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>圖案:</strong>
                        {!! Form::text('icon', null, array('placeholder' => '圖案','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                    <a href="{{ route('Main_function_list.index') }}" class="btn btn-warning"><span class="glyphicon glyphicon-log-out"></span> 返回</a>
                    <br><br>
                </div>

            </div>
    {!! Form::close() !!}

@endsection