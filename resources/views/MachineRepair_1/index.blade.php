@extends('layouts.default')
@section('content')

    <style>
        table#machine_tb tr:nth-child(even) {
            background-color: #eee;
        }
        table#machine_tb tr:nth-child(odd) {
            background-color:#fff;
        }
        table#machine_tb th {
            background-color: #4F4F4F;
            color: WHITE;
        }
        a:link
        {
            color: #ffffff;
        }
        a:visited{
            color: #ffffff;
        }
    </style>
    <?php
    use Illuminate\Support\Facades\Auth;
    $serverName = "calibration.database.windows.net";
    $connectionInfo = array( "Database"=>"calibration", "UID"=>"en", "PWD"=>"@sS10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    ?>
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
        <h1><a href="{{ route('MachineRepair.index') }}"><font color="gray">維修管理</font></a></h1>
        <hr>
    </div>
    </div>

    <div class="col-md-12">
        <div class="input-group custom-search-form">
            {!! Form::open(['method'=>'GET','url'=>'MachineRepair_1','class'=>'navbar-form navbar-left','role'=>'search']) !!}

            <select name="MachineRepair" id="MachineRepair" class="form-control">
                <option  value="Machine_name">機器名稱</option>
            </select>

            <input type="text" name="search" class="form-control" placeholder="Search ....">
            <span class="input-group-btn">
                            <button type="submit" class="btn btn-default-sm">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
        </div>
        {!! Form::close() !!}
    </div>
    {{--這是搜尋--}}


<br><br><br><br>

    {{--Button--}}
    <div class="form-group row add">

    </div>
    {{--Button--}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless" id="machine_tb" name="machine_tb">
                <tr>
                    {!! Form::open(['method'=>'GET','url'=>'machine','class'=>'navbar-form navbar-left','role'=>'sort']) !!}

                    {{--<th width="50"><a href="machine?sort=Machine_id"><CENTER><font color="#f0f8ff">No.</font></CENTER></a></th>--}}

                    {{--<th width="50"><a href="machine?sort=Machine_No"><CENTER><font color="#f0f8ff">機器編號</font></CENTER></a></th>--}}
                    {{--<th width="50"><a href="machine?sort=Machine_name"><CENTER><font color="#f0f8ff">機器名稱</font></CENTER></a></th>--}}

                    {{--<th width="10"><a href="machine?sort=Status"><CENTER><font color="#f0f8ff">狀態</font></CENTER></a></th>--}}

                    {{--<th width="100"><CENTER><font color="#f0f8ff">編 輯</font></CENTER></th>--}}
                    <th width="50"><CENTER><font color="#f0f8ff">No.</font></CENTER></th>

                    <th width="50"><CENTER><font color="#f0f8ff">@sortablelink('Machine_No','機器編號')</font></CENTER></th>
                    <th width="50"><CENTER><font color="#f0f8ff">@sortablelink('Machine_name','機器名稱')</font></CENTER></th>

                    <th width="10"><CENTER><font color="#f0f8ff">@sortablelink('Status','狀態')</font></CENTER></a></th>

                    <th width="100"><CENTER><font color="#f0f8ff">功能</font></CENTER></th>

                    {!! Form::close() !!}
                </tr>
                {{ csrf_field() }}
                @foreach($machines as $key=>$machine)
                    <tr>

                        <td><CENTER>{{$machine->Machine_id}}<CENTER></td>
                        <?php
                        $n=$machine->id;
                        $sql="select*from DB_Member where id='".$n."'";
                        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                        $x=0;	$array[]=0;
                        while($row=sqlsrv_fetch_array($result)){
                            $array[$x]=$row[3];
                            }
                            ?>

                        <td><CENTER>{{$machine->Machine_No}}</CENTER></td>
                        <td><CENTER>{{$machine->Machine_name}}</CENTER></td>

                        <td><CENTER><?php if($machine->Status==1){
                            echo "正常";
                            }elseif($machine->Status==0){
                            echo "維修";
                            }else{
                                echo "報廢";
                            }?></td></CENTER>

                        <td>
                            <CENTER>

                                <a  href="MachineRepair?m_id=<?php echo $machine->Machine_id;?>"title="歷史紀錄"><span class="glyphicon glyphicon-wrench"style="color:#337ab7"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a  href="{{ route('machine.show',$machine->Machine_id) }}"title="顯示"><span class="glyphicon glyphicon-list-alt"style="color:#337ab7"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{--<a  href="{{ route('machine.edit',$machine->Machine_id) }}"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;--}}
                                {{--{!! Form::open(['method' => 'DELETE','route' => ['machine.destroy', $machine->Machine_id],'style'=>'display:inline']) !!}--}}
                                {{--<button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button>--}}
                                {{--{!! Form::close() !!}--}}
                                <a  href="MachineRepair/create?m_id=<?php echo $machine->Machine_name;?>"title="新增"><span class="glyphicon glyphicon-ok"style="color:#337ab7"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                            </CENTER>
                      </td>
                    </tr>
                @endforeach
            </table>
            <CENTER>{!! $machines->render() !!}</CENTER>
        </div>
    </div>
@stop