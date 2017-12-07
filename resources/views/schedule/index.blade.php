@extends('layouts.default')
@section('content')

    <style>
        table#sc_tb tr:nth-child(even) {
            background-color: #eee;
        }
        table#sc_tb tr:nth-child(odd) {
            background-color:#fff;
        }
        table#sc_tb th {
            background-color: #4F4F4F;
            /*color: white;*/}
        a:link
        {
            color: #ffffff;
        }
        a:visited {
            color: #ffffff;
        }
    </style>
    {{--JavaScript--}}
    <SCRIPT LANGUAGE="JavaScript">

        var checkflag = "false";
        function check(fieldName)
        {
            var field=document.getElementsByName(fieldName);
            if (checkflag == "false")
            {
                for (i = 0; i < field.length; i++)
                {
                    field[i].checked = true;
                }
                checkflag = "true"; return "Uncheck All";
            } else {
                for (i = 0; i < field.length; i++) {
                    field[i].checked = false;
                } checkflag = "false"; return "Check All"; } }

    </script>
    {{--JavaScript--}}

    <div class="row">
    <div class="col-md-12">
      
        <h1><a href="{{ route('schedule.index') }}"> <font color="gray">排程管理</font></a></h1>
<hr>

    </div>
    </div>



    {{--這是搜尋--}}
    <div class="col-md-12">
        <div class="input-group custom-search-form">
            {!! Form::open(['method'=>'GET','url'=>'schedule','class'=>'navbar-form navbar-left','role'=>'search']) !!}
            <input type="date" id="bookdate_1" name="bookdate_1" class="form-control">
            <label class="form-control" >~</label>
            <input type="date" id="bookdate_2" name="bookdate_2" class="form-control">
            <label class="form-control" >-</label>
            <select name="tag_sch" id="tag_sch" class="form-control">
                <option  value="Test_result_status">校驗結果</option>
                <option  value="Correction_company">校正廠商</option>
                <option  value="Applicant">申請者</option>
                <option  value="Version">版次</option>
            </select>
            <input type="text" name="search_sch_1" class="form-control"  size="15" >

            <input type="text" name="search_sch_2" class="form-control"  size="15" placeholder="校正廠商">
            <button type="submit" class="form-control"><span class="glyphicon glyphicon-search"></span></button>
        </div>
        {!! Form::close() !!}
    </div><br><br><br>
    {{--這是搜尋--}}




        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless" id="sc_tb" name="sc_tb">
                <tr>
                    <th width="30"><CENTER><font color="#f0f8ff">@sortablelink('Schedule_id','No')</font></CENTER></th>
                    {{--<th width="60"><CENTER><font color="#f0f8ff">@sortablelink('Machine_list_id','機器選單編號')</font></CENTER></th>--}}
                    <th width="50"><a href="schedule"><CENTER><font color="#f0f8ff">@sortablelink('Schedule_id','機器名稱')</font></CENTER></a></th>
                    <th width="50"><CENTER><font color="#f0f8ff">@sortablelink('Correction_company','機器廠商')</font></CENTER></th>
                    <th width="50"><CENTER><font color="#f0f8ff">@sortablelink('Next_calibration_date','下次校驗日期')</font></CENTER></th>
                    <th width="50"><CENTER><font color="#f0f8ff">@sortablelink('Test_result_status','校驗狀態')</font></CENTER></th>
                    <th width="100"><CENTER><font color="#f0f8ff">編 輯</font></CENTER></th>
                </tr>
                {{ csrf_field() }}
                @foreach($schedules as $key=>$schedule)
                    <tr>
                        <td><CENTER>{{$schedule->Schedule_id}}</CENTER></td>
                        <td><CENTER><?php
                                $serverName = "163.17.9.113";
                                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                                $sql_find_m="select*from DB_Machinelist where Machine_list_id=".$schedule->Machine_list_id;
                                $result=sqlsrv_query($conn,$sql_find_m)or die("sql error".sqlsrv_errors());
                                $array_find_m[]=0;
                                while($row=sqlsrv_fetch_array($result)){
                                    $array_find_m[0]=$row[2];       //依 DB_Machinelist 資料表取得 Machine_id
                                }
                                $sql_find_mach="select*from DB_Machine where Machine_id=".$array_find_m[0];
                                $result=sqlsrv_query($conn,$sql_find_mach)or die("sql error".sqlsrv_errors());
                                $array_find_mach[]=0;
                                while($row=sqlsrv_fetch_array($result)){
                                    $array_find_mach[0]=$row[3];       //依 DB_Machine 資料表取得 Machine_name
                                }echo $array_find_mach[0]; ?></CENTER></td>

                        <td><CENTER><?php if($schedule->Correction_company==null){
                            echo "<font color='gray'>無紀錄</font>";
                                }else{
                            echo $schedule->Correction_company;
                                } ?></CENTER></td>
                        <td><CENTER>{{date('Y-m-d',strtotime($schedule->Next_calibration_date))}}</CENTER></td>
                        <td><CENTER><?php if($schedule->Test_result_status==0){
                                   echo "未處理";
                        }elseif ($schedule->Test_result_status==1){
                                   echo "正常";
                        }elseif ($schedule->Test_result_status==2){
                                   echo "校正中";
                        }else{
                                   echo "異常";
                        }?></CENTER></td>
                        <td>
                            <CENTER>
                            <?php if($schedule->Test_result_status==0){ ?>
                            <a class="btn btn-warning" href="{{ route('schedule.edit',$schedule->Schedule_id)}}"><span class="glyphicon glyphicon-check" >送校確認</span> </a>
                            <?php }elseif($schedule->Test_result_status==2){?>
                            <a class="btn btn-primary" href="{{ route('schedule.edit',$schedule->Schedule_id)}}"><span class="glyphicon glyphicon-list-alt" >校驗結果</span> </a>
                            <?php } else{ ?>
                                <a class="btn btn-success" href="{{ route('schedule.show',$schedule->Schedule_id) }}"><span class="glyphicon glyphicon-flag" > 完成</span></a><?php } ?>
                            </CENTER>
                        </td>
                    </tr>
                @endforeach
            </table>
            <CENTER> {!! $schedules->render() !!}</CENTER>
        </div>
    </div>
@stop