<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\MachineRepair;
use App\machine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Main_function_list;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class MachineRepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */

    public function index(Request $request)
    {

        $m_id = \Request::get('m_id');

//        $Machine=\Request::get('MachineRepair','MachineRepair_status');
//        $search = \Request::get('search');
//        if($m_id != "1"){
//            $search = $m_id;
//            $Machine = "Machine_id";
//        }
//        $bbb=MachineRepair::where($Machine,'like','%'.$search.'%')/*->where('MachineRepair_status','=','1')*/->orderBy('Repair_id','DESC')->paginate(5);
        $bbb=MachineRepair::where('Machine_id','=',$m_id)->sortable()->paginate(10);



        #return $bbb;

        return view('MachineRepair.index',compact('bbb'))
            ->with('i', ($request->input('page', 1) - 1) * 5);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { return view('MachineRepair.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            //'Repair_id' => 'required',
            'Machine_id'=>'required',
            'Repair_No' => 'bail|required|integer|unique:DB_MachineRepair',
            //'Repair_No' => ['bail|required|integer' => '!請輸入數字'],
            //'Service_date' => 'required',
            'Maintain' => 'required',
           'Degree_scale' => 'required',
            'Zeroing_calibration' => 'required',
            'Screw_lock' => 'required',
            'lubrication_maintenance' => 'required',
            'Abnormality_log' => 'required',
            'Annual' => 'required|integer',
            'MachineRepair_status' => 'required',
            'Remark' => 'required',
            'Create_time' => 'required',
            'Create_Id' => 'required',
        ]);

        MachineRepair::create($request->all());


$serverName = "163.17.9.113\SQLEXPRESS";
$connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if($_POST['MachineRepair_status'] == 0) {
    $sql = "UPDATE DB_Machine set Status=1 WHERE Machine_id=".$_POST['Machine_id'];
    $query = sqlsrv_query($conn, $sql);
}else{
    $sql = "UPDATE DB_Machine set Status=9 WHERE Machine_id=".$_POST['Machine_id'];
    $query = sqlsrv_query($conn, $sql);
}
        return redirect()->route('MachineRepair.index')
            ->with('success','新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bbb =MachineRepair::find($id);
        return view('MachineRepair.show',compact('bbb'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bbb= MachineRepair::find($id);
        return view('MachineRepair.edit',compact('bbb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            //'Repair_id' => 'required',
            'Machine_id'=>'required',
            'Repair_No' => 'required',
            //'Service_date' => 'required',
            'Maintain' => 'required',
            'Degree_scale' => 'required',
            'Zeroing_calibration' => 'required',
            'Screw_lock' => 'required',
            'lubrication_maintenance' => 'required',
            'Abnormality_log' => 'required',
            'Annual' => 'required',
            //'MachineRepair_status' => 'required',
            'Remark' => 'required',
//            'Create_time' => 'required',
//            'Create_Id' => 'required',

        ]);

        MachineRepair::find($id)->update($request->all());
        return redirect()->route('MachineRepair.index')
            ->with('success','更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MachineRepair::find($id)->delete();
        return redirect()->route('MachineRepair.index')
            ->with('success','刪除成功');
    }
}
