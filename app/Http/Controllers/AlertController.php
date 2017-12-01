<?php

namespace App\Http\Controllers;

use App\machine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Alert;

class AlertController extends BaseController
{

    public function index(Request $request)
    {
//        $sort = \Request::get('sort','Schedule_id');
//        $search_sch = \Request::get('search_sch');
        $bookdate_3 = \Request::get('bookdate_3');
        $bookdate_4 = \Request::get('bookdate_4');
        $sort = \Request::get('sort','Machine_list_id');
        $search_sch_3 = \Request::get('search_sch_3');
        $search_sch_4 = \Request::get('search_sch_4');
        $tag_sch1= \Request::get('tag_sch1','Machine_list_id');
//        $alert_search= \Request::get('alert_search', 'Test_result_status');
//        $alerts= Alert::where($alert_search, 'like', '%' .$search. '%')->sortable()->paginate(10);

        if(($search_sch_4 !=null) and ($bookdate_3!=null or $bookdate_4!=null) and ($search_sch_3 !=null)){
            $alerts= Alert::whereBetween('Next_calibration_date',[$bookdate_3,$bookdate_4])
                ->Where($tag_sch1,'like', '%' .$search_sch_3
                    . '%')
                ->Where('Machine_list_id','like', '%' .$search_sch_4 . '%')
                ->sortable($sort,"DESC")
//                ->orderBy($sort,"DESC")
                ->paginate(10);
        }elseif(($search_sch_3 !=null) and ($bookdate_3!=null or $bookdate_4!=null)){
            $alerts= Alert::whereBetween('Next_calibration_date',[$bookdate_3,$bookdate_4])
                ->Where($tag_sch1,'like', '%' .$search_sch_3 . '%')
                ->sortable($sort,"DESC")
//                ->orderBy($sort,"DESC")
                ->paginate(10);

        }elseif(($search_sch_4 !=null) and ($bookdate_3!=null or $bookdate_4!=null)){
            $alerts= Alert::whereBetween('Next_calibration_date',[$bookdate_3,$bookdate_4])
                ->Where('Machine_list_id','like', '%' .$search_sch_4 . '%')
//                ->orderBy($sort,"DESC")
                ->sortable($sort,"DESC")
                ->paginate(10);
        }elseif($search_sch_4 !=null){
            $alerts= Alert::where($tag_sch1,'like', '%' .$search_sch_3 . '%')
                ->Where('Machine_list_id','like', '%' .$search_sch_4 . '%')
//                ->orderBy($sort,"DESC")
                ->sortable($sort,"DESC")
                ->paginate(10);
        }elseif($bookdate_3!=null and $bookdate_4!=null){
            $alerts= Alert::whereBetween('Next_calibration_date',[$bookdate_3,$bookdate_4])
//                ->orderBy($sort,"DESC")
                ->sortable($sort,"DESC")
                ->paginate(10);
        }else {
            $alerts= Alert::where($tag_sch1,'like', '%' .$search_sch_3 . '%')
//                ->orderBy($sort,"DESC")
                ->sortable($sort,"DESC")
                ->paginate(10);
        }


        return view('alert.index', compact('alerts'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }


























    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
