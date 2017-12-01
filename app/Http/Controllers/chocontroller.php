<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\cho;
use App\Standard;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class chocontroller extends Controller
{
    public function index(Request $request)
    {
        $tag_list = \Request::get('tag_list','Project_id');
        $search = \Request::get('search',$_GET['p_id']);
        $chos=cho::where($tag_list,'like','%'.$search.'%')->orderBy('Machine_list_id','DESC')->paginate(30);
        return view('cho.index',compact('chos'))
            ->with('i',($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('cho.create',compact('chos'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'Project_id' => 'required',
            'Machine_id' => 'required',
            'Newold_status' => 'required',
            'Create_id' => 'required',
            'Create_time' => 'required',
        ]);
       cho::create($request->all());
        return redirect()->route('cho.index','p_id='.$_POST['p_id'])
            ->with('success','新增成功');
    }

    public function destroy($id)
    {
        $serverName = "163.17.9.113";
        $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $sql="select Newold_status,Project_id from DB_Machinelist where Machine_list_id=".$id;
        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            if($row[0]==1){
                return redirect()->route('cho.index','p_id='.$row[1])
                    ->with('success','已進入排程 無法刪除');
            }else{
                cho::find($id)->delete();
                return redirect()->route('cho.index','p_id='.$row[1])
                    ->with('success','刪除成功');
            }
        }
    }
}
