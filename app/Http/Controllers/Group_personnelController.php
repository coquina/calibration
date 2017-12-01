<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Group_personnel;

class Group_personnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */

    public function index(Request $request)
    {

        $search = \Request::get('search',$_GET['g_id']);
        $p = \Request::get('tag_group_personnel','Group_id');
//      $pe=Group_personnel::where($p,'like','%'.$_GET['g_id'].'%')->orderBy('Group_personnel_id','DESC')->paginate(10);
        $pe=Group_personnel::where($p,'like','%'.$search.'%')->sortable()->paginate(10);

        return view('Group_personnel.index',compact('pe'))
            ->with('i', ($request->input('page', 1) - 1) * 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { return view('Group_personnel.create');

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
            //'Group_personnel_id' => 'required',
            'Group_id' => 'required',
            'id' => 'required|',
            //'Create_id' => 'required',
            'Create_time' => 'required',

        ]);
        Group_personnel::create($request->all());
        return redirect()->route('Group_personnel.index','g_id='.$_POST['g_id'])
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
        $pe =Group_personnel::find($id);
        return view('Group_personnel.show',compact('pe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pe= Group_personnel::find($id);
        return view('Group_personnel.edit',compact('pe'));
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

            'Group_personnel_id' => 'required',
            'Group_id' => 'required',
            'id' => 'required',
           // 'Create_id' => 'required',
            'Create_time' => 'required',
        ]);

        Group_personnel::find($id)->update($request->all());
        return redirect()->route('Group_personnel.index','g_id='.$_POST['g_id'])
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
        $serverName = "163.17.9.113\SQLEXPRESS";
        $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $sql="select Group_id from DB_Group_personnel where Group_personnel_id=".$id;
        $del_chk[]=0;
        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)){
            $del_chk[0]=$row[0];
        }

        Group_personnel::find($id)->delete();
        return redirect()->route('Group_personnel.index','g_id='.$del_chk[0])
            ->with('success','刪除成功');
    }
}
