<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    protected $primaryKey = 'Schedule_id';
    public $fillable = ['Schedule_id','Machine_list_id','Next_calibration_date','Suggested_date','Test_result_status','TestResult_raw_file','Applicant','Correction_company','Model','Serial_Number'
        , 'Procedure_Used','Received_Date','Temperature','Relative_Humidity','Consumer_Address','Location','Traceability','Report_No','Due_Date','Version'];
    public $table='DB_Schedule';
}
