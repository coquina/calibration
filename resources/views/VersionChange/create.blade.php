@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>新增規範</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('VersionChange.index') }}"> 返回</a>
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

    {!! Form::open(array('route' => 'VersionChange.store','method'=>'POST')) !!}

    <div class="row">

                {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                    {{--<div class="form-group">--}}
                        {{--<strong>規範流水號</strong>--}}
                        {{--{!! Form::text('Standard_id', null, array('placeholder' => '規範流水號','class' => 'form-control')) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>規範編號</strong>
                        {!! Form::text('Standard_no', null, array('placeholder' => '規範編號','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>規範名稱</strong>
                        {!! Form::text('Standard_name', null, array('placeholder' => '規範名稱','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>建立者編號</strong>
                        {!! Form::text('Create_id', null, array('placeholder' => '建立者編號','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>建立日期</strong>
                        {!! Form::date('Create_time', null, array('placeholder' => '建立日期','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>原始文件規範檔名</strong>
                        {!! Form::text('File_norm', null, array('placeholder' => '原始文件規範檔名','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>系統文件規範編碼</strong>
                        {!! Form::text('File_norm_code', null, array('placeholder' => '系統文件規範編碼','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-10">
                    <div class="form-group">
                        <strong>建議週期(月)</strong>
                        {!! Form::text('Cycle_R', null, array('placeholder' => '建議週期','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-10">
                    <div class="form-group">
                        <strong>規範所屬單位</strong>
                        {!! Form::text('S_Department', null, array('placeholder' => '規範所屬單位','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-10">
                    <div class="form-group">
                        <strong>發行單位</strong>
                        {!! Form::text('Issuse_Department', null, array('placeholder' => '發行單位','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-10">
                    <div class="form-group">
                        <strong>引用出處</strong>
                        {!! Form::text('Citation', null, array('placeholder' => '引用出處','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-10">
                    <div class="form-group">
                        <strong>版次</strong>
                        {!! Form::text('Version', null, array('placeholder' => '版次','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-10">
                    <div class="form-group">
                        <strong>規範狀態</strong>
                        {!! Form::text('Standard_Status', null, array('placeholder' => '規範狀態','class' => 'form-control')) !!}
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-success">送出</button>
                </div>

     </div>
    {!! Form::close() !!}

@endsection