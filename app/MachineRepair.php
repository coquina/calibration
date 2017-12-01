<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class MachineRepair extends Model
{
    use Sortable;
    protected $primaryKey = 'Repair_id';
    public $timestamps = false;
    public $fillable = ['Repair_id','Machine_id','Repair_No','Service_date','Maintain', 'Degree_scale' ,'Zeroing_calibration','Screw_lock','lubrication_maintenance','Abnormality_log','Annual','MachineRepair_status','Remark','Create_time','Create_Id'];
    public $table='DB_MachineRepair';
    public $sortable = ['Repair_id','Machine_id','Repair_No','Service_date','Maintain', 'Degree_scale' ,'Zeroing_calibration','Screw_lock','lubrication_maintenance','Abnormality_log','Annual','MachineRepair_status','Remark','Create_time','Create_Id'];

}
