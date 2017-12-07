@extends('layouts.default')

@section('content')
    <?php
    use Illuminate\Support\Facades\Auth;
    $serverName = "calibration.database.windows.net";
    $connectionInfo = array( "Database"=>"calibration", "UID"=>"en", "PWD"=>"@sS10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a onclick=history.back()> <font color="gray"> 次功能管理</font> </a><font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 顯示次功能</h2>
            </div>

        </div>
    </div>
    <strong><font color="#FFAC12" size="5">次 功 能 資 料</font></strong>
    <HR><br>
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>次功能流水號:</strong>
                <input type="text" name="id" class="form-control" value="<?php echo $minors->Minor_function_id?>" readonly>
                {{--{{ $minors->Minor_function_id }}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>次功能編號:</strong>
                <input type="text" name="id" class="form-control" value="<?php echo $minors->Minor_function_No?>" readonly>
                {{--{{ $minors->Minor_function_No }}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>次功能名稱:</strong>
                <input type="text" name="id" class="form-control" value="<?php echo $minors->Minor_function_name?>" readonly>
                {{--{{ $minors->Minor_function_name }}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>主功能流水號:</strong>
                <input type="text" name="id" class="form-control" value="<?php echo $minors->Main_function_id?>" readonly>
                {{--{{ $minors->Main_function_id }}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立者:</strong>
                <?php
                $sql="select member_name from DB_Member where id='".$minors->Create_id."'";

                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());

                while($row=sqlsrv_fetch_array($result)){
                ?>
                <input type="text" value=<?php echo $row[0]; }?> class = 'form-control' readonly>

                {{--{{ $minors->Create_id }}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>建立日期:</strong>
                <input type="text" name="Create_id" class="form-control" value="<?php echo date('Y-m-d',strtotime($minors->Create_time))?>" readonly>
                {{--{{date('Y-m-d',strtotime($minors->Create_time))}}--}}
                {{--{{ $minors->Create_time }}--}}
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>狀態:</strong>
                <input type="text" name="id" class="form-control" value="<?php if($minors->Status==1){
                    echo "啟用";
                }elseif($minors->Status==0){
                    echo "停用";
                }?>" readonly>

                {{--{{ $minors->Status }}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>次功能程式:</strong>
                <input type="text" name="id" class="form-control" value="<?php echo $minors->Minor_function_program?>" readonly>
                {{--{{ $minors->Minor_function_program }}--}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>說明:</strong>
                <input type="text" name="id" class="form-control" value="<?php echo $minors->Description?>" readonly>
                {{--{{ $minors->Description }}--}}
            </div>
        </div>


    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button class="btn btn-warning" onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</button>
        <br><br>
    </div>
@endsection