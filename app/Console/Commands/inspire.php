<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class inspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chk:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '自動開始逐一處理各筆排程資料。';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info('*****排程管理開始*****');
        $serverName = "163.17.9.113";
        $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $sql="select a.Machine_list_id,c.Purchase_date,b.Cycle,d.Version
from DB_Machinelist a,DB_Project b,DB_Machine c,DB_Standard d
where a.Project_id=b.Project_id and a.Machine_id=c.Machine_id and b.Standard_id=d.Standard_id and a.Newold_status=0";
        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $years=date_format($row[1], 'Y');
            $months=date_format($row[1], 'm');
            $days=date_format($row[1], 'd');
            $row[1] = date("Y-m-d",mktime(0,0,0,$months+$row[2],$days,$years));
            $sql_update_status="update DB_Machinelist set Newold_status=1 where Machine_list_id=".$row[0];
            $query=sqlsrv_query($conn,$sql_update_status);
            $sql_create_sc="INSERT INTO DB_Schedule(Machine_list_id,Next_calibration_date,Test_result_status,Check_key,Version) values(".$row[0].",'".$row[1]."',0,0,".$row[3].")";
            $query=sqlsrv_query($conn,$sql_create_sc);                     //依以上資料產生新排程，並寫入 DB_Schedule 資料表
        }
        $sql="select a.Machine_list_id,a.Next_calibration_date,a.Suggested_date,a.Test_result_status,c.Cycle,d.Version,a.Check_key,e.Machine_id,a.Schedule_id
from DB_Schedule a,DB_Machinelist b,DB_Project c,DB_Standard d,DB_Machine e
where a.Machine_list_id=b.Machine_list_id and b.Project_id=c.Project_id and c.Standard_id=d.Standard_id and b.Machine_id=e.Machine_id";
        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            if($row[3]==1 and $row[6]==0){        // 正常 產生新排程
                if($row[2]!=null){
                    $sql_create_sc_o="INSERT INTO DB_Schedule(Machine_list_id,Next_calibration_date,Test_result_status,Version,Check_key) values(".$row[0].",'".date_format($row[2],'Y-m-d')."',0,".$row[5].",0)";
                    $query=sqlsrv_query($conn,$sql_create_sc_o);                     //依以上資料產生新排程，並寫入 DB_Schedule 資料表
                    $sql_fix_status="UPDATE DB_Schedule SET Check_key = 1 WHERE Schedule_id=".$row[8];
                    $query=sqlsrv_query($conn,$sql_fix_status);
                }else{
                    $years=date_format($row[1], 'Y');
                    $months=date_format($row[1], 'm');
                    $days=date_format($row[1], 'd');
                    $date = date("Y-m-d",mktime(0,0,0,$months+$row[4],$days,$years));
                    $sql_create_sc_o="INSERT INTO DB_Schedule(Machine_list_id,Next_calibration_date,Test_result_status,Version,Check_key) values(".$row[0].",'".$date."',0,".$row[5].",0)";
                    $query=sqlsrv_query($conn,$sql_create_sc_o);                     //依以上資料產生新排程，並寫入 DB_Schedule 資料表
                    $sql_fix_status="UPDATE DB_Schedule SET Check_key = 1 WHERE Schedule_id=".$row[8];
                    $query=sqlsrv_query($conn,$sql_fix_status);
                }
            }elseif($row[3]==9 and $row[6]==0){
                $sql_mod_s="UPDATE DB_Machine SET Status = 0 WHERE Machine_id =".$row[7];
                $query=sqlsrv_query($conn,$sql_mod_s);                     //將 Test_result_status 為【異常(9)】之機器狀態更改為 維修(0)
                $sql_fix_status="UPDATE DB_Schedule SET Check_key = 1 WHERE Schedule_id=".$row[8];
                $query=sqlsrv_query($conn,$sql_fix_status);
            }
        }
        \Log::info('*****排程管理結束*****');
    }
}