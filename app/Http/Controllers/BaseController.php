<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\cho;
use App\machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct()
    {
        //its just a dummy data object.
//        $users = DB::table('DB_Machuine')->lists('lab_name');
//        $machinelist=cho::all('Machine_id');
//        $machine =machine::all('Machine_name');
//        $machinmatch= machine::where($alert_search, 'like', '%' .$search. '%')-
//        $machinmatch=machine::whereIn('Machine_id',$machinelist);

        $machinmatch = DB::table('DB_Machine')
            ->join('DB_Machinelist', 'DB_Machine.Machine_id', '=', 'DB_Machinelist.Machine_id')
            ->select('DB_Machine.Machine_name')
            ->get();
        // Sharing is caring
        View::share('machinmatch', $machinmatch);
    }
}