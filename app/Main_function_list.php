<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Main_function_list extends Model
{
    use sortable;
    protected $primaryKey = 'Main_function_id';
    public $timestamps = false;
    public $fillable = ['Main_function_id','Main_function_No','Main_function_name','Create_id','Create_time', 'Description' ,'Status','icon'];
    public $table='DB_Main_function_list';
    public $sortable = ['Main_function_id','Main_function_No','Main_function_name','Create_id','Create_time', 'Description' ,'Status','icon'];
}
