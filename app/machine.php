<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class machine extends Model
{
    use sortable;
    protected $primaryKey = 'Machine_id';
    public $timestamps = false;
    public $fillable = ['Machine_No','Machine_name','Purchase_date','Status','Machine_prices','Service_life','Instrument_sort','Purchasing_department','Manfaucturer','Model','id'];
    protected $table ='DB_Machine';
//    public $sortable = ['Machine_No','Machine_name', 'Purchase_date'];
    public function machine(){
        return $this->belongsToMany('App\alert');
    }
}
