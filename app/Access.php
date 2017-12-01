<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Access extends Model
{
    use sortable;
    protected $primaryKey = 'Access_id';
    public $timestamps = false;
    public $fillable = ['Access_id','Group_id','Minor_function_id','Create_id','Create_time'];
    public $table='DB_Access';
    public $sortable = ['Access_id','Group_id','Minor_function_id','Create_id','Create_time'];
}
