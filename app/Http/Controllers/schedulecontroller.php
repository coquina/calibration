<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2017/6/9
 * Time: 下午 02:40
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\schedule;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class schedulecontroller extends Controller
{
    public function index(Request $request)
    {
        $bookdate_1 = \Request::get('bookdate_1');
        $bookdate_2 = \Request::get('bookdate_2');
        $sort = \Request::get('sort','Test_result_status');
        $search_sch_1 = \Request::get('search_sch_1');
        $search_sch_2 = \Request::get('search_sch_2');

        $chk = \Request::get('chk');
        $tag_sch= \Request::get('tag_sch','Test_result_status');
        if($chk!=null){
            $search_sch_1=$chk;
        }
        if(($search_sch_2!=null) and ($bookdate_1!=null or $bookdate_2!=null) and ($search_sch_1!=null)){
            $schedules= schedule::whereBetween('Next_calibration_date',[$bookdate_1,$bookdate_2])
                ->Where($tag_sch,'like', '%' .$search_sch_1. '%')
                ->Where('Correction_company','like', '%' .$search_sch_2. '%')
                ->sortable($sort,"DESC")
                ->paginate(10);
        }elseif(($search_sch_1!=null) and ($bookdate_1!=null or $bookdate_2!=null)){
            $schedules= schedule::whereBetween('Next_calibration_date',[$bookdate_1,$bookdate_2])
                ->Where($tag_sch,'like', '%' .$search_sch_1. '%')
                ->sortable($sort,"DESC")
                ->paginate(10);

        }elseif(($search_sch_2!=null) and ($bookdate_1!=null or $bookdate_2!=null)){
            $schedules= schedule::whereBetween('Next_calibration_date',[$bookdate_1,$bookdate_2])
                ->Where('Correction_company','like', '%' .$search_sch_2 . '%')
                ->sortable($sort,"DESC")
                ->paginate(10);
        }elseif($search_sch_2!=null){
            $schedules= schedule::where($tag_sch,'like', '%' .$search_sch_1. '%')
                ->Where('Correction_company','like', '%' .$search_sch_2 . '%')
                ->sortable($sort,"DESC")
                ->paginate(10);
        }elseif($bookdate_1!=null and $bookdate_2!=null){
            $schedules= schedule::whereBetween('Next_calibration_date',[$bookdate_1,$bookdate_2])
                ->sortable($sort,"DESC")
                ->paginate(10);
        }else {
                $schedules= schedule::where($tag_sch,'like', '%' .$search_sch_1. '%')
                    ->sortable($sort,"DESC")
                    ->paginate(10);
            }
        return view('schedule.index', compact('schedules'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function show($id)
    {
        $schedules =schedule::find($id);
        return view('schedule.show',compact('schedules'));
    }

    public function edit($id)
    {
        $schedules= schedule::find($id);
        return view('schedule.edit',compact('schedules'));
    }


    public function update(Request $request, $id)
    {
        $chk=schedule::find($id);
        if($chk->Test_result_status==0){
            $this->validate($request, [
                'Correction_company' => 'required',
                'Received_Date' => 'required',
            ]);
            schedule::find($id)->update($request->all());

            return redirect()->route('schedule.index')
                ->with('success','更新成功')

                ;
        }else {
            $this->validate($request, [
//                'Suggested_date' => 'required',
                'Test_result_status' => 'required',
                'TestResult_raw_file' => 'required',
                'Applicant' => 'required',
                'Correction_company' => 'required',
                'Model' => 'required',
                'Serial_Number' => 'required',
                'Procedure_Used' => 'required',
                'Received_Date' => 'required',
                'Temperature' => 'required',
                'Relative_Humidity' => 'required',
                'Consumer_Address' => 'required',
                'Location' => 'required',
                'Traceability' => 'required',
                'Report_No' => 'required',
                'Due_Date' => 'required',
            ]);

            schedule::find($id)->update($request->all());
            return redirect()->route('result.create',$request->TestResult_raw_file->store('public/abc'))
                ->with('success','更新成功');
        }


    }

    public function destroy($id)
    {
        schedule::find($id)->delete();
        return redirect()->route('schedule.index')
            ->with('success','刪除成功');
    }
}