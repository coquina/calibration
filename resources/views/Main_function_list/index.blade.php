@extends('layouts.default')
@section('content')
    <?php use App\machine; ?>
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
            <h1><a href="{{ route('MachineRepair.index') }}"><font color="gray">主功能管理</font></a></h1>
            <hr>
        </div>
    </div>




    {{--這是搜尋--}}
    <div class="col-md-12">
        <div class="input-group custom-search-form">
            {!! Form::open(['method'=>'GET','url'=>'Main_function_list','class'=>'navbar-form navbar-left','role'=>'search']) !!}

            <select name="Main_function_list" id="Main_function_list" class="form-control">
                <option  value="Main_function_No">主功能編號</option>
                <option  value="Main_function_name">主功能名稱</option>
                <option  value="Create_id">建立者編號</option>
                <option  value="Create_time">建立日期</option>
                <option  value="Description">說明</option>
                <option  value="Status">狀態</option>
                <option  value="icon">圖案</option>
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

        <div class="form-group row add">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('Main_function_list.create') }}"><span class="glyphicon glyphicon-plus"></span> 新增功能</a>
            </div>
        </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

        <div class="row">
            <div class="table-responsive">
    <table class="table table-borderless"name="machine_repair_tb" id="machine_repair_tb">
        <tr>
            <th  width="70"><center><font color="#f0f8ff">@sortablelink('Main_function_No','主功能編號')</font></center></th>
            <th  width="70"><center><font color="#f0f8ff">@sortablelink('Main_function_name','主功能名稱')</font></center></th>
            <th  width="100"><center><font color="#f0f8ff">@sortablelink('Create_id','建立者編號')</font></center></th>
            <th  width="70"><center><font color="#f0f8ff">@sortablelink('Create_time','建立日期')</font></center></th>
            <th  width="70"><center><font color="#f0f8ff">@sortablelink('Description','說明')</font></center></th>
            <th  width="60"><center><font color="#f0f8ff">@sortablelink('Status','狀態')</font></center></th>
            <th  width="70"><center><font color="#f0f8ff">@sortablelink('icon','圖案')</font></center></th>
            <th  width="100"><center><font color="white">@sortablelink('功能')</font></center></th>
        </tr>
        @foreach ($aaa as $key => $Main)
            <tr>
                <td><center>{{$Main->Main_function_No}}<center></td>
                <td><center>{{$Main->Main_function_name}}<center></td>
                <?php
                $serverName = "163.17.9.113";
                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                $sql="select*from DB_Member where id=".$Main->Create_id;
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                $x=0;	$array[]=0;
                while($row=sqlsrv_fetch_array($result)){
                    $array[$x]=$row[3];
                }
                ?>
                <td><center><?php echo  $array[$x]; ?> <center> </td>
                <td><center>{{date('Y-m-d',strtotime($Main->Create_time))}}<center></td>
                <td><center>{{$Main->Description}}<center></td>
                <td><center><?php if($Main->Status==1){
                        echo "啟用";
                    }elseif($Main->Status==0){
                    echo "停用";

                    }?></center></td>
                <td><center>{{$Main->icon}}<center></td>
                <td>
                    <center>
                    <a  href="Minor_function_list?find_main_id=<?php echo $Main->Main_function_id;?>"><span class="glyphicon glyphicon-pushpin"style="color:#337ab7"title="次功能"></span></a>&nbsp &nbsp
                    <a  href="{{ route('Main_function_list.show',$Main->Main_function_id) }}"><span class="glyphicon glyphicon-list-alt"style="color:#337ab7"title="顯示"></span></a>&nbsp &nbsp
                    <a href="{{ route('Main_function_list.edit',$Main->Main_function_id) }}"><span class="glyphicon glyphicon-pencil"style="color:#337ab7"title="編輯"></span></a>&nbsp &nbsp
                    {!! Form::open(['method' => 'DELETE','route' => ['Main_function_list.destroy', $Main->Main_function_id],'style'=>'display:inline']) !!}
                    <button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-trash"style="color:#337ab7"title="刪除"></span></button>&nbsp &nbsp
                    {!! Form::close() !!}
                    </center>
                </td>
            </tr>
        @endforeach
    </table>
    <center>{!! $aaa->render() !!}</center>
    </div>
        </div>
@stop