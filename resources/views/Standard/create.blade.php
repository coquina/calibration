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
                <h2><a  href="{{ route('Standard.index') }}"> <font color="black">規範管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 新增規範</h2>
            </div>
        </div>
    </div>

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

    {!! Form::open(array('route' => 'Standard.store','method'=>'POST')) !!}
    <br><br><br>
    <strong><font color="#FFAC12" size="5">建 立 者 資 料</font></strong>
    <HR><br>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong>建立者</strong>
            {{--<input type="text" class="'form-control" id="Create_id" name="Create_id" placeholder="建立者編號" required>--}}
            {{--{!! Form::text('Create_id', null, array('placeholder' => '建立者編號','class' => 'form-control')) !!}--}}
            <input type="hidden" name="Create_id" class="form-control" value="<?php echo Auth::user()->id?>" readonly>
            <input type="text" class="form-control" value="<?php echo Auth::user()->Member_name?>" readonly>
        </div>
    </div>




    <br><br><br><br><br><br><br>

    <strong><font color="#FFAC12" size="5">規 範 資 料 輸 入</font></strong>
    <HR><br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <font color="#FF0000">*</font><strong>規範編號</strong>
                {{--<input type="text" class="'form-control" id="Standard_no" name="Standard_no" placeholder="規範編號" required>--}}
                {!! Form::text('Standard_no', null, array('placeholder' => '規範編號','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <font color="#FF0000">*</font><strong>規範名稱</strong>
                {{--<input type="text" class="'form-control" id="Standard_name" name="Standard_name" placeholder="規範名稱" required>--}}
                {!! Form::text('Standard_name', null, array('placeholder' => '規範名稱','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                {{--<strong>建立日期</strong>--}}
                {{--<input type="text" class="'form-control" id="Create_time" name="Create_time" placeholder="建立日期" required>--}}
                {{--{!! Form::date('Create_time', null, array('placeholder' => '建立日期','class' => 'form-control')) !!}--}}
                <?php
                date_default_timezone_set('Asia/Taipei');
                $datetime = date ("Y-m-d H:i:s");?>
                <input type="hidden" name="Create_time" value=<?php echo $datetime;?>>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <font color="#FF0000">*</font><strong>原始文件規範檔名</strong>
                {{--<input type="text" class="'form-control" id="File_norm" name="File_norm" placeholder="原始文件規範檔名" required>--}}
                {!! Form::text('File_norm', null, array('placeholder' => '原始文件規範檔名','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <font color="#FF0000">*</font><strong>系統文件規範編碼</strong>
                {{--<input type="text" class="'form-control" id="File_norm_code" name="File_norm_code" placeholder="系統文件規範編碼" required>--}}
                {!! Form::text('File_norm_code', null, array('placeholder' => '系統文件規範編碼','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <font color="#FF0000">*</font><strong>建議週期(月)</strong>
                {{--<input type="text" class="'form-control" id="Cycle_R" name="Cycle_R" placeholder="建議週期" required>--}}
                {!! Form::text('Cycle_R', null, array('placeholder' => '建議週期','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <font color="#FF0000">*</font><strong>規範所屬單位</strong>
                {{--<input type="text" class="'form-control" id="S_Department" name="S_Department" placeholder="規範所屬單位" required>--}}
                {!! Form::text('S_Department', null, array('placeholder' => '規範所屬單位','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <font color="#FF0000">*</font><strong>發行單位</strong>
                {{--<input type="text" class="'form-control" id="Issuse_Department" name="Issuse_Department" placeholder="發行單位" required>--}}
                {!! Form::text('Issuse_Department', null, array('placeholder' => '發行單位','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <font color="#FF0000">*</font><strong>引用出處</strong>
                {{--<input type="text" class="'form-control" id="Citation" name="Citation" placeholder="引用出處" required>--}}
                {!! Form::text('Citation', null, array('placeholder' => '引用出處','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>版次</strong>
                <input type="text" class="form-control" id="Version" name="Version" value="0" placeholder="版次" required readonly>
                {{--{!! Form::text('Version', null, array('placeholder' => '版次','class' => 'form-control')) !!}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <font color="#FF0000">*</font><strong>規範狀態</strong>

                <select name="Standard_Status" id="Standard_Status" class="form-control">
                    <option  value="0">正常</option>
                    <option  value="1">刪除</option>
                </select>

                {{--<input type="text" class="form-control" id="Standard_Status" name="Standard_Status" value="0" placeholder="規範狀態" required readonly>--}}
                {{--{!! Form::text('Standard_Status', null, array('placeholder' => '規範狀態','class' => 'form-control')) !!}--}}
            </div>
        </div>

        {{--</form>--}}

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <a class="btn btn-warning" href="{{ route('Standard.index') }}"><span class="glyphicon glyphicon-log-out"></span> 返回</a>
            <br><br>
        </div>

    </div>
    {!! Form::close() !!}

@endsection