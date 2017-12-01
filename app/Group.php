<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;



class Group extends Model
{
    use Sortable;

    protected $primaryKey = 'Group_id';
    public $timestamps = false;

    public $fillable = ['Group_id','Group_No','Group_name','Create_id','Create_time', 'Description' ,'Status'];
    public $table='DB_Group';

    public $sortable = ['Group_id','Group_No','Group_name','Create_id','Create_time', 'Description' ,'Status'];

}
