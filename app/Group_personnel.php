<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Group_personnel extends Model
{
    use Sortable;

    public $fillable = ['Group_personnel_id','Group_id','id','Create_id','Create_time'];
    public $table ='DB_Group_personnel';

    public $sortable = ['Group_personnel_id','Group_id','id','Create_id','Create_time'];

    protected $primaryKey = 'Group_personnel_id';
    public $timestamps = false;

}




