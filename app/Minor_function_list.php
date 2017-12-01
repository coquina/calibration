<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Minor_function_list extends Model
{
    use sortable;
    protected $primaryKey = 'Minor_function_id';
    public $timestamps = false;
    public $fillable = ['Minor_function_id','Minor_function_No','Minor_function_name','Main_function_id','Create_id', 'Create_time' ,'Description','Status','Minor_function_program'];
    public $table='DB_Minor_function_list';
    public $sortable = ['Minor_function_id','Minor_function_No','Minor_function_name','Main_function_id','Create_id', 'Create_time' ,'Description','Status','Minor_function_program'];
}
