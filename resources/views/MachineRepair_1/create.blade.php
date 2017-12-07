@extends('layouts.default')
@section('content')
<style>
    hr {
        border:0; height:2px; background-color:#FFAC12;
        color:#d4d4d4
    }
</style>
<?php
use Illuminate\Support\Facades\Auth;
$serverName = "calibration.database.windows.net";
$connectionInfo = array( "Database"=>"calibration", "UID"=>"en", "PWD"=>"@sS10314161", "CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a onclick=history.back()> <font color="gray">維修管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 新增機器</h2>
            </div>
        </div>
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
    <br><br><br>
    {!! Form::open(array('route' => 'machine.store','method'=>'POST')) !!}
{{----------------------------------------------------------------------------------------------------------------------------------------------------------------}}
    <strong><font color="#FFAC12" size="5">建 立 者 資 料</font></strong>
    <HR><br>
{{----------------------------------------------------------------------------------------------------------------------------------------------------------------}}
    <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
{{-----------------------------------------------------------------帳號下拉式選單---------------------------------------------------------------------------------}}
                <strong ><font color="#FF0000">* </font>建立者:</strong>
                <select name="id" id="id" class="form-control" >
                    <?php
                    $sql="select*from DB_Member";
                    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                    $x=0;	$array[][]=0;$n=0;
                    while($row=sqlsrv_fetch_array($result)){
                    $array[$x][0]=$row[0];
                    $array[$x][3]=$row[3];
                    ?>
                    <option  value=<?php echo $array[$x][0]?>><?php echo $array[$x][3]; $x++;?></option>
                    <?php }?></select>
{{-----------------------------------------------------------------帳號下拉式選單---------------------------------------------------------------------------------}}
            </div>
        </div>

<div class="col-xs-6 col-sm-12 col-md-4">
    <div class="form-group">
        <strong><font color="#FF0000">* </font>採購部門:</strong>
        <input type="text" name="Purchasing_department" id="Purchasing_department" class="form-control" placeholder="採購部門">
    </div>
</div>
<BR><BR><BR><BR><BR><BR>
{{----------------------------------------------------------------------------------------------------------------------------------------------------------------}}
<strong><font color="#FFAC12" size="5">機 器 資 料</font></strong>
<HR><br>
{{----------------------------------------------------------------------------------------------------------------------------------------------------------------}}
<div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong><font color="#FF0000">* </font>機器編號:</strong>
                <input type="text" name="Machine_No" id="Machine_No" class="form-control" placeholder="機器編號">
            </div>
        </div>

<div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong><font color="#FF0000">* </font>機器名稱:</strong>
                <input type="text" name="Machine_name" id="Machine_name" class="form-control" placeholder="機器名稱">
            </div>
        </div>

<div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong><font color="#FF0000">* </font>採購日期:</strong>
                <input type="date" name="Purchase_date" id="Purchase_date" class="form-control" placeholder="採購日期">
            </div>
        </div>

<div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong><font color="#FF0000">* </font>狀態:</strong>
                <select name="Status" id="Status" class="form-control">
                    <option  value="1">正常</option>
                    <option  value="0">維修</option>
                    <option  value="9">報廢</option>
                </select>
            </div>
        </div>

<div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>機器價格:</strong>
                <input type="text" name="Machine_prices" id="Machine_prices" class="form-control" placeholder="機器價格">
            </div>
        </div>

<div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>使用年限:</strong>
                <input type="number" name="Service_life" min="1" max="20" class="form-control" placeholder="使用年限 (1~20)">
            </div>
        </div>

<div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong><font color="#FF0000">* </font>儀器分類:</strong>
                <select name="Instrument_sort" id="Instrument_sort" class="form-control">
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


<div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>製造廠商:</strong>
                <input type="text" name="Manfaucturer" id="Manfaucturer" class="form-control" placeholder="製造廠商">
            </div>
        </div>

<div class="col-md-6 col-md-offset-3">
            <div class="form-group">
                <strong>型號:</strong>
                <input type="text" name="Model" id="Model" class="form-control" placeholder="型號">
            </div><br>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <a href="{{ route('MachineRepair_1.index') }}" class="btn btn-warning"><span class="glyphicon glyphicon-log-out"></span> 返回</a>
            <br><br>
        </div>
    {!! Form::close() !!}

@endsection
