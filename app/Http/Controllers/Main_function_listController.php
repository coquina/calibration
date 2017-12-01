<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Main_function_list;

class Main_function_listController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        $m_id = \Request::get('m_id','1');

        $Main=\Request::get('Main_function_list','Status');
        $search = \Request::get('search');
        if($m_id != "1"){
            $search = $m_id;
            $Main = "Main_function_No";
        }

        $aaa=Main_function_list::where($Main,'like','%'.$search.'%')->sortable('Main_function_No','DESC')->paginate(10);
        return view('Main_function_list.index',compact('aaa'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { return view('Main_function_list.create');

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
            //'Main_function_id' => 'required',
            'Main_function_No' => 'required|unique:DB_Main_function_list',
            'Main_function_name' => 'required|unique:DB_Main_function_list',
            'Create_id' => 'required',
//            'Create_time' => 'required',
            'Description' => 'required',
            'Status' => 'required',
            'icon'=>'required',

        ]);
        Main_function_list::create($request->all());
        return redirect()->route('Main_function_list.index')
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
        $aaa =Main_function_list::find($id);
        return view('Main_function_list.show',compact('aaa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aaa= Main_function_list::find($id);
        return view('Main_function_list.edit',compact('aaa'));
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
            //'Main_function_id' => 'required',
            'Main_function_No' => 'required',
            'Main_function_name' => 'required',
            'Create_id' => 'required',
//            'Create_time' => 'required',
            'Description' => 'required',
            'Status' => 'required',
            'icon'=>'required',
        ]);

        Main_function_list::find($id)->update($request->all());
        return redirect()->route('Main_function_list.index')
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
        Main_function_list::find($id)->delete();
        return redirect()->route('Main_function_list.index')
            ->with('success','刪除成功');
    }
}
