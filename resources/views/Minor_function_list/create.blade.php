@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">

            </div>

        </div>
    </div>
    <h2><a onclick=history.back()> <font color="gray"> 次功能管理</font> </a><font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 新增次功能</h2>
    {{--<h2>新增次功能</h2>--}}
    <hr>
    @if (count($errors) > 0)
        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{--{!! Form::model($minors, ['method' => 'PATCH','route' => ['Minor_function_list.store', $minors->Minor_function_id]]) !!}--}}
    {!! Form::open(array('route' => 'Minor_function_list.store','method'=>'POST')) !!}

    <div class="row">
        <input type="hidden" id="find_main_id" name="find_main_id" value=<?php echo $_GET['find_main_id']?>>

                 <div class="col-xs-12 col-sm-12 col-md-4">
                     <div class="form-group">
                         <font color="#FF0000">*</font><strong>次功能編號:</strong>
                         <input type="text" id="Minor_function_No" name="Minor_function_No" class="form-control" required>
                         {{--{!! Form::text('Minor_function_No', null, array('placeholder' => '次功能編號','class' => 'form-control')) !!}--}}
                     </div>
                </div>


                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                             <strong><font color="#FF0000">* </font>次功能名稱:</strong>
                             <select name="Minor_function_name" id="Minor_function_name" class="form-control">
                                 <option  value="人員管理">人員管理</option>
                                 <option  value="群組管理">群組管理</option>
                                 <option  value="規範文件">規範文件</option>
                                 <option  value="機器管理">機器管理</option>
                                 <option  value="維修">維修</option>
                                 <option  value="報廢">報廢</option>
                                 <option  value="計畫管理">計畫管理</option>
                                 <option  value="規範異動">規範異動</option>
                                 <option  value="排程管理">排程管理</option>
                                 <option  value="送校確認管理">送校確認管理</option>
                                 <option  value="檢驗結果管理">檢驗結果管理</option>
                                 <option  value="預警管理">預警管理</option>
                                 <option  value="報表管理">報表管理</option>
                                 <option  value="報表審核管理">報表審核管理</option>
                                 <option  value="主功能清單">主功能清單</option>
                            </select>
                         </div>
                     </div>

                {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                    {{--<div class="form-group">--}}
                        {{--<font color="#FF0000">*</font><strong>次功能名稱:</strong>--}}
                        {{--<input type="text" id="Minor_function_name" name="Minor_function_name" class="form-control" required>--}}
                        {{--{!! Form::text('Minor_function_name', null, array('placeholder' => '次功能名稱','class' => 'form-control')) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>主功能流水號:</strong>

                        <input type="text" id="Main_function_id" name="Main_function_id" class="form-control" value="<?php echo $_GET['find_main_id']?>"  readonly>

                        {{--{!! Form::text('Main_function_id', null, array('placeholder' => '主功能流水號','class' => 'form-control')) !!}--}}


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
                        <strong>說明:</strong>
                        <input type="text" id="Description" name="Description" class="form-control" >
                        {{--{!! Form::text('Description', null, array('placeholder' => '說明','class' => 'form-control')) !!}--}}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong><font color="#FF0000">* </font>狀態:</strong>
                        <select name="Status" id="Status" class="form-control">
                            <option  value="1">啟用</option>
                            <option  value="0">停用</option>

                        </select>
                    </div>
                </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <font color="#FF0000">*</font><strong>次功能程式:</strong>
                <input type="text" id="Minor_function_program" name="Minor_function_program" class="form-control" required>
                {{--{!! Form::text('Minor_function_program', null, array('placeholder' => '次功能程式','class' => 'form-control')) !!}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <?php
                date_default_timezone_set('Asia/Taipei');
                $datetime = date ("Y-m-d H:i:s");?>
                <input type="hidden" name="Create_time" value=<?php echo $datetime;?>>
                {{--{!! Form::date('Create_time', null, array('placeholder' => '建立日期','class' => 'form-control')) !!}--}}
            </div>
        </div>

     </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
        <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
        <button class="btn btn-warning" onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</button>
        <br><br>
    </div>

    {!! Form::close() !!}

@endsection