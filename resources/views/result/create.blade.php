@extends('layouts.default')
@section('content')
    <?php use Illuminate\Support\Facades\Auth; ?>

    <script LANGUAGE="JavaScript">
        function add_new_data(){
            var num = document.getElementById("result_tb").rows.length;
            var Tr = document.getElementById("result_tb").insertRow(num);
            Td = Tr.insertCell(Tr.cells.length);
            Td.innerHTML='<input name="Line[]" type="text" id="Line[]" value='+num+' class="form-control" readonly>';
            Td = Tr.insertCell(Tr.cells.length);
            Td.innerHTML='<input name="Lndication_value[]" id="Lndication_value[]" type="text" class="form-control">';
            Td = Tr.insertCell(Tr.cells.length);
            Td.innerHTML='<input name="Standard_value[]" id="Standard_value[]" type="text" class="form-control">';
            Td = Tr.insertCell(Tr.cells.length);
            Td.innerHTML='<input name="D_value[]" id="D_value[]" type="text" class="form-control">';
            Td = Tr.insertCell(Tr.cells.length);
            Td.innerHTML='<input name="Minimum_uncertainty[]" id="Minimum_uncertainty[]" type="text" class="form-control">';
        }
        function remove_data() {
            var num = document.getElementById("result_tb").rows.length;
            if(num >2) {
                document.getElementById("result_tb").deleteRow(-1);
            }
        }
    </script>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a onclick=history.back()> <font color="black">結果管理 </font></a> <font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 新增結果</h2>
            </div>
        </div>
    </div><br><br>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('route' => 'result.store','method'=>'POST')) !!}
    <div class="col-md-6 col-md-offset-3">
        <div class="form-group">
            <strong><font color="#FF0000">* </font>排程編號:</strong>
            <select name="Schedule_id" id="Schedule_id" class="form-control">
                <?php
                $serverName = "163.17.9.113\SQLEXPRESS";
                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                $sql="select*from DB_Schedule";
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                $x=0;	$array[][]=0;$n=0;
                while($row=sqlsrv_fetch_array($result)){
                $array[$x][0]=$row[0];
                ?>
                <option  value=<?php echo $array[$x][0]?>><?php echo $array[$x][0]; $x++;?></option>
                <?php }?></select>
        </div>
    </div><br><br><br>
    {{--Button--}}
    <div class="form-group row add">
        <div class="pull-right">
            <a onclick="add_new_data()"><h4><span class="glyphicon glyphicon-plus"></span></h4></a>
        </div>
    </div>
    {{--Button--}}

    <table class="table table-borderless" id="result_tb" name="result_tb">
        <tr>
            <th width="50"><CENTER>項次</CENTER></th>
            <th width="50"><CENTER>器示值</CENTER></th>
            <th width="50"><CENTER>標準值</CENTER></th>
            <th width="50"><CENTER>器差值</CENTER></th>
            <th width="50"><CENTER>最小不確定度</CENTER></th>
        </tr>
        <tr>
            <td><CENTER><input type="text" name="Line[]" id="Line[]" class="form-control" value="1" readonly></CENTER></td>
            <td><CENTER><input type="text" name="Lndication_value[]" id="Lndication_value[]" class="form-control"></CENTER></td>
            <td><CENTER><input type="text" name="Standard_value[]" id="Standard_value[]" class="form-control"></CENTER></td>
            <td><CENTER><input type="text" name="D_value[]" id="D_value[]" class="form-control"></CENTER></td>
            <td><CENTER><input type="text" name="Minimum_uncertainty[]" id="Minimum_uncertainty[]" class="form-control"></CENTER></td>
        </tr>
    </table>
    <div class="form-group row add">
        <div class="pull-right">
            <a onclick="remove_data()"><h4><span class="glyphicon glyphicon-minus"></span></h4></a>
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