<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Member extends Model
{
    use Sortable;

    public $fillable = ['Account_number','password','Member_name','email','Job_title','Member_phone','Cell_phone','Member_address'];
    public $table='DB_Member';

    public $sortable = ['id','Account_number', 'Member_name', 'email', 'Job_title', 'Member_phone','Cell_phone','Member_address'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
