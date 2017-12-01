<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class choosemachine extends Model
{
    protected $primaryKey = 'Machine_list_id';
    public $timestamps = false;
    public $fillable = ['Project_id','Machine_id','Newold_status','Create_id','Create_time'];
    protected $table ='DB_Machinelist';
}
