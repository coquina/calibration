<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Standard;

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */

    public function index(Request $request)
    {

        $search = \Request::get('search');
        $Standard=\Request::get('Standard','Standard_no');
//        $standard=Standard::where($Standard,'like','%'.$search.'%')->orderBy('Standard_id','DESC')->paginate(5);

        $standard=Standard::where($Standard,'like','%' .$search. '%')->sortable("DESC")->paginate(10);

        return view('Standard.index',compact('standard'))
            ->with('i', ($request->input('page', 1) - 1) * 5);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { return view('Standard.create');

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
//            'Standard_id' => 'required',
            'Standard_no' => 'required|unique:DB_Standard',
            'Standard_name' => 'required',
            'Create_id' => 'required',
            'Create_time' => 'required',
            'File_norm' => 'required',
            'File_norm_code' => 'required',
            'Cycle_R' => 'required',
            'S_Department' => 'required',
            'Issuse_Department' => 'required',
            'Citation' => 'required',
            'Version' => 'required',
            'Standard_Status' => 'required'
        ]);
        Standard::create($request->all());
        return redirect()->route('Standard.index')
            ->with('success','新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Standard_id)
    {
        $standard =Standard::find($Standard_id);
        return view('Standard.show',compact('standard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Standard_id)
    {
        $standard= Standard::find($Standard_id);
        return view('Standard.edit',compact('standard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Standard_id)
    {
        $this->validate($request, [
//            'Standard_id' => 'required',
            'Standard_no' => 'required',
            'Standard_name' => 'required',
//            'Create_id' => 'required',
            'Create_time' => 'required',
            'File_norm' => 'required',
            'File_norm_code' => 'required',
            'Cycle_R' => 'required',
            'S_Department' => 'required',
            'Issuse_Department' => 'required',
            'Citation' => 'required',
            'Version' => 'required',
            'Standard_Status' => 'required'
        ]);

        Standard::find($Standard_id)->update($request->all());
        return redirect()->route('Standard.index')
            ->with('success','更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Standard_id)
    {
        $serverName = "163.17.9.113";
        $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $sql="select Standard_id from DB_Standard where Standard_id=".$Standard_id;
        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            if($row[0]!=null){
                return redirect()->route('Standard.index')
                    ->with('success','已進入排程 無法刪除');
            }else{
                Standard::find($Standard_id)->delete();
                return redirect()->route('Standard.index')
                    ->with('success','刪除成功');
            }
        }
    }
}
