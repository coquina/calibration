<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\VersionChange;

class VersionChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */

    public function index(Request $request)
    {

        $v_no = \Request::get('history_no');
        $search = \Request::get('search');
//        $versionchange=VersionChange::where('Standard_no','like','%'.$v_no.'%')->orderBy('Standard_id','DESC')->paginate(5);

        $versionchange=VersionChange::where('Standard_no','like','%' .$v_no. '%')->sortable()->paginate(10);

        return view('VersionChange.index',compact('versionchange'))
            ->with('i', ($request->input('page', 1) - 1) * 5);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { return view('VersionChange.create');

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
            'Standard_no' => 'required',
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
        VersionChange::create($request->all());
        return redirect()->route('VersionChange.index')
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
        $versionchange =VersionChange::find($Standard_id);
        return view('VersionChange.show',compact('versionchange'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Standard_id)
    {
        $versionchange= VersionChange::find($Standard_id);
        return view('VersionChange.edit',compact('ms'));
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

        VersionChange::find($Standard_id)->update($request->all());
        return redirect()->route('VersionChange.index')
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
        VersionChange::find($Standard_id)->delete();
        return redirect()->route('VersionChange.index')
            ->with('success','刪除成功');
    }
}
