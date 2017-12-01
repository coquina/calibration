<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Parameter extends Model{
    use Sortable;
    protected $primaryKey = 'Parameter_id';
    public $timestamps = false;
    public $fillable = ['Parameter_id','Parameter_name','Parameter','Create_id','Create_time', 'Description' ,'Status'];
    public $table='DB_Parameter';
    public $sortable = ['Parameter_id','Parameter_name','Parameter','Create_id','Create_time', 'Description' ,'Status'];
}
