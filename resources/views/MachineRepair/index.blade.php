@extends('layouts.default')

@section('content')

    <?php
    use App\machine;
    ?>
    <style>
        table#machine_repair_tb tr:nth-child(even) {
            background-color: #eee;
        }
        table#machine_repair_tb tr:nth-child(odd) {
            background-color:#fff;
        }
        table#machine_repair_tb th {
            background-color: #4F4F4F;
            /*color: white;*/
        }

        a:link
        {
            color: #ffffff;
        }
        a:visited{
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
            <h1><a href="{{ route('machine.index') }}"><font color="gray">維修紀錄</font></a></h1>
            <hr>
        </div>
    </div>




                {{--這是搜尋--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="input-group custom-search-form">--}}
                    {{--{!! Form::open(['method'=>'GET','url'=>'MachineRepair','class'=>'navbar-form navbar-left','role'=>'search']) !!}--}}

                        {{--<select name="MachineRepair" id="MachineRepair" class="form-control">--}}
                            {{--<option  value="Machine_id">機器流水號</option>--}}
                            {{--<option  value="Repair_No">維修單號</option>--}}
                            {{--<option  value="Service_date">維修日期</option>--}}
                            {{--<option  value="Annual">年度</option>--}}
                            {{--<option  value="MachineRepair_status">維修結果</option>--}}
                            {{--<option  value="Remark">備註</option>--}}
                            {{--<option  value="Create_time">建立日期</option>--}}
                            {{--<option  value="Create_Id">建立者</option>--}}
                        {{--</select>--}}
                        {{--<input type="text" name="search" class="form-control" placeholder="Search ....">--}}
                        {{--<span class="input-group-btn">--}}
                            {{--<button type="submit" class="btn btn-default-sm">--}}
                                {{--<i class="fa fa-search"></i>--}}
                            {{--</button>--}}
                        {{--</span>--}}
                    {{--</div>--}}
                    {{--{!! Form::close() !!}--}}
                {{--</div>--}}
    {{--<div class="form-group row add">--}}
        {{--<div class="pull-right">--}}
            {{--<a class="btn btn-success" href="{{ route('MachineRepair.create') }}"><span class="glyphicon glyphicon-plus"></span> 新增維修</a>--}}

        {{--</div>--}}
    {{--</div>--}}


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-hover"name="machine_repair_tb" id="machine_repair_tb">
        <tr>
            {{--<th  width="30"><center><font color="white">id</font></center></th>--}}
            {{--<th  width="100"><center><font color="white">機器流水號</font></center></th>--}}
            {{--<th  width="100"><center><font color="white">維修單號</font></center></th>--}}
            {{--<th  width="70"><center><font color="white">維修日期</font></center></th>--}}
            {{--<th  width="40"><center><font color="white">年度</font></center></th>--}}
            {{--<th  width="60"><center><font color="white">維修狀態</font></center></th>--}}
            {{--<th  width="70"><center><font color="white">備註</font></center></th>--}}
            {{--<th  width="70"><center><font color="white">建立日期</font></center></th>--}}
            {{--<th  width="100"><center><font color="white">建立者</font></center></th>--}}
            {{--<th  width="100"><center><font color="white">Actions</font></center></th>--}}


            <th  width="30"><center><font color="f0f8ff">id</font></center></th>
            <th  width="100"><center><font color="f0f8ff">@sortablelink('Machine_id','機器流水號')</font></center></th>
            <th  width="100"><center><font color="f0f8ff">@sortablelink('Repair_No','維修單號')</font></center></th>
            <th  width="70"><center><font color="f0f8ff">@sortablelink('Service_date','維修日期')</font></center></th>
            <th  width="40"><center><font color="f0f8ff">@sortablelink('Annual','年度')</font></center></th>
            <th  width="60"><center><font color="f0f8ff">@sortablelink('MachineRepair_status','維修結果')</font></center></th>
            <th  width="70"><center><font color="f0f8ff">@sortablelink('Remark','備註')</font></center></th>
            <th  width="70"><center><font color="f0f8ff">@sortablelink('Create_time','建立日期')</font></center></th>
            <th  width="100"><center><font color="f0f8ff">@sortablelink('Create_Id','建立者')</font></center></th>
            <th  width="100"><center><font color="f0f8ff">@sortablelink('功能')</font></center></th>
        {{--</tr>--}}
        @foreach ($bbb as $key => $Machine)

            <tr>
                <td><center>{{$Machine->Repair_id}}</center></td>
                <td><center>{{$Machine->Machine_id}}</center></td>
                <td><center>{{$Machine->Repair_No}}</center></td>
                <td><center>{{date('Y-m-d',strtotime($Machine->Service_date))}}</center></td>
                <td><center>{{$Machine->Annual}}</center></td>
                <td><center><?php if($Machine->MachineRepair_status == 1){
                    echo "報廢";
                        }elseif($Machine->MachineRepair_status==0){
                            echo "正常";
                        } ?>
                        <!--
                        $serverName = "163.17.9.113\SQLEXPRESS";
                        $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                        $conn = sqlsrv_connect( $serverName, $connectionInfo);
                        $sql="select Status from DB_Machine where Machine_id=".$Machine->Machine_id;
                        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                        while($row=sqlsrv_fetch_array($result)){
                        echo $row[0];
                        }
                        -->


                    </center></td>
                <td><center>{{$Machine->Remark}}</center></td>
                <td><center>{{date('Y-m-d',strtotime($Machine->Create_time))}}</center></td>
                <td><center><?php
                        $serverName = "163.17.9.113\SQLEXPRESS";
                        $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                        $conn = sqlsrv_connect( $serverName, $connectionInfo);
                        $sql="select Member_name from DB_Member where id=".$Machine->Create_Id;
                        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                        while($row=sqlsrv_fetch_array($result)){
                            echo $row[0];
                        }?></center></td>
                <td><center>
                    <a href="{{ route('MachineRepair.show',$Machine->Repair_id) }}"title="顯示"><span class="glyphicon glyphicon-ok"style="color:#337ab7"></span></a>
                    {{--<a  href="{{ route('MachineRepair.edit',$Machine->Repair_id) }}"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;--}}
                        {{--{!! Form::open(['method' => 'DELETE','route' => ['MachineRepair.destroy', $Machine->Repair_id],'style'=>'display:inline','title'=>'刪除']) !!}--}}
                        {{--<button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button>--}}
                        {{--{!! Form::close() !!}--}}

                        </center></td>
            </tr>
        @endforeach
    </table>

   <center> {!! $bbb->appends(['m_id'=>'2'])->render() !!}</center>

@endsection