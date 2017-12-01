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
        \Log::info('I was  here @'.\Carbon\Carbon::now());
        $serverName = "163.17.9.113";
        $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $sql_get_chk="select Next_calibration_date,Machine_list_id from DB_Schedule";    //逐一取得 下次校驗日期 & 機器選單編號
        $result=sqlsrv_query($conn,$sql_get_chk)or die("sql error".sqlsrv_errors());
        $now_time= Carbon\Carbon::now()->format('Y-m-d');       //抓取當下時間
        $array_chk[][]=0; $chk_n=0;                             //變數
        while($row=sqlsrv_fetch_array($result)){
            $array_chk[$chk_n][0]=$row[0];                      //取得 下次校驗日期
            $array_chk[$chk_n][1]=$row[1];                      //取得 機器選單編號
            $chk_n++;
        }
        for($x = 0; $x < $chk_n; $x++){                         //以 DB_Schedule 之資料總比數 執行for迴圈
                $sql_get_list="select Machine_id from DB_Machinelist where Machine_list_id=".$array_chk[$x][1];    //依機器選單編號取得-機器編號
                $result=sqlsrv_query($conn,$sql_get_list)or die("sql error".sqlsrv_errors());
                $array_getm[][]=0;                            //變數
                while($row=sqlsrv_fetch_array($result)){
                    $array_getm[$x][0]=$row[0];                      //取得機器編號
                }
                $sql_get_m="select id from DB_Machine where Machine_id=".$array_getm[$x][0];    //依機器編號取得-帳號
                $result=sqlsrv_query($conn,$sql_get_m)or die("sql error".sqlsrv_errors());
                $array_getm_na[][]=0;                            //變數
                while($row=sqlsrv_fetch_array($result)){
                    $array_getm_na[$x][0]=$row[0];                      //取得 帳號
                }
                $sql_mm="select email from DB_Member where id='".$array_getm_na[$x][0]."'";    //依帳號取得-mail
                $result=sqlsrv_query($conn,$sql_mm)or die("sql error".sqlsrv_errors());
                $array_mail[][]=0;               //變數
                while($row=sqlsrv_fetch_array($result)){
                    $array_mail[$x][0]=$row[0];                      //取得 mail
                }$user_mail=$array_mail[$x][0];
            if($array_chk[$x][0]==$now_time){                   //逐筆判斷 下次校驗日期是否等於現在日期
                echo $array_chk[$x][0]."已到"."<br>";
                Mail::to($user_mail)->send(new Alert);//等於------------------------------------已到
            }else{                                              //不等於----------------------------------今日不是校驗日期
                $years=date_format($array_chk[$x][0], 'Y');
                $months=date_format($array_chk[$x][0], 'm');
                $days=date_format($array_chk[$x][0], 'd');
                $array_chk[$x][0] = date("Y-m-d",mktime(0,0,0,$months,$days-7,$years));//以下次校驗日期減七天 為預警日期
                if( $array_chk[$x][0]==$now_time){
                    echo $array_chk[$x][0]."已到預警日期"."<br>";                          //預警日期 = 現在日期------------發送E-mail預警
                    Mail::to($user_mail)->send(new Reminder);
                }else{
                    if($array_chk[$x][0]>$now_time){                                       //預警日期 != 現在日期------------判斷為 未到 or 過期
                        echo $array_chk[$x][0]."未到"."<br>";
                    }else{
                        echo $array_chk[$x][0]."過期"."<br>";
                        Mail::to($user_mail)->send(new Expire);
                    }
                }
            }
        }
    }
}
