<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Minor_function_list;

class Minor_function_listController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */

    public function index(Request $request)
    {

        $find_main_id = \Request::get('find_main_id');
        $search = \Request::get('search');
//        $minors=Minor_function_list::where('Main_function_id','like',$find_main_id)->orderBy('Main_function_id','DESC')->paginate(5);
        $minors=Minor_function_list::where('Main_function_id','like',$find_main_id)->sortable()->paginate(10);
        return view('Minor_function_list.index',compact('minors'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**f
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Minor_function_list.create');

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


            'Minor_function_No' => 'required|unique:DB_Minor_function_list',
            'Minor_function_name' => 'required|unique:DB_Minor_function_list',
            'Main_function_id' => 'required',
            'Create_id' => 'required',
            'Create_time' => 'required',
//           'Description' => 'required',
            'Status' => 'required',
            'Minor_function_program' =>'required',
        ]);
//        $d='Create_time';
//        $d->toDateString();
        Minor_function_list::create($request->all());
        return redirect()->route('Minor_function_list.index','find_main_id='.$_POST['find_main_id'])
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
        $minors =Minor_function_list::find($id);
        return view('Minor_function_list.show',compact('minors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $minors= Minor_function_list::find($id);
        return view('Minor_function_list.edit',compact('minors'));
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
        $serverName = "calibration.database.windows.net";
        $connectionInfo = array( "Database"=>"calibration", "UID"=>"en", "PWD"=>"@sS10314161", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $sql="select * from DB_Minor_function_list where Minor_function_id=".$id;
        $del_chk[]=0;
        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $del_chk[0]=$row[0];
            $del_chk[3]=$row[3];
        }
        $this->validate($request, [
//
            'Minor_function_No' => 'required',
            'Minor_function_name' => 'required',
            'Main_function_id' => 'required',
//            'Create_id' => 'required',
            'Create_time' => 'required',
//            'Description' => 'required',
            'Status' => 'required',
            'Minor_function_program' =>'required',
        ]);



        Minor_function_list::find($id)->update($request->all());
        return redirect()->route('Minor_function_list.index','find_main_id='.$del_chk[3])
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
        $sql="select Main_function_id from DB_Minor_function_list where Minor_function_id=".$id;
        $del_chk[]=0;
        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $del_chk[0]=$row[0];
        }

            Minor_function_list::find($id)->delete();
            return redirect()->route('Minor_function_list.index','find_main_id='.$del_chk[0])
                ->with('success','刪除成功');
    }
}
