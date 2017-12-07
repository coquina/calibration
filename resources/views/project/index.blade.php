@extends('layouts.default')
@section('content')
    <?php
    use Illuminate\Support\Facades\Auth;
    $serverName = "calibration.database.windows.net";
    $connectionInfo = array( "Database"=>"calibration", "UID"=>"en", "PWD"=>"@sS10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    $sql_m="select DISTINCT  b.Machine_id, c.Machine_name
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id
order by b.Machine_id";
    $result=sqlsrv_query($conn,$sql_m)or die("sql error".sqlsrv_errors());
    $array_mchine[][]=0; $x=0;
    $m_0=0; $m_1=0; $m_2=0;
    while($row=sqlsrv_fetch_array($result)){
        $array_mchine[$x][0]=$row[0];   //d
        $array_mchine[$x][1]=$row[1];   //name
        $array_mchine[$x][2]=0;   //0
        $array_mchine[$x][3]=0;   //1
        $array_mchine[$x][4]=0;   //2
        $x++;
    }
    $sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=0
group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
    while($row=sqlsrv_fetch_array($result)){
        for($i=0;$i<$x;$i++){
            if($array_mchine[$i][0]==$row[0]){
                $array_mchine[$i][2]=$row[1];
            }
        }
    }
    $sql_1="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=1
group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
    $result=sqlsrv_query($conn,$sql_1)or die("sql error".sqlsrv_errors());
    while($row=sqlsrv_fetch_array($result)){
        for($i=0;$i<$x;$i++){
            if($array_mchine[$i][0]==$row[0]){
                $array_mchine[$i][3]=$row[1];
            }
            }
        }
    $sql="select  b.Machine_id,count(b.Machine_id)
from DB_Schedule a,DB_Machinelist b ,DB_Machine c
where  a.Machine_list_id=b.Machine_list_id and b.Machine_id=c.Machine_id and a.Test_result_status=2
group by  b.Machine_id, c.Machine_name
order by b.Machine_id";
    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
    while($row=sqlsrv_fetch_array($result)){
        for($i=0;$i<$x;$i++){
            if($array_mchine[$i][0]==$row[0]){
                $array_mchine[$i][4]=$row[1];
            }
        }
    }
//    for($ii=0;$ii<$x;$ii++){
//        echo $array_mchine[$ii][0]."---".$array_mchine[$ii][1]."---".$array_mchine[$ii][2].$array_mchine[$ii][3].$array_mchine[$ii][4]."<br>";
//    }

    ?>
    <style>
        table#project_tb tr:nth-child(even) {
            background-color: #eee;
        }
        table#project_tb tr:nth-child(odd) {
            background-color:#fff;
        }
        table#project_tb th {
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
    <div class="row">
        <div class="col-md-20">
            <h1><a href="{{ route('project.index') }}"><font color="gray">計畫管理</font></a></h1>
            <hr>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group custom-search-form">
            {!! Form::open(['method'=>'GET','url'=>'project','class'=>'navbar-form navbar-left','role'=>'search']) !!}
            <select name="tag_project" id="tag_project" class="form-control">
                <option  value="Project_name">計畫名稱</option>
                <option  value="Standard_name">規範名稱</option>
                <option  value="Check_method">校驗方式</option>
                <option  value="Cycle">週期</option>
            </select>
            <input type="text" name="search" class="form-control" placeholder="Search ....">
                <span class="input-group-btn">
                            <button type="submit" class="btn btn-default-sm">
                                <i class="fa fa-search"></i>
                            </button>
                </span>
            </div>
    </div>
            {!! Form::close() !!}
    <div class="form-group row add">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('project.create') }}"><span class="glyphicon glyphicon-plus"></span> 新增計畫</a>
        </div>
    </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless" id="project_tb">
                <tr>
                    {{--<th width="30"><CENTER><font color="f0f8ff">@sortablelink('Project_id','No').</font></CENTER></th>--}}
                    <th width="60"><CENTER><font color="f0f8ff"> @sortablelink('Project_No','計劃編號')</font></CENTER></th>
                    <th width="80"><CENTER><font color="f0f8ff">@sortablelink('Project_name','計劃名稱')</font></CENTER></th>
                    <th width="60"><a href="project?sort=Standard_id"><CENTER><font color="f0f8ff">規範名稱</font></CENTER></a></th>

                    <th width="60"><CENTER><font color="f0f8ff">@sortablelink('Check_method','校驗方式')</font></CENTER></th>
                    <th width="40"><CENTER><font color="f0f8ff">@sortablelink('Cycle','週期')</font></CENTER></th>
                    <th width="80"><CENTER><font color="f0f8ff">@sortablelink('Create_id','建立者')</font></CENTER></th>
                    <th width="80"><CENTER><font color="f0f8ff">@sortablelink('Create_time','建立日期')</font></CENTER></th>
                    <th width="80"><CENTER><font color="f0f8ff">功 能</font></CENTER></th>
                </tr>
                {{ csrf_field() }}
                @foreach($projects as $key=>$project)
                    <tr>
                        {{--<td><CENTER>{{$project->Project_id}}</CENTER></td>--}}
                        <td><CENTER>{{$project->Project_No}}</CENTER></td>
                        <td><CENTER>{{$project->Project_name}}</CENTER></td>
                        <td><CENTER>
                        <?php
                        $n=$project->Standard_id;
                        $sql="select Standard_name from DB_Standard where Standard_id=".$n;
                        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                        while($row=sqlsrv_fetch_array($result)){
                            echo $row[0];
                        }?>
                        </CENTER></td>
                        <td><CENTER>{{$project->Check_method}}</CENTER></td>
                        <td><CENTER>{{$project->Cycle}}</CENTER></td>
                        <td><CENTER><?php
                                $sql="select Member_name from DB_Member where id=".$project->Create_id;
                                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                                while($row=sqlsrv_fetch_array($result)){
                                    echo $row[0];
                                }?></CENTER></td>
                        <td><CENTER>{{date('Y-m-d',strtotime($project->Create_time))}}</CENTER></td>
                        <td>
                            <CENTER>
                            <a HREF="cho?p_id=<?php echo $project->Project_id;?>"><span class="glyphicon glyphicon-briefcase" style="color:#337ab7"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="{{ route('project.edit',$project->Project_id) }}"><span class="glyphicon glyphicon-pencil" style="color:#337ab7"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                            {!! Form::open(['method' => 'DELETE','route' => ['project.destroy', $project->Project_id],'style'=>'display:inline']) !!}
                             <button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button>
                            {!! Form::close() !!}
                            </CENTER>
                      </td>
                    </tr>
                @endforeach
            </table>
            <CENTER>{!! $projects->render() !!}</CENTER>
        </div>
    </div>
@stop