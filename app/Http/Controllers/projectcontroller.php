<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\project;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class projectcontroller extends Controller
{
    public function index(Request $request){
        $sort = \Request::get('sort','Project_id');
        $search = \Request::get('search');
        $tag_project = \Request::get('tag_project','Project_id');
        if($tag_project=='Standard_name'){
            $serverName = "163.17.9.113\SQLEXPRESS";
            $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            $sql="select*from DB_Standard where Standard_name='".$search."'";
            $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
            $x=0;	$array[]=0;
            while($row=sqlsrv_fetch_array($result)){
                $array[$x]=$row[0];
            }
            $search=$array[$x];
            $tag_project='Standard_id';
        }
//        $projects=project::where($tag_project,'like','%'.$search.'%')->orderBy($sort,'DESC')->paginate(10);
        $projects=project::where($tag_project,'like','%'.$search.'%')->sortable($sort,'DESC')->paginate(10);
        return view('project.index',compact('projects'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {

        return view('project.create',compact('projects'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Project_No' => 'required',
            'Standard_id' => 'required',
            'Project_name' => 'required',
            'Check_method' => 'required',
            'Cycle' => 'required',
            'Create_id' => 'required',
            'Create_time' => 'required',
        ]);
        project::create($request->all());
        return redirect()->route('project.index')
            ->with('success','新增成功');
    }

    public function show($id)
    {
        $projects =project::find($id);
        return view('project.show',compact('projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projects= project::find($id);
        return view('project.edit',compact('projects'));
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
            'Standard_id' => 'required',
            'Project_name' => 'required',
            'Check_method' => 'required',
            'Cycle' => 'required'
        ]);

        project::find($id)->update($request->all());
        return redirect()->route('project.index')
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
        $sql_p="select*from DB_Machinelist where Project_id=".$id;
        $result=sqlsrv_query($conn,$sql_p)or die("sql error".sqlsrv_errors());
        $array_p[]=0;
        while($row=sqlsrv_fetch_array($result)) {
            $array_p[0]=$row[0];                        //查看機器選單資料表有無資料
        }if( $array_p[0]!=null){
        return redirect()->route('project.index')
            ->with('success','計畫執行中 無法刪除');
    }else{
        project::find($id)->delete();
        return redirect()->route('project.index')
            ->with('success','刪除成功');
    }
    }



}
