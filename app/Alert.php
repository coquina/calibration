<?php

namespace App;

use App\machine;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Alert extends Model
{
    use Sortable;

    public function alert(){
        return $this->belongsToMany('App\machine');
    }

    protected $primaryKey = 'Schedule_id';
    public $timestamps = false;
    public $fillable = ['Schedule_id','Machine_list_id','Next_calibration_date','Suggested_date','Test_result_status','TestResult_raw_file', 'Applicant','Correction_company','Model','Serial_Number',
        'Procedure_Used','Received_Date','Temperature','Relative_Humidity','Consumer_Address','Location','Traceability','Report_No','Due_Date','Version'];
    public $sortable = ['Machine_list_id','Next_calibration_date', 'Suggested_date'];
    protected $table ='DB_Schedule';



}
