@extends('layouts.default')
@section('content')
    <?php
    use Illuminate\Support\Facades\Auth;
    $serverName = "163.17.9.113";
    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo); ?>
    <style>
        hr {
            border:0; height:2px; background-color:#FFAC12;
            color:#d4d4d4
        }
    </style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a a href="{{ route('project.index') }}"><font color="gray">機器選單&nbsp;</font></a><font color="gray" size="5"><span class="glyphicon glyphicon-menu-right"></span></font><font color="black">&nbsp;新增機器選單</font></h2>
            </div>
        </div>
    </div>
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

    {!! Form::open(array('route' => 'cho.store','method'=>'POST')) !!}
    <div class="row">
        <form class="form-horizontal" role="form">
            <input type="hidden" name="p_id" value=<?php echo $_GET['p_id']?>>
            <input type="hidden" class="form-control" id="Project_id" name="Project_id"  value="<?php echo $_GET['p_id'];?>"  placeholder = '計畫編號'  required readonly >
           <br>  <br>  <br>  <br>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <strong>機器:</strong>
                    <select name="Machine_id" id="Machine_id" class="form-control">
                        <?php
                        $sql="select Machine_id,Machine_name from DB_Machine where Status=1";
                        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                        while($row=sqlsrv_fetch_array($result)){ ?>
                        <option  value=<?php echo $row[0]?>><?php echo $row[1]?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <input type="hidden" class="form-control" id="Newold_status" name="Newold_status"  value="0" placeholder = '新舊狀態'  required readonly>
            <input type="hidden" class="form-control" id="Create_id" name="Create_id"  placeholder = '建立者編號' value="<?php echo Auth::user()->id?>"  required >
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <?php
                    date_default_timezone_set('Asia/Taipei');
                    $datetime = date ("Y-m-d H:i:s");?>
                    <input type="hidden" name="Create_time" value=<?php echo $datetime;?>>
                </div>  <br>  <br>  <br>  <br>  <br>  <br>
            </div>
        </form>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-success" >送出</button>
            <a class="btn btn-warning" onclick="history.back()">返回</a>
        </div>
    </div>
    {!! Form::close() !!}
@endsection