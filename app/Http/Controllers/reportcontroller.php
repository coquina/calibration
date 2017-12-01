<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Report;
use App\machine;
use Charts;
use Illuminate\Support\Facades\Auth;
class reportcontroller extends Controller
{
    public function index(Request $request)
    {
    $serverName = "163.17.9.113";
    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    $sql_count="select id,Member_name from DB_Member";
    $result=sqlsrv_query($conn,$sql_count)or die("sql error".sqlsrv_errors());
    $array_count[][]=0; $x=0;
    while($row=sqlsrv_fetch_array($result)){
        $array_count[$x][0]=$row[0];    //id
        $array_count[$x][1]=$row[1];    //name
        $x++;
    }
    $array_mach[][]=0;
    for($q=0;$q<$x ;$q++) {
        $sql_list="select Machine_list_id from DB_Machinelist where Machine_id=";
        $sql_count="select Machine_id from DB_Machine where id=".$array_count[$q][0];
        $result=sqlsrv_query($conn,$sql_count)or die("sql error".sqlsrv_errors());
        $chk_row=0;
        while($row=sqlsrv_fetch_array($result)){
            $chk_row=$row[0];
            if($row != null){
                $sql_list=$sql_list.$row[0]." or Machine_id=";
            }
        }
        $sql_list=$sql_list.$chk_row;
        $result=sqlsrv_query($conn,$sql_list)or die("sql error".sqlsrv_errors());
        $sql_sch="select Schedule_id,Machine_list_id,Next_calibration_date from DB_Schedule where Machine_list_id=";
        while($row=sqlsrv_fetch_array($result)){
            $chk_row=$row[0];
            if($row != null){
                $sql_sch=$sql_sch.$row[0]." or Machine_list_id=";
            }
        }
        $sql_sch=$sql_sch.$chk_row;
        $array_count[$q][2]=$sql_sch;
    }
    for($e=0;$e<$x;$e++){
        $array_count[$e][5]=0;      //逾期次數
        $result=sqlsrv_query($conn,$array_count[$e][2])or die("sql error".sqlsrv_errors());
        $xx=0; $array_x[][]=0;
        while($row=sqlsrv_fetch_array($result)){
            $array_x[$xx][0]=$row[0];
            $array_x[$xx][1]=$row[1];
            $array_x[$xx][2]=$row[2];
            $xx++;
        }
        for($t=0;$t<$xx;$t++){
            date_default_timezone_set('Asia/Taipei');
            $datetime = date ("Y-m-d");
            if($datetime>($array_x[$t][2]->format('Y-m-d'))){
                $array_count[$e][5]++;
            }
        }
    }
        $Array_member=array();    //人員 array
        $Array_out=array();       //逾期數量 array
    for($i=0;$i<$x;$i++){
        $Array_member[$i]=$array_count[$i][1];
        $Array_out[$i]=$array_count[$i][5];
    }
        $chart_method=Charts::create('donut','chartjs')
        ->title('逾 期 機 器')
        ->labels($Array_member)
        ->values($Array_out)
        ->colors(['#00FF99','#FF0000','#FF5511','#FF8800','#FFBB00','#77FF00'])
        ->dimensions(500,300)
        ->responsive(false);

        $sql_g="select  a.Group_id, a.Group_name ,count(b.Group_id)
from DB_Group a,DB_Group_personnel b
where b.Group_id=a.Group_id
GROUP BY  a.Group_id, a.Group_name
";
        $result=sqlsrv_query($conn,$sql_g)or die("sql error".sqlsrv_errors());
       $array_g_name=Array();
        $array_g_count=Array();
        $t++;
        while($row=sqlsrv_fetch_array($result)){
            $array_g_name[$t]=$row[1];
            $array_g_count[$t]=$row[2];
            $t++;
        }
        $sql_machine_type="select Status from DB_Machine";
        $result=sqlsrv_query($conn,$sql_machine_type)or die("sql error".sqlsrv_errors());
        $machine_type_1=0;  //正常
        $machine_type_0=0;  //維修
        $machine_type_9=0;  //報廢
        while($row=sqlsrv_fetch_array($result)){
            if($row[0]==1){
                $machine_type_1++;
            }elseif($row[0]==0){
                $machine_type_0++;
            }elseif($row[0]==9){
                $machine_type_9++;
            }
        }

        $chart_group=Charts::create('donut','chartjs')
            ->title('機 器 管 理')
            ->labels(['正常','維修','報廢'])
            ->values([$machine_type_1,$machine_type_0,$machine_type_9])
            ->colors(['#99FF99','#FFDD55','#FFA488'])
            ->dimensions(280,200)
            ->responsive(false);

        $m_count_sql="select count(b.Test_result_status) 
from DB_Machinelist a,DB_Schedule b
where a.Machine_list_id=b.Machine_list_id and b.Test_result_status=0";
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        $array_m_count_sch[]=0;
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[0]=$row[0];     //  0
        }
        $m_count_sql="select count(b.Test_result_status) 
from DB_Machinelist a,DB_Schedule b
where a.Machine_list_id=b.Machine_list_id and b.Test_result_status=1";
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[1]=$row[0];     //  1
        }
        $m_count_sql="select count(b.Test_result_status) 
from DB_Machinelist a,DB_Schedule b
where a.Machine_list_id=b.Machine_list_id and b.Test_result_status=2";
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[2]=$row[0];     //  2
        }
        $m_count_sql="select count(b.Test_result_status) 
from DB_Machinelist a,DB_Schedule b
where a.Machine_list_id=b.Machine_list_id and b.Test_result_status=9";
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[9]=$row[0];     //  9
        }
        $m_count_sql="select count(c.Check_method)
from DB_Machinelist a,DB_Schedule b,DB_Project c
where a.Machine_list_id=b.Machine_list_id and c.Project_id=a.Project_id and c.Check_method='內校'";
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[11]=$row[0];     //  內校
        }
        $m_count_sql="select count(c.Check_method)
from DB_Machinelist a,DB_Schedule b,DB_Project c
where a.Machine_list_id=b.Machine_list_id and c.Project_id=a.Project_id and c.Check_method='外校'";
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[12]=$row[0];     //  外校
        }
        $m_count_sql="select count(b.Next_calibration_date)
from DB_Machinelist a,DB_Schedule b
where a.Machine_list_id=b.Machine_list_id and b.Next_calibration_date>GETDATE()";
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[15]=$row[0];     //  逾期未校
        }
        $chart_machine_course=Charts::multi('bar', 'chartjs')
            ->title("機 器 生 命 週 期")
            ->dimensions(400, 220) // Width x Height
            ->colors(['#FFDDAA','#FFBB66','#BBFF66','#FFA488','#FF8888','#DDDDDD','#888888'])
            ->dataset('未處理',[$array_m_count_sch[0]])
            ->dataset('送校中',[$array_m_count_sch[2]])
            ->dataset('正常', [$array_m_count_sch[1]])
            ->dataset('異常', [$array_m_count_sch[9]])
            ->labels(['ALL']);

        $chart_corr=Charts::create('donut','chartjs')
            ->title('校 正')
            ->labels(['內校','外校','逾期未校'])
            ->values([$array_m_count_sch[11],$array_m_count_sch[12],$array_m_count_sch[15]])
            ->colors(['#99FF99','#CCBBFF','#FFA488'])
            ->dimensions(500,200)
            ->responsive(false);
        $reports=machine::where('id','=',Auth::user()->id)->paginate(3);
        return view('report.index', compact('reports'),['chart' => $chart_method,'chart_machine_course' => $chart_machine_course,'chart_group' => $chart_group,'chart_corr' =>$chart_corr])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function show()
    {
        return view('report.show');
    }
}
?>

