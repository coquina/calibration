<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Group;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */

    public function index(Request $request)
    {

        $search = \Request::get('search');
        $g = \Request::get('tag_group','Group_id');
        $sort_1 = \Request::get('sort','Group_id');

//        $gr=Group::where($g,'like','%'.$search.'%')->orderBy($sort_1,'DESC')->paginate(10);


        if ($g=="Status") {

            if ($search=="未啟用"){
                $p=0;
                $gr = Group::where($g, 'like', '%' . $p . '%')->sortable()->paginate(10);
            }else{
                if($search=="啟用"){
                    $p=1;
                    $gr = Group::where($g, 'like', '%' . $p . '%')->sortable()->paginate(10);
                }else{
                    $gr = Group::where($g, 'like', '%' . $search . '%')->sortable()->paginate(10);
                }
            }

        }else{
            $gr = Group::where($g, 'like', '%' . $search . '%')->sortable()->paginate(10);
        }


        return view('Group.index',compact('gr'))
            ->with('i', ($request->input('page', 1) - 1) * 5);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Group.create');
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
            //'Group_id' => 'required',
            'Group_No' => 'required|unique:DB_Group',
            'Group_name' => 'required|unique:DB_Group',
            'Create_id' => 'required',
            'Create_time' => 'required',
            'Description' => 'required',
            'Status' => 'required',
        ]);

        Group::create($request->all());
        return redirect()->route('Group.index')
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
        $gr =Group::find($id);
        return view('Group.show',compact('gr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gr= Group::find($id);
        return view('Group.edit',compact('gr'));
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
            //'Group_id' => 'required',
            'Group_No' => 'required',
            'Group_name' => 'required',
            //'Create_id' => 'required',
            //'Create_time' => 'required',
            'Description' => 'required',
            'Status' => 'required',
        ]);

        Group::find($id)->update($request->all());
        return redirect()->route('Group.index')
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
        $sql="select * from DB_Group_personnel where Group_id=".$id;
        $del_chk[]=0;
        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
        while($row=sqlsrv_fetch_array($result)) {
            $del_chk[1] = $row[1];
            if ($del_chk[1] != null) {
                return redirect()->route('Group.index')
                    ->with('success', '已加入人員 無法刪除');
            }
        }
            Group::find($id)->delete();
            return redirect()->route('Group.index')
                ->with('success', '刪除成功');
    }
}
