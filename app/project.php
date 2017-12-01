<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class project extends Model
{

    use Sortable;

    protected $primaryKey = 'Project_id';
    public $timestamps = false;
    public $fillable = ['Project_No','Standard_id','Project_name','Check_method','Cycle','Create_id','Create_time'];
    protected $table ='DB_Project';
}
