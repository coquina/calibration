<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2017/6/9
 * Time: 下午 02:35
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class schedule extends Model
{
    use Sortable;
    protected $primaryKey = 'Schedule_id';
    public $timestamps = false;
    public $fillable = ['Schedule_id','Machine_list_id','Next_calibration_date','Suggested_date','Test_result_status','TestResult_raw_file', 'Applicant','Correction_company','Model','Serial_Number',
                        'Procedure_Used','Received_Date','Temperature','Relative_Humidity','Consumer_Address','Location','Traceability','Report_No','Due_Date','Version'];
    protected $table ='DB_Schedule';
}