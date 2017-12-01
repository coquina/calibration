@extends('layouts.default')
@section('content')
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <script src="node_modules/chart.js/Chart.min.js"></script>
    <script src="node_modules/angular-chart.js/dist/angular-chart.min.js"></script>
    {!! Charts::styles() !!}
</head>
<style>
    table#report_tb tr:nth-child(even) {
        background-color: #eee;
    }
    table#report_tb tr:nth-child(odd) {
        background-color:#fff;
    }
    table#report_tb th {
        background-color: #4F4F4F;
        /*color: white;*/
    }
</style>
<body>
        {{--<h1><a href="{{ route('report.index') }}"><font color="gray">報表管理</font></a></h1>--}}
        {{--<hr>--}}
<?php
$select = \Request::get('tag_machine_1','xxx');
$cho_o = \Request::get('tag_machine_2','xxx');
$cho_input = \Request::get('search','xxx');
$serverName = "163.17.9.113";
$connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$sql_m="select DISTINCT  b.Machine_id, c.Machine_name
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id
order by b.Machine_id";
if($cho_o!='xxx' and $cho_input!=null){
    $sql_m="select DISTINCT  b.Machine_id, c.Machine_name
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and c.".$cho_o." LIKE '%".$cho_input."%' order by b.Machine_id";
}elseif($cho_o!='xxx' and $select!='全部'){
    $sql_m="select DISTINCT  b.Machine_id, c.Machine_name
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and c.".$cho_o." LIKE '%".$cho_input."%' and c.Status=".$select." order by b.Machine_id";
}
$result=sqlsrv_query($conn,$sql_m)or die("sql error".sqlsrv_errors());
$array_mchine[][]=0; $x=0;
$m_0=0; $m_1=0; $m_2=0;
while($row=sqlsrv_fetch_array($result)){
    $array_mchine[$x][0]=$row[0];   //d
    $array_mchine[$x][1]=$row[1];   //name
    $array_mchine[$x][3]=0;   //正常次數
    $array_mchine[$x][9]=0;   //異常次數
    $array_mchine[$x][4]=0;   //內校次數
    $array_mchine[$x][5]=0;   //外校次數
    $array_mchine[$x][6]=0;   //逾期未校次數
    $array_mchine[$x][7]=0;   //未處理次數
    $array_mchine[$x][8]=0;   //送校中次數
    $x++;
}
$sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=9
group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
if($cho_o=='xxx' and $cho_input!='xxx'){
    $sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=9 and c.".$cho_o." LIKE '%".$cho_input."%' group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
} elseif($cho_o!='xxx' and $select!='全部'){
    $sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=9 and c.".$cho_o." LIKE '%".$cho_input."%' and c.Status=".$select." group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
}
$result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
while($row=sqlsrv_fetch_array($result)){
    for($i=0;$i<$x;$i++){
        if($array_mchine[$i][0]==$row[0]){
            $array_mchine[$i][9]=$row[1];
        }
    }
}
$sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=0
group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
if($cho_o=='xxx' and $cho_input!='xxx'){
    $sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=0 and c.".$cho_o." LIKE '%".$cho_input."%' group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
} elseif($cho_o!='xxx' and $select!='全部'){
    $sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=0 and c.".$cho_o." LIKE '%".$cho_input."%' and c.Status=".$select." group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
}
$result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
while($row=sqlsrv_fetch_array($result)){
    for($i=0;$i<$x;$i++){
        if($array_mchine[$i][0]==$row[0]){
            $array_mchine[$i][7]=$row[1];
        }
    }
}
$sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=2
group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
if($cho_o=='xxx' and $cho_input!='xxx'){
    $sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=2 and c.".$cho_o." LIKE '%".$cho_input."%' group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
} elseif($cho_o!='xxx' and $select!='全部'){
    $sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=2 and c.".$cho_o." LIKE '%".$cho_input."%' and c.Status=".$select." group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
}
$result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
while($row=sqlsrv_fetch_array($result)){
    for($i=0;$i<$x;$i++){
        if($array_mchine[$i][0]==$row[0]){
            $array_mchine[$i][8]=$row[1];
        }
    }
}
$sql_1="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=1
group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
if($cho_o=='xxx' and $cho_input!='xxx'){
    $sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=1 and c.".$cho_o." LIKE '%".$cho_input."%' group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
}elseif($cho_o!='xxx' and $select!='全部'){
    $sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=1 and c.".$cho_o." LIKE '%".$cho_input."%' and c.Status LIKE '%".$select."%' group by  b.Machine_id, c.Machine_name
order by b.Machine_id";

}
$result=sqlsrv_query($conn,$sql_1)or die("sql error".sqlsrv_errors());
while($row=sqlsrv_fetch_array($result)){
    for($i=0;$i<$x;$i++){
        if($array_mchine[$i][0]==$row[0]){
            $array_mchine[$i][3]=$row[1];
        }
    }
}
$sql_1="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c,DB_Project d
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and b.Project_id=d.Project_id and d.Check_method='內校'
group by  b.Machine_id
order by b.Machine_id";
if($cho_o=='xxx' and $cho_input!='xxx'){
    $sql_1="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c,DB_Project d
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and b.Project_id=d.Project_id and d.Check_method='內校' and c.".$cho_o." LIKE '%".$cho_input."%' group by  b.Machine_id
order by b.Machine_id";
}elseif($cho_o!='xxx'  and $select!='全部'){
    $sql_1="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c,DB_Project d
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and b.Project_id=d.Project_id and d.Check_method='內校' and c.".$cho_o." LIKE '%".$cho_input."%' and c.Status LIKE '%".$select."%' group by  b.Machine_id
order by b.Machine_id";
}
$result=sqlsrv_query($conn,$sql_1)or die("sql error".sqlsrv_errors());
while($row=sqlsrv_fetch_array($result)){
    for($i=0;$i<$x;$i++){
        if($array_mchine[$i][0]==$row[0]){
            $array_mchine[$i][4]=$row[1];
        }
    }
}
$sql_1="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c,DB_Project d
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and b.Project_id=d.Project_id and d.Check_method='外校'
group by  b.Machine_id
order by b.Machine_id";
if($cho_o=='xxx' and $cho_input!='xxx'){
    $sql_1="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c,DB_Project d
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and b.Project_id=d.Project_id and d.Check_method='外校' and c.".$cho_o." LIKE '%".$cho_input."%' group by  b.Machine_id
order by b.Machine_id";
}elseif($cho_o!='xxx' and $select!='全部'){
    $sql_1="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c,DB_Project d
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and b.Project_id=d.Project_id and d.Check_method='外校' and c.".$cho_o." LIKE '%".$cho_input."%' and c.Status LIKE '%".$select."%' group by  b.Machine_id
order by b.Machine_id";
}
$result=sqlsrv_query($conn,$sql_1)or die("sql error".sqlsrv_errors());
while($row=sqlsrv_fetch_array($result)){
    for($i=0;$i<$x;$i++){
        if($array_mchine[$i][0]==$row[0]){
            $array_mchine[$i][5]=$row[1];
        }
    }
}
$sql_1="select  b.Machine_id, c.Machine_name ,a.Next_calibration_date
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Next_calibration_date<GETDATE() and a.Test_result_status=0
group by  b.Machine_id, c.Machine_name,a.Next_calibration_date
order by b.Machine_id";
if($cho_o=='xxx' and $cho_input!='xxx'){
    $sql_1="select  b.Machine_id, c.Machine_name ,a.Next_calibration_date
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=0 and a.Next_calibration_date<ETDATE() and c.".$cho_o." LIKE '%".$cho_input."%' group by  b.Machine_id, c.Machine_name,a.Next_calibration_date
order by b.Machine_id";
}elseif($cho_o!='xxx'  and $select!='全部'){
    $sql_1="select  b.Machine_id, c.Machine_name ,a.Next_calibration_date
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=0 and a.Next_calibration_date<GETDATE() and c.".$cho_o." LIKE '%".$cho_input."%' and c.Status=".$select." group by  b.Machine_id, c.Machine_name,a.Next_calibration_date
order by b.Machine_id";
}
$result=sqlsrv_query($conn,$sql_1)or die("sql error".sqlsrv_errors());
while($row=sqlsrv_fetch_array($result)){
    for($i=0;$i<$x;$i++){
        if($array_mchine[$i][0]==$row[0]){
            $array_mchine[$i][6]+=1;
        }
    }
}?>
        <div class="col-md-4 " align="left">
            {!! $chart_group->script() !!}
        </div>
        <div class="col-md-4" align="center">
            {!! $chart_machine_course->script() !!}
        </div>
        <div class="col-md-4 " align="right">
            {!! $chart_corr->script() !!}
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br>
<div class='row'>
    <div class="table-responsive">
        <div class="col-md-10">
            <div class="input-group custom-search-form">
                {!! Form::open(['method'=>'GET','url'=>'report','class'=>'navbar-form navbar-left','role'=>'search']) !!}
                <label class="form-control" >狀態</label>
                <select name="tag_machine_1" id="tag_machine_1" class="form-control">
                    <option>全部</option>
                    <option  value="1">正常</option>
                    <option  value="0">維修</option>
                    <option  value="9">報廢</option>
                </select>
                <label class="form-control" >&</label>
                <select name="tag_machine_2" id="tag_machine_2" class="form-control">
                    <option  value="Machine_No">機器編號</option>
                    <option  value="Machine_name">機器名稱</option>
                </select>
                <input type="text" name="search" class="form-control" size="15">
                <button type="submit" class="form-control"><span class="glyphicon glyphicon-search"></span></button>
            </div>
        </div>
        {!! Form::close() !!}
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-borderless" id="report_tb" >
            <tr>
                <th width="70"><CENTER><font color="white">機器編號</font></CENTER></th>
                <th width="100"><CENTER><font color="white">機器名稱</font></CENTER></th>
                <th width="70"><CENTER><font color="white">內校次數</font></CENTER></th>
                <th width="70"><CENTER><font color="white">外校次數</font></CENTER></th>
                <th width="70"><CENTER><font color="white">正常次數</font></CENTER></th>
                <th width="70"><CENTER><font color="white">異常次數</font></CENTER></th>
                <th width="80"><CENTER><font color="white">未處理次數</font></CENTER></th>
                <th width="80"><CENTER><font color="white">送校中次數</font></CENTER></th>
                <th width="90"><CENTER><font color="white">逾期未校次數</font></CENTER></th>
                <th width="80"><CENTER><font color="white">機器保管人</font></CENTER></th>
                <th width="40"><CENTER><font color="white">狀態</font></CENTER></th>
            </tr>
            <?php
            for($ii=0;$ii<$x;$ii++){
            $sql="select Machine_No,Status,id,Machine_id from DB_Machine where Machine_id=".$array_mchine[$ii][0];
            if($cho_o=='xxx' and $cho_input!='xxx'){
                $sql="select Machine_No,Status,id,Machine_id from DB_Machine where Machine_id=".$array_mchine[$ii][0]." and ".$cho_o." LIKE '%".$cho_input."%'";
            }elseif($cho_o!='xxx' and $select!='xxx' and $select!='全部'){
                $sql="select Machine_No,Status,id,Machine_id from DB_Machine where Machine_id=".$array_mchine[$ii][0]." and ".$cho_o." LIKE '%".$cho_input."%' and Status=".$select;
            }
            $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
            $id=0; $status=0; $r=0; $Machine_key=0;
            while($row=sqlsrv_fetch_array($result)){
                $id=$row[0];
                $Machine_key=$row[3];
                if($row[1]==1){
                    $status='<font color="green"  style="font-weight:bold;">正 常</font>';
                    $r=1;
                }elseif($row[1]==0){
                    $status='<font color="orange"  style="font-weight:bold;">維 修</font>';
                    $r=0;
                }elseif($row[1]==9){
                    $status='<font color="red"  style="font-weight:bold;">報 廢</font>';
                    $r=9;
                }
                $sql="select Member_name from DB_Member where id=".$row[2];
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                while($row=sqlsrv_fetch_array($result)){
                    $name=$row[0];
                }
            }
            if(($select=='xxx') or ($select==$r and $id!=0) or ($cho_input!=null and $cho_input!=null)){ ?>
            <tr>
                <td><CENTER><?php echo $id;?></CENTER></td>
                <td><CENTER><?php echo $array_mchine[$ii][1]?></CENTER></td>
                <td><CENTER><a href="report/show?key=<?php echo $Machine_key?>&search=內校" ><?php echo $array_mchine[$ii][4]?></a></CENTER></td>
                <td><CENTER><a href="report/show?key=<?php echo $Machine_key?>&search=外校"><?php echo $array_mchine[$ii][5]?></a></CENTER></td>
                <td><CENTER><a href="report/show?key=<?php echo $Machine_key?>&search=1"><?php echo $array_mchine[$ii][3]?></a></CENTER></td>
                <td><CENTER><a href="report/show?key=<?php echo $Machine_key?>&search=9"><?php echo $array_mchine[$ii][9]?></a></CENTER></td>
                <td><CENTER><a href="report/show?key=<?php echo $Machine_key?>&search=0"><?php echo $array_mchine[$ii][7]?></a></CENTER></td>
                <td><CENTER><a href="report/show?key=<?php echo $Machine_key?>&search=2"><?php echo $array_mchine[$ii][8]?></a></CENTER></td>
                <td><CENTER><a href="report/show?key=<?php echo $Machine_key?>&search=逾期"><?php echo $array_mchine[$ii][6]?></a></CENTER></td>
                <td><CENTER><?php echo  $name?></CENTER></td>
                <td><CENTER><?php echo  $status?></CENTER></td>
            </tr>
            <?php
                }
            }?>
        </table>
    </div>
</div>
</body>
</html>
@endsection