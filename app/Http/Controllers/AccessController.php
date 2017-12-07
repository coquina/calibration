<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Access;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        $g_id = \Request::get('g_id');
        $search = \Request::get('search',$g_id);
//        $ms=Access::where('Group_id','like','%'.$search.'%')->orderBy('Access_id','DESC')->paginate(5);
        $as=Access::where('Group_id','like','%'.$search.'%')->sortable("DESC")->paginate(10);
        return view('Access.index',compact('as'))
            ->with('i', ($request->input('page', 1) - 1) * 5);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { return view('Access.create');

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

           // 'Access_id' => 'required',
            'Group_id' => 'required',
            'Minor_function_id' => 'required|unique:DB_Access,Minor_function_id',
//            'Create_id' => 'required',
            'Create_time' => 'required',

        ]);
//        $d='Create_time';
//        $d->toDateString();
        Access::create($request->all());
        return redirect()->route('Access.index', 'g_id='.$_POST['g_id'])
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
        $as =Access::find($id);
        return view('Access.show',compact('as'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $as= Access::find($id);
        return view('Access.edit',compact('as'));

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
        $sql="select * from DB_Access where Access_id=".$id;
        $del_chk[]=0;
        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){

            $del_chk[0]=$row[0];
            $del_chk[1]=$row[1];
        }
        $this->validate($request, [
            //'Access_id' => 'required',
//            'Group_id' => 'required',
//            'Minor_function_id' => 'required',
////            'Create_id' => 'required',
//            'Create_time' => 'required',

        ]);

        Access::find($id)->update($request->all());

        return redirect()->route('Access.index','g_id='.$del_chk[1])
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
        $sql="select * from DB_Access where Access_id=".$id;
        $del_chk[]=0;
        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){

            $del_chk[0]=$row[0];
            $del_chk[1]=$row[1];
        }

        Access::find($id)->delete();

        return redirect()->route('Access.index','g_id='.$del_chk[1])
            ->with('success','刪除成功');
    }

}
