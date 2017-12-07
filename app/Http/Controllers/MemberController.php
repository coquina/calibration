<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Response;
use App\Member;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    use RegistersUsers;
//    protected $redirectTo = '/home';




    public function index(Request $request)
    {
        $search = \Request::get('search');
        $search_t=\Request::get('search_t','Account_number');
//        $sort=\Request::get('sort','Account_number');
//        $ms=Member::where($search_t,'like','%' .$search. '%')->orderBy('id','DESC')->paginate(5);
        $ms=Member::where($search_t,'like','%' .$search. '%')->sortable()->paginate(5);
//
//        $ms=Member::sortable()->paginate(5);
        return view('member.index',compact('ms'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.create');

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
            'Account_number' => 'required|unique:DB_Member,Account_number',
            'password' => 'required|min:6',
            'Member_name' => 'required',
            'email' => 'required|email',
            'Job_title' => 'required',
            'Member_phone' => 'required',
            'Cell_phone' => 'required',
            'Member_address' => 'required'
        ]);
        Member::create([
            'Account_number' => $request['Account_number'],
            'email' => $request['email'],
            'Member_name' => $request['Member_name'],
            'Job_title' => $request['Job_title'],
            'Member_phone' => $request['Member_phone'],
            'Cell_phone' => $request['Cell_phone'],
            'Member_address' => $request['Member_address'],
            'password' => password_hash($request['password'],PASSWORD_BCRYPT),
        ]);
//        Member::create($request->all());
        return redirect()->route('member.index')
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
        $ms =Member::find($id);
        return view('member.show',compact('ms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ms= Member::find($id);
        return view('member.edit',compact('ms'));
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
//        use Illuminate\Support\Facades\Hash;
//        $validation = Validator::make(Request::all(), [
//
//            // Here's how our new validation rule is used.
//            'password' => 'hash:' . $user->password,
//            'new_password' => 'required|different:password|confirmed'
//        ]);
        $this->validate($request, [
            'Account_number' => 'required',
//            'password' => 'required',
            'Member_name' => 'required',
            'email' => 'required',
            'Job_title' => 'required',
            'Member_phone' => 'required',
            'Cell_phone' => 'required',
            'Member_address' => 'required',
        ]);

        Member::find($id)->update([
            'Account_number' => $request['Account_number'],
            'email' => $request['email'],
            'Member_name' => $request['Member_name'],
            'Job_title' => $request['Job_title'],
            'Member_phone' => $request['Member_phone'],
            'Cell_phone' => $request['Cell_phone'],
            'Member_address' => $request['Member_address'],
            'password'=> password_hash($request->get('password'),PASSWORD_BCRYPT),
//            'password'=>pass,
//            'password' => bcrypt($request->get('password')),
        ]);
//        Auth::user()->update(['password' => Hash::make($request->input('new_password'))]);

//        Member::find($id)->update($request->all());
        return redirect()->route('member.index')
            ->with('success','更新成功');

//        $validation = Validator::make(Request::all(), [
//
//            // Here's how our new validation rule is used.
//            'password' => 'hash:' . $user->password,
//            'new_password' => 'required|different:password|confirmed'
//        ]);
//
//        if ($validation->fails()) {
//            return redirect()->back()->withErrors($validation->errors());
//        }
//
//        $user->password = Hash::make(Request::input('new_password'));
//        $user->save();
//
//        return redirect()->back()
//            ->with('success-message', 'Your new password is now set!');
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
        $sql_p="select*from DB_Group_personnel where id=".$id;
        $result=sqlsrv_query($conn,$sql_p)or die("sql error".sqlsrv_errors());
        $array_p[]=0;
        while($row=sqlsrv_fetch_array($result)) {
            $array_p[0]=$row[0];                        //查看群組人員資料表有無資料
        }
        $sql_m="select*from DB_Machine where id=".$id;
        $result=sqlsrv_query($conn,$sql_m)or die("sql error".sqlsrv_errors());
        $array_m[]=0;
        while($row=sqlsrv_fetch_array($result)) {
            $array_m[0]=$row[0];                        //查看機器資料表有無資料
        }if($array_p[0]==null and $array_m[0]==null){
        Member::find($id)->delete();
        return redirect()->route('member.index')
            ->with('success','刪除成功');
    }else{

        return redirect()->route('member.index')
            ->with('success','已設定該人員 無法刪除');
    }
    }
}
