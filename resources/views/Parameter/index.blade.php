@extends('layouts.default')
@section('content')
    <style>
        table#parameter_tb tr:nth-child(even) {
            background-color: #eee;
        }
        table#parameter_tb tr:nth-child(odd) {
            background-color:#fff;
        }
        table#parameter_tb th {
            background-color: #4F4F4F;
            /*color: white;*/
        }
        a:link
        {
            color: #ffffff;
        }
        a:visited {
            color: #ffffff;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <h1><a href="{{ route('Parameter.index') }}"><font color="gray">參數管理</font></a></h1>
            <hr>
        </div>
    </div>
    <?php
    use Illuminate\Support\Facades\Auth;
    $serverName = "163.17.9.113";
    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    $sql="select*from DB_Group_personnel where Group_id=1 and id=".Auth::user()->id;
    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
    $key=0;
    while($row=sqlsrv_fetch_array($result)){
        if($row[0]!=null){
            $key=1;
        }
    }
    if($key=1){
    ?>
    <div class="form-group row add">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('Parameter.create') }}"><span class="glyphicon glyphicon-plus"></span>新增參數</a>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless" id="parameter_tb" name="parameter_tb">
                <tr>
                    <th width="100"><CENTER><font color="fof8ff">@sortablelink('Parameter_id','I D')</font></CENTER></th>
                    <th><CENTER><font color="fof8ff">@sortablelink('Parameter_name','參數名稱')</font></CENTER></th>
                    <th><CENTER><font color="fof8ff">@sortablelink('Parameter','參數值')</font></CENTER></th>
                    <th><CENTER><font color="fof8ff">@sortablelink('Create_id','建立者編號')</font></CENTER></th>
                    <th><CENTER><font color="fof8ff">@sortablelink('Create_time','建立日期')</font></CENTER></th>
                    <th><CENTER><font color="fof8ff">@sortablelink('Description','說明')</font></CENTER></th>
                    <th><CENTER><font color="fof8ff">@sortablelink('Status','狀態')</font></CENTER></th>
                    <th width="200"><CENTER><font color="f0f8ff">Actions</font></CENTER></th>
                </tr>
                {{ csrf_field() }}
        @foreach ($ParameterControllers as $key => $ParameterController)
                    <tr>
                        <td><CENTER>{{$ParameterController->Parameter_id}}</CENTER></td>
                        <td><CENTER>{{$ParameterController->Parameter_name}}</CENTER></td>
                        <td><CENTER>{{$ParameterController->Parameter}}</CENTER></td>
                        <td><CENTER>{{$ParameterController->Create_id}}</CENTER></td>
                        <td><CENTER> {{date('Y-m-d',strtotime($ParameterController->Create_time))}}</CENTER></td>
                        <td><CENTER>{{$ParameterController->Description}}</CENTER></td>
                        <td><CENTER>{{$ParameterController->Status}}</CENTER></td>
                        <td>
                            <CENTER>
                                <a class="btn btn-info" href="{{ route('Parameter.show',$ParameterController->Parameter_id) }}">顯示</a>
                                <a class="btn btn-primary" href="{{ route('Parameter.edit',$ParameterController->Parameter_id) }}">編輯</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['Parameter.destroy', $ParameterController->Parameter_id],'style'=>'display:inline']) !!}
                                {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </CENTER>
                        </td>
                    </tr>
        @endforeach
    </table>
    {!! $ParameterControllers->render() !!}
        </div>
    </div>
    <?php }else{ ?>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    {!! Form::model($ParameterControllers, ['method' => 'PATCH','route' => ['Parameter.update', 1]]) !!}
    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong><font color="#FF0000">* </font>預警週期:</strong>
            <input type="number" class="form-control" name="Parameter" id="Parameter">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">送出</button>
    </div>
    {!! Form::close() !!}
    <?php  } ?>
@stop