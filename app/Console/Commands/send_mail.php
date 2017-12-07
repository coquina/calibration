<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Carbon;
use App\Mail\Reminder;
use App\Mail\Alert;
use App\Mail\Expire;
use Illuminate\Support\Facades\Mail;
class send_mail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '發送預警mail';

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
        \Log::info('*****預警排程開始*****');
        $serverName = "163.17.9.113";
        $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $sql_get_chk="select a.Next_calibration_date,d.email,a.Schedule_id 
from DB_Schedule a,DB_Machinelist b,DB_Machine c,DB_Member d
where a.Machine_list_id=b.Machine_list_id and a.Test_result_status=0 and b.Machine_id=c.Machine_id and c.id=d.id";    //逐一取得 下次校驗日期 & 機器選單編號
        $result=sqlsrv_query($conn,$sql_get_chk)or die("sql error".sqlsrv_errors());
        $now_time= Carbon\Carbon::now()->format('Y-m-d');       //抓取當下時間
        while($row=sqlsrv_fetch_array($result)){
            $years=date_format($row[0], 'Y');
            $months=date_format($row[0], 'm');
            $days=date_format($row[0], 'd');
            $row[0] = date("Y-m-d",mktime(0,0,0,$months,$days,$years));
            $alert_date = date("Y-m-d",mktime(0,0,0,$months,$days-7,$years));
            if($row[0]==$now_time){
                //逐筆判斷 下次校驗日期是否等於現在日期
                Mail::to($row[1])->send(new Alert);          //等於-----------------------------已到
            }else if($alert_date==$now_time){
                Mail::to($row[1])->send(new Reminder);       //等於-----------------------------已到預警日期
            }else if($row[0]<$now_time){
                Mail::to($row[1])->send(new Expire);        //等於-----------------------------過期
            }
        }
        \Log::info('*****預警排程結束*****')  ;
    }
}
