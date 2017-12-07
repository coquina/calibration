@extends('layouts.default')
@section('content')


<style>
    table#table_alert tr:nth-child(even) {
        background-color: #eee;
    }
    table#table_alert tr:nth-child(odd) {
        background-color:#fff;
    }
    table#table_alert th {
        background-color: #4F4F4F;
        /*color: white;*/
    }
    a:link
    {
        color: #ffffff;
    }
    a:visited {
        color: #ffffff;
    }
</style>
<script>
    $(document).ready(function()
        {
            $("#machinen").tablesorter();
        }
    );
</script>

    <div class="row">
    <div class="col-md-12">
        <h1><a href="{{ route('alert.index') }}"> <font color="gray">預警管理</font></a></h1>
        <hr>
    </div>
    </div>


    {{--這是搜尋--}}
    {{--<div class="col-md-6">--}}
        {{--<div class="input-group custom-search-form">--}}
            {{--{!! Form::open(['method'=>'GET','url'=>'inspire','class'=>'navbar-form navbar-left','role'=>'search']) !!}--}}
            {{--<select name="alert_search" id="alert_search" class="form-control">--}}
                {{--<option  value="Test_result_status">校驗結果</option>--}}
                {{--<option  value="Correction_company">校正廠商</option>--}}
                {{--<option  value="Applicant">申請者</option>--}}
                {{--<option  value="Version">版次</option>--}}
            {{--</select>--}}
            {{--<input type="text" name="search_sch" class="form-control" placeholder="Search ....">--}}
            {{--<span class="input-group-btn">--}}
                            {{--<button type="submit" class="btn btn-default-sm">--}}
                                {{--<i class="fa fa-search"></i>--}}
                            {{--</button>--}}
                        {{--</span>--}}
        {{--</div>--}}
        {{--{!! Form::close() !!}--}}
    {{--</div><br><br><br>--}}
    {{--這是搜尋--}}


{{--這是搜尋--}}

<div class="col-md-10">
    <div class="input-group custom-search-form">
        {!! Form::open(['method'=>'GET','url'=>'alert','class'=>'navbar-form navbar-left','role'=>'search']) !!}
        <label class="form-control" for="bookdate"><span class="glyphicon glyphicon-calendar"></span></label>
        <input type="date" id="bookdate_3" name="bookdate_3" class="form-control">
        <label class="form-control" >~</label>
        <input   type="date" id="bookdate_4" name="bookdate_4" class="form-control" size="3">
        <label class="form-control" >-</label>
        <select name="tag_sch1" id="tag_sch1" class="form-control">
            <option  value="Machine_list_id">機器選單編號</option>
            <option  value="Correction_company">機器名稱</option>
        </select>
        <input type="text" name="search_sch_3" class="form-control"  size="5" >
        <button type="submit" class="form-control"><span class="glyphicon glyphicon-search"></span></button>
    </div>
    {!! Form::close() !!}
</div><br><br><br><br><br>
{{--這是搜尋--}}

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless" id="table_alert" name="table_alert">
                <tr>
                    {{--<th><CENTER><font color="f0f8ff">編號</font></CENTER></th>--}}
                    <th><CENTER><font color="f0f8ff">@sortablelink('Schedule_id','排程編號')</font></CENTER></th>
                    {{--@sortablelink('Machine_name','')--}}
                    <th><CENTER><font color="f0f8ff"><a href="alert?sort=Machine_name">@sortablelink('Schedule_id','機器名稱')</a></font></CENTER></th>
                    <th><CENTER><font color="f0f8ff">今日日期</font></CENTER></th>
                    <th><CENTER><font color="f0f8ff">@sortablelink('Next_calibration_date','到期日期')</font></CENTER></th>
                    <th><CENTER><font color="f0f8ff">狀態</font></CENTER></th>
                </tr>
                {{ csrf_field() }}

                @foreach($alerts as $key=>$alert)

                        {{--<td id="number"><CENTER>{{ ++$i }}</CENTER></td>--}}
                        <td><center>{{$alert->Schedule_id}}</center></td>
                        {{--<td><CENTER>{{$alert->Machine_list_id}}</CENTER></td>--}}

                        <?php

                                $serverName = "163.17.9.113";
                                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                                $sql_list="select Machine_id from DB_Machinelist where Machine_list_id=".$alert->Machine_list_id;
                                $result=sqlsrv_query($conn,$sql_list)or die("sql error".sqlsrv_errors());
                                $array_list="";
                                while($row=sqlsrv_fetch_array($result)){
                                $array_list=$row[0];
                                }
                                $sql_mach="select Machine_name from DB_Machine where Machine_id=".$array_list;
                                $result=sqlsrv_query($conn,$sql_mach)or die("sql error".sqlsrv_errors());
                                $array_mach="";$arrayalert[]=0;
                                while($row=sqlsrv_fetch_array($result)){
                                 $arrayalert[0]=$row[0];
                                }


                            ?>
                    <td id="machinen" class="tablesorter"><center>{{$arrayalert[0]}} </center></td>
                        <td><CENTER><?php
                            $mytime = Carbon\Carbon::now()->format('Y-m-d');
                            echo $mytime?>
                                </CENTER></td>
                        <td id="nextdate"><CENTER>{{date('Y-m-d',strtotime($alert->Next_calibration_date))}}</CENTER></td>
                        <td id="status"><CENTER>
                        <?php
                                if($mytime==date('Y-m-d',strtotime($alert->Next_calibration_date))){
                                    echo '<span style="color:orange;"><font size="3px"> <b>到期</b></font></span>';
                                }elseif($mytime>date('Y-m-d',strtotime($alert->Next_calibration_date))){
                                    echo'<span style="color:red;"><font size="3px"><b>過期</b></font></span>';
                                }else{
                                    echo'<span style="color:black;"><font size="3px"><b>未到</b></font></span>';
                                }
                            ?>
                            </CENTER></td>
                    </tr>

                @endforeach

            </table>
            <CENTER>{!! $alerts->render() !!}</CENTER>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{--<script type="text/javascript" src="{{ asset('js/alert.js') }}"></script>--}}
    {{--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>--}}
    {{--<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
@stop