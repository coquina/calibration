<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Standard extends Model
{

    use Sortable;

    protected $primaryKey = 'Standard_id';
    public $timestamps = false;
    public $fillable = ['Standard_id','Standard_no','Standard_name','Create_id','Create_time', 'File_norm' ,'File_norm_code','Cycle_R','S_Department','Issuse_Department','Citation','Version','Standard_Status'];
    public $table='DB_Standard';

    public $sortable = ['Standard_no','Standard_name', 'Create_id', 'Cycle_R', 'Version'];
}
