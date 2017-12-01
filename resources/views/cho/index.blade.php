@extends('layouts.default')
@section('content')
    <style>
        table#cho_tb tr:nth-child(even) {
            background-color: #eee;
        }
        table#cho_tb tr:nth-child(odd) {
            background-color:#fff;
        }
        table#cho_tb th {
            background-color: #4F4F4F;
            /*color: white;*/
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <h2><a onclick=history.back()><font color="gray">計畫管理 </font></a> <font size="5" color="gray"><span class="glyphicon glyphicon-menu-right"></span></font><font color="black">機器選單</font></h2>
        </div>
    </div>

<?php
    $serverName = "163.17.9.113";
    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    $s = \Request::get('p_id');
    ?>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif


    {{--這是搜尋--}}
    <div class="col-md-6">
        <div class="input-group custom-search-form">
            {!! Form::open(['method'=>'GET','url'=>'cho','class'=>'navbar-form navbar-left','role'=>'search']) !!}
            <input type="hidden" name="p_id" value=<?php echo $_GET['p_id']?>>
            <select name="tag_list" id="tag_list" class="form-control">
                <option  value="Project_id">計畫編號</option>
                <option  value="Machine_id">機器編號</option>
                <option  value="Newold_status">新舊狀態</option>
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

    {{--Button--}}
    <div class="form-group row add">
        <div class="pull-right">
            <a class="btn btn-success" href="cho/create?p_id=<?php echo $_GET['p_id']; ?>"><span class="glyphicon glyphicon-plus"></span> 新增機器選單</a>
        </div>
    </div>
    {{--Button--}}
<br>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless" id="cho_tb" name="cho_tb">
                <tr>
                    <th width="100"><center><font color="f0f8ff">機器選單編號</font></center></th>
                    <th width="60"><center><font color="f0f8ff">計劃名稱</font></center></th>
                    <th width="60"><center><font color="f0f8ff">校驗方式</font></center></th>
                    <th width="60"><center><font color="f0f8ff">週期</font></center></th>
                    <th width="60"><center><font color="f0f8ff">機器</font></center></th>
                    <th width="80"><center><font color="f0f8ff">建立日期</font></center></th>
                    <th width="80"><center><font color="f0f8ff">建立者</font></center></th>
                    <th width="80"><center><font color="f0f8ff">狀態</font></center></th>
                    <th width="80"><center><font color="f0f8ff">功能</font></center></th>
                </tr>
                {{ csrf_field() }}
                @foreach($chos as $key=>$cho)
                    <tr>
                        <td><center>{{$cho->Machine_list_id}}</center></td>
                        <td><center><?php
                                $sql_count="select Project_name,Check_method,Cycle from DB_Project where Project_id=".$cho->Project_id;
                                $result=sqlsrv_query($conn,$sql_count)or die("sql error".sqlsrv_errors());
                                while($row=sqlsrv_fetch_array($result)){
                                    echo $row[0]; ?></center></td>
                        <td><center><?php echo $row[1]?></center></td>
                        <td><center><?php echo $row[2]; }?></center></td>
                        <td><center><?php
                                $sql_count="select Machine_name from DB_Machine where Machine_id=".$cho->Machine_id;
                                $result=sqlsrv_query($conn,$sql_count)or die("sql error".sqlsrv_errors());
                                while($row=sqlsrv_fetch_array($result)){
                                    echo $row[0];
                                    }
                                    ?></center></td>
                        <td><center>{{date('Y-m-d',strtotime($cho->Create_time))}}</center></td>
                        <td><center><?php
                                $sql_count="select Member_name from DB_Member where id=". $cho->Create_id;
                                $result=sqlsrv_query($conn,$sql_count)or die("sql error".sqlsrv_errors());
                                while($row=sqlsrv_fetch_array($result)){
                                    echo $row[0]; }?></center></td>

                        <td><center><?php if($cho->Newold_status==0){
                                    echo "新";
                                }else{
                                    echo "舊";
                                }?></center></td>
                        <td>
                            <center>
                                {!! Form::open(['method' => 'DELETE','route' => ['cho.destroy',$cho->Machine_list_id],'style'=>'display:inline']) !!}
                                <button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button>
                                {!! Form::close() !!}
                            </center>
                        </td>
                    </tr>
                @endforeach
            </table>
            <CENTER> {!! $chos->render() !!}</CENTER>
        </div>
    </div>
@stop