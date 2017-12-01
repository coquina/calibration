@extends('layouts.app')
@section('content')


    {{--JavaScript--}}
    <SCRIPT LANGUAGE="JavaScript">

        var checkflag = "false";
        function check(fieldName)
        {
            var field=document.getElementsByName(fieldName);
            if (checkflag == "false")
            {
                for (i = 0; i < field.length; i++)
                {
                    field[i].checked = true;
                }
                checkflag = "true"; return "Uncheck All";
            } else {
                for (i = 0; i < field.length; i++) {
                    field[i].checked = false;
                } checkflag = "false"; return "Check All"; } }

    </script>
    {{--JavaScript--}}





    <div class="row">
        <div class="col-md-12">
            <h1>選擇機器</h1>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">

        </div>

    </div>

    {{--<div class="col-md-6">--}}
        {{--<div class="input-group custom-search-form">--}}
            {{--{!! Form::open(['method'=>'GET','url'=>'project','class'=>'navbar-form navbar-left','role'=>'search']) !!}--}}
            {{--<select name="tag_project" id="tag_project" class="form-control">--}}
                {{--<option  value="Project_name">計畫名稱</option>--}}
                {{--<option  value="Check_method">校驗方式</option>--}}
                {{--<option  value="Cycle">週期</option>--}}
            {{--</select>--}}
            {{--<input type="text" name="search" class="form-control" placeholder="Search ....">--}}
                {{--<span class="input-group-btn">--}}
                            {{--<button type="submit" class="btn btn-default-sm">--}}
                                {{--<i class="fa fa-search"></i>--}}
                            {{--</button>--}}
                        {{--</span>--}}
            {{--</div>--}}
            {{--{!! Form::close() !!}--}}
        {{--</div>--}}




    {{--Button--}}
    <div class="form-group row add">
        <div class="pull-right">
            {{--<a class="btn btn-success" href="{{ route('project.create') }}"> 新增</a>--}}
            <a class="btn btn-danger" > 刪除機器</a>
        </div>
    </div>
<?php
$s = \Request::get('p_id');
$serverName = "163.17.9.113\SQLEXPRESS";
$connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$sql1="select*from DB_Project WHERE Project_id='".$s."';";
$result=sqlsrv_query($conn,$sql1)or die("sql error".sqlsrv_errors());
$r[]=0;

while($row=sqlsrv_fetch_array($result)){
    $r[0]=$row[0]; $r[1]=$row[1]; $r[2]=$row[2]; $r[3]=$row[3];
    $r[4]=$row[4]; $r[5]=$row[5]; $r[6]=$row[6]; $r[7]=$row[7];
    }
?>
<br>
    <h4>
    計劃流水號: <?php echo $r[0]?>
    計劃編號:   <?php echo $r[1]?>
    規範流水號: <?php echo $r[2]?>
    計劃名稱:   <?php echo $r[3]?>
    校驗方式:   <?php echo $r[4]?>
    週期:       <?php echo $r[5]?>
    建立者編號: <?php echo $r[6]?>
    建立日期:


        <h4>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless" id="table">
                <tr>
                    <th  width="5"><input type=checkbox value="全選" onClick="this.value=check('chk[]')"></th>
                    <th width="60">機器選單編號</th>
                    <th width="60">計劃編號</th>
                    <th width="60">機器編號</th>
                    <th width="80">新舊狀態</th>
                    <th width="80">建立者編號</th>
                    <th width="80">建立日期</th>
                    <th width="50"><CENTER>編 輯</CENTER></th>
                </tr>
                {{ csrf_field() }}
                <?php
                $serverName = "163.17.9.113\SQLEXPRESS";
                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                date_default_timezone_set('Asia/Taipei');
                $datetime = date ("Y-m-d H:i:s");

                $sql2="select*from DB_Machinelist";
                $result=sqlsrv_query($conn,$sql2)or die("sql error".sqlsrv_errors());
                $r[]=0;
                while($row=sqlsrv_fetch_array($result)){
                $r[0]=$row[0]; $r[1]=$row[1]; $r[2]=$row[2]; $r[3]=$row[3];
                $r[4]=$row[4]; $r[5]=$row[5];

                ?>
                    <tr>
                        <td><input type="checkbox"  name="chk[]"></td>
                        <td><?php echo $r[0]?></td>
                        <td><?php echo $r[1]?></td>
                        <td><?php echo $r[2]?></td>
                        <td><?php echo $r[3]?></td>
                        <td><?php echo $r[4]?></td>
                        <td><?php echo date_format($r[5], 'Y/m/d ');?></td>
                        <td>
                            {{--{!! Form::open(['method' => 'DELETE','route' => ['choosemachine.destroy', $cho->Machine_list_id],'style'=>'display:inline']) !!}--}}
                            {{--{!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}--}}
                            {{--{!! Form::close() !!}--}}
                      </td>
                    </tr>
<?php } ?>
            </table>
            {!! $choosemachines->render() !!}
        </div>
    </div>

@stop