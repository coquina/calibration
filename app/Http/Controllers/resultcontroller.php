<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2017/6/9
 * Time: 下午 02:40
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\result;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class resultcontroller extends Controller
{
    public function index(Request $request)
    {
        $sort = \Request::get('sort','Result_id');
        $search_1 = \Request::get('search_1');
        $tag_sch= \Request::get('tag_sch', 'Result_id');
        if($search_1!=null){
            $tag_sch='Schedule_id';
        }
        $results= result::where($tag_sch, 'like', '%' .$search_1. '%')
            ->orderBy($sort,"DESC")
            ->paginate(10);
        return view('result.index', compact('results'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('result.create',compact('results'));
    }

    public function store(Request $request)
    {
        $serverName = "163.17.9.113\SQLEXPRESS";
        $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $_count = count($_POST['Line']);
        $array_addsql[]=0;
        if($_count>0){
            for($_i=0;$_i<$_count;$_i++){
                $array_addsql[$_i]="insert into DB_TestResult (Schedule_id,Line,Lndication_value,Standard_value,D_value,Minimum_uncertainty)
                                    values(".$_POST['Schedule_id'].','.$_POST['Line'][$_i].','.$_POST['Lndication_value'][$_i].','.
                                    $_POST['Standard_value'][$_i].','.$_POST['D_value'][$_i].','.$_POST['Minimum_uncertainty'][$_i].')';
                $query=sqlsrv_query($conn,$array_addsql[$_i]);
            }
        }
        return redirect()->route('result.index')
            ->with('success','新增成功');
    }
}