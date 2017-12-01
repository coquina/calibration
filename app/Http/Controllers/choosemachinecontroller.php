<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\choosemachine;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class choosemachinecontroller extends Controller
{
    public function index(Request $request)
    {

//        $search = \Request::get('search');
//        $tag_machine = \Request::get('tag_machine','Machine_id');
        $choosemachines=choosemachine::where("Machine_list_id",'like','%'."123".'%')->orderBy('Machine_list_id','DESC')->paginate(10);
        return view('choosemachine.index',compact('choosemachines'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
//        return view('choosemachine.index');
    }

    public function destroy($id)
    {
        choosemachine::find($id)->delete();
        return redirect()->route('choosemachine.index')
            ->with('success','刪除成功');
    }
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
