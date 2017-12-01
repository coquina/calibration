<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2017/6/9
 * Time: 下午 02:35
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class result extends Model
{
    protected $primaryKey = 'Result_id';
    public $timestamps = false;
    public $fillable = ['Schedule_id','Line','Lndication_value','Standard_value','D_value','Minimum_uncertainty'];
    protected $table ='DB_TestResult';
}