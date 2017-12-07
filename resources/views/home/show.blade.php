@extends('layouts.default')
@section('content')
    <style>
        table#home_tb tr:nth-child(even) {
            background-color: #eee;
        }
        table#home_tb tr:nth-child(odd) {
            background-color:#fff;
        }
        table#home_tb th {
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
        <div class="col-md-20">
            <h2><a href="{{ route('home.index') }}"><font color="gray">首頁&nbsp;</font></a><font color="gray" size="5"><span class="glyphicon glyphicon-menu-right"></span></font><font color="black">&nbsp;機器生命週期</font></h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <center>
            <table class="table table-borderless" id="home_tb">
                <tr>
                    <th  width="100"><center><font color="white">機器編號</font></center></th>
                    <th  width="100"><center><font color="white">計畫名稱</font></center></th>
                    <th  width="100"><center><font color="white">機器名稱</font></center></th>
                    <th  width="100"><center><font color="white">校驗日期</font></center></th>
                    <th  width="100"><center><font color="white">校驗方式</font></center>
                    <th  width="100"><center><font color="white">週期(月)</font></center></th>
                    <th  width="100"><center><font color="white">狀態</font></center></th>
                </tr>
                <?php
                use Illuminate\Support\Facades\Auth;
                $serverName = "calibration.database.windows.net";
                $connectionInfo = array( "Database"=>"calibration", "UID"=>"en", "PWD"=>"@sS10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                if(($_GET['search'] == '內校') or ($_GET['search']=='外校')){
                    $sql="select a.Machine_No,c.Project_name,a.Machine_name,d.Next_calibration_date,c.Check_method,c.Cycle,d.Test_result_status
from DB_Machine a,DB_Machinelist b,DB_Project c,DB_Schedule d
where a.Machine_id=b.Machine_id and c.Project_id=b.Project_id and d.Machine_list_id=b.Machine_list_id and c.Check_method='".$_GET['search']."' and b.Machine_id=".$_GET['key'];
                }else{
                    $search=0;
                    if($_GET['search']==0){
                        $search=0;
                    }elseif($_GET['search']==1){
                        $search=1;
                    }elseif($_GET['search']==2){
                        $search=2;
                    }elseif($_GET['search']==9){
                        $search=9;
                    }
                    $sql="select a.Machine_No,c.Project_name,a.Machine_name,d.Next_calibration_date,c.Check_method,c.Cycle,d.Test_result_status
from DB_Machine a,DB_Machinelist b,DB_Project c,DB_Schedule d
where a.Machine_id=b.Machine_id and c.Project_id=b.Project_id and d.Machine_list_id=b.Machine_list_id and d.Test_result_status=".$search." and b.Machine_id=".$_GET['key'];
                }
                if($_GET['search']=='逾期'){
                    $sql="select a.Machine_No,c.Project_name,a.Machine_name,d.Next_calibration_date,c.Check_method,c.Cycle,d.Test_result_status
from DB_Machine a,DB_Machinelist b,DB_Project c,DB_Schedule d
where a.Machine_id=b.Machine_id and c.Project_id=b.Project_id and d.Machine_list_id=b.Machine_list_id and d.Test_result_status=0 and d.Next_calibration_date<GETDATE()"." and b.Machine_id=".$_GET['key'];


                }
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                while($row=sqlsrv_fetch_array($result)){
                    if($row[6]==0){
                       $status='<font color="#808080"  style="font-weight:bold;">未 處 理</font>';
                    }elseif($row[6]==1){
                        $status='<font color="green"  style="font-weight:bold;">正 常</font>';
                    }elseif($row[6]==2){
                        $status='<font color="orange"  style="font-weight:bold;">校 正 中</font>';
                    }elseif($row[6]==9){
                        $status='<font color="red"  style="font-weight:bold;">異 常</font>';
                    }
                    ?>
                <tr>
                    <td><center><?php echo $row[0]?></center></td>
                    <td><center><?php echo $row[1]?></center></td>
                    <td><center><?php echo $row[2]?></center></td>
                    <td><center><?php echo date_format($row[3],'Y-m-d')?></center></td>
                    <td><center><?php echo $row[4]?></center></td>
                    <td><center><?php echo $row[5]?></center></td>
                    <td><center><?php echo $status?></center></td>
                </tr>
                <?php } ?>
            </table>
            </center>
        </div>
    </div>






@endsection