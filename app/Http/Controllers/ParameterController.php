<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Parameter;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */

    public function index(Request $request)
    {
//        $ms=Parameter::all();
//        return view('Parameter.index',['Parameter' => $ms]);
        $search = \Request::get('search');
//        $ParameterControllers=Parameter::where('Parameter_id','like','%'.$search.'%')->orderBy('Parameter_id','DESC')->paginate(5);
        $ParameterControllers=Parameter::where('Parameter_id','like','%'.$search.'%')->sortable()->paginate(5);
        return view('Parameter.index',compact('ParameterControllers'))
            ->with('i', ($request->input('page', 1) - 1) * 5);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { return view('Parameter.create');

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
//            'Parameter_id' => 'required',
            'Parameter_name' => 'required',
            'Parameter' => 'required',
            'Create_id' => 'required',
            //'Create_time' => 'required',
            //'Description' => 'required',
            'Status' => 'required',

        ]);
        Parameter::create($request->all());
        return redirect()->route('Parameter.index')
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
        $ParameterControllers =Parameter::find($id);
        return view('Parameter.show',compact('ParameterControllers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ParameterControllers= Parameter::find($id);
        return view('Parameter.edit',compact('ParameterControllers'));
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
//            'Parameter_id' => 'required',
            'Parameter_name' => 'required',
            'Parameter' => 'required',
            'Create_id' => 'required',
//            'Create_time' => 'required',
            'Description' => 'required',
            'Status' => 'required',
        ]);

        Parameter::find($id)->update($request->all());
        return redirect()->route('Parameter.index')
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
        Parameter::find($id)->delete();
        return redirect()->route('Parameter.index')
            ->with('success','刪除成功');
    }
}
