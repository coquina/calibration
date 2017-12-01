<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cho extends Model
{
    protected $primaryKey = 'Machine_list_id';
    public $timestamps = false;
    public $fillable = ['Machine_list_id','Project_id','Machine_id','Newold_status','Create_id','Create_time'];
    protected $table ='DB_Machinelist';
}
