<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2017/7/12
 * Time: 下午 09:15
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use ConsoleTVs\Charts\Facades\Charts;
use Validator;
use Response;
use Illuminate\Support\Facades\Auth;
class homecontroller extends Controller
{
    public function index()
    {
        $serverName = "calibration.database.windows.net";
        $connectionInfo = array( "Database"=>"calibration", "UID"=>"en", "PWD"=>"@sS10314161", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $m_count_sql="select count(b.Test_result_status) 
from DB_Machinelist a,DB_Schedule b,DB_Machine c
where a.Machine_list_id=b.Machine_list_id and b.Test_result_status=0 and c.Machine_id=a.Machine_id and c.id=".Auth::user()->id;
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        $array_m_count_sch[]=0;
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[0]=$row[0];     //  0
        }
        $m_count_sql="select count(b.Test_result_status) 
from DB_Machinelist a,DB_Schedule b,DB_Machine c
where a.Machine_list_id=b.Machine_list_id and b.Test_result_status=1 and c.Machine_id=a.Machine_id and c.id=".Auth::user()->id;
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[1]=$row[0];     //  1
        }
        $m_count_sql="select count(b.Test_result_status) 
from DB_Machinelist a,DB_Schedule b,DB_Machine c
where a.Machine_list_id=b.Machine_list_id and b.Test_result_status=2 and c.Machine_id=a.Machine_id and c.id=".Auth::user()->id;
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[2]=$row[0];     //  2
        }
        $m_count_sql="select count(b.Test_result_status) 
from DB_Machinelist a,DB_Schedule b,DB_Machine d
where a.Machine_list_id=b.Machine_list_id and b.Test_result_status=9 and d.Machine_id=a.Machine_id and d.id=".Auth::user()->id;
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[9]=$row[0];     //  9
        }
        $m_count_sql="select count(c.Check_method)
from DB_Machinelist a,DB_Schedule b,DB_Project c,DB_Machine d
where a.Machine_list_id=b.Machine_list_id and c.Project_id=a.Project_id and c.Check_method='內校' and d.Machine_id=a.Machine_id and d.id=".Auth::user()->id;
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[11]=$row[0];     //  內校
        }
        $m_count_sql="select count(c.Check_method)
from DB_Machinelist a,DB_Schedule b,DB_Project c,DB_Machine d
where a.Machine_list_id=b.Machine_list_id and c.Project_id=a.Project_id and c.Check_method='外校' and d.Machine_id=a.Machine_id and d.id=".Auth::user()->id;
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[12]=$row[0];     //  外校
        }
        $m_count_sql="select count(b.Next_calibration_date)
from DB_Machinelist a,DB_Schedule b,DB_Machine d
where a.Machine_list_id=b.Machine_list_id and b.Next_calibration_date<GETDATE() and d.Machine_id=a.Machine_id and b.Test_result_status=0 and d.id=".Auth::user()->id;
        $result=sqlsrv_query($conn,$m_count_sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $array_m_count_sch[15]=$row[0];     //  逾期未校
        }
        $chart1=Charts::multi('bar', 'chartjs')
            ->title("機 器 生 命 週 期")
            ->dimensions(500, 300) // Width x Height
            ->colors(['#FFDDAA','#FFBB66','#BBFF66','#FFA488','#FF8888','#DDDDDD','#888888'])
            ->dataset('未處理',[$array_m_count_sch[0]])
            ->dataset('送校中',[$array_m_count_sch[2]])
            ->dataset('正常', [$array_m_count_sch[1]])
            ->dataset('異常', [$array_m_count_sch[9]])
            ->labels([Auth::user()->Member_name]);

        $chart_corr=Charts::create('donut','chartjs')
            ->title('校 正 管 理')
            ->labels(['內校','外校','逾期未校'])
            ->values([$array_m_count_sch[11],$array_m_count_sch[12],$array_m_count_sch[15]])
            ->colors(['#99FF99','#CCBBFF','#FFA488'])
            ->dimensions(600,250)
            ->responsive(false);

        return view('home.index', ['chart1' => $chart1,'chart_corr' => $chart_corr]);
    }
    public function show()
    {
        return view('home.show');
    }
}
