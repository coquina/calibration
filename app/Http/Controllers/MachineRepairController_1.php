<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\machine;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
    class MachineRepairController_1 extends Controller
{

    public function index(Request $request){

        $machines_name =\Request::get('search');

        $machines=machine::where('Machine_name','like','%'.$machines_name.'%')->where('Status','like','%'.'0'.'%')/*->where('MachineRepair_status','=','1')*/->sortable('Machine_id','DESC')->paginate(10);


        return view('MachineRepair_1.index',compact('machines'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $machines = machine::pluck('id', 'Machine_id');
        return view('MachineRepair_1.create',compact('machines'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Machine_name' => 'required',
            'Purchase_date' => 'required',
            'Status' => 'required',
            'Machine_prices' => 'required',
            'Service_life' => 'required',
            'Instrument_sort' => 'required',
            'Purchasing_department' => 'required',
            'Manfaucturer' => 'required',
            'Model' => 'required',
            'id' => 'required'
        ]);
        machine::create($request->all());
        return redirect()->route('machine.index')
            ->with('success','新增成功');
    }

    public function show($id)
    {
        $machines =machine::find($id);
        return view('MachineRepair_1.show',compact('machines'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $machines= machine::find($id);
        return view('MachineRepair_1.edit',compact('machines'));
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

            'Machine_name' => 'required',
            'Purchase_date' => 'required',
            'Status' => 'required',
            'Machine_prices' => 'required',
            'Service_life' => 'required',
            'Instrument_sort' => 'required',
            'Purchasing_department' => 'required',
            'Manfaucturer' => 'required',
            'Model' => 'required',
            'id' => 'required'
        ]);

        machine::find($id)->update($request->all());
        return redirect()->route('MachineRepair_1.index')
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
        $serverName = "calibration.database.windows.net";
        $connectionInfo = array( "Database"=>"calibration", "UID"=>"en", "PWD"=>"@sS10314161", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $sql="select*from DB_Machinelist where Machine_id=".$id;
        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
        $array[]=0;
        while($row=sqlsrv_fetch_array($result)) {
            $array[0]=$row[0];
        }if($array[0]!=null){
        return redirect()->route('MachineRepair_1.index')
            ->with('success','已進入排程 無法刪除!');
    }else{
        machine::find($id)->delete();
        return redirect()->route('MachineRepair_1.index')
            ->with('success','刪除成功');
    }
    }
}

