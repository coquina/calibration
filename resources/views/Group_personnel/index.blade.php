@extends('layouts.default')

@section('content')

    <style>
        table#group_p tr:nth-child(even) {
            background-color: #eee;
        }
        table#group_p tr:nth-child(odd) {
            background-color:#fff;
        }
        table#group_p th {
            background-color: #4F4F4F;
            /*color: white;*/
        }

        a:link
        {
            color:#ffffff;
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
            <h2><a href="{{ route('Group.index') }}"><font color="gray"> 群組管理</font></a> &raquo;  群組人員管理</h2>
            <hr>

        </div>

        {{--這是搜尋--}}
        <div class="col-md-12">
            <div class="input-group custom-search-form">
                {!! Form::open(['method'=>'GET','url'=>'Group_personnel','class'=>'navbar-form navbar-left','role'=>'search']) !!}
                <input type="hidden" name="g_id" value=<?php echo $_GET['g_id']?>>

                <select name="tag_group_personnel" id="tag_group_personnel" class="form-control">
                    <option  value="id">群組人員編號</option>
                    {{--<option  value="Create_id">建立者編號</option>--}}

                    <option  value="Create_time">建立日期</option>
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
    </div>

    <?php
    $serverName = "163.17.9.113\SQLEXPRESS";
    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    $s = \Request::get('g_id');
    $sql1="select*from DB_Group WHERE Group_id='".$s."';";
    $result=sqlsrv_query($conn,$sql1)or die("sql error".sqlsrv_errors());
    $r[]=0;
    while($row=sqlsrv_fetch_array($result)){
        $r[0]=$row[0]; $r[1]=$row[1]; $r[2]=$row[2]; $r[6]=$row[6];
    }
    ?><br>
    <strong>
        <CENTER>
            <font color="#FFAC12" size="5"><b>
                    群組編號: <?php echo $r[1]?>
                    群組名稱:   <?php echo $r[2]?>
                </b></font>
        </CENTER>
    </strong>

    <div class="form-group row add">
        <div class="pull-right">
            <a class="btn btn-success" href="Group_personnel/create?g_id=<?php echo $_GET['g_id']?>"> 新增群組人員</a>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-hover" name="group_p" id="group_p">
        <tr>
            <th><CENTER><font color="fof8ff">@sortablelink('Group_personnel_id','群組人員編號')</font></CENTER></th>
            <th><CENTER><font color="fof8ff">@sortablelink('id','帳號')</font></CENTER></th>
            <th><CENTER><font color="fof8ff">@sortablelink('Create_id','建立者名稱')</font></CENTER></th>
            <th><CENTER><font color="fof8ff">@sortablelink('Create_time','建立日期')</font></CENTER></th>
            <th><CENTER><font color="fof8ff">功能</font></CENTER></th>
        </tr>
        @foreach ($pe as $key =>$p)
            <tr>
                <td><CENTER>{{$p->id}}</CENTER></td>
                <?php
                $n=$p->id;
                $serverName = "163.17.9.113\SQLEXPRESS";
                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                $sql="select*from DB_Member where id='".$n."'";
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                $x=0;	$array[]=0;
                while($row=sqlsrv_fetch_array($result)){
                    $array[$x]=$row[1];
                }
                ?>
                <td><CENTER>{{$array[$x]}}</CENTER></td>
                <?php
                $n=$p->Create_id;
                $serverName = "163.17.9.113\SQLEXPRESS";
                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                $sql="select*from DB_Member where id='".$n."'";
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                $x=0;	$array[]=0;
                while($row=sqlsrv_fetch_array($result)){
                    $array[$x]=$row[3];
                }
                ?>
                <td><CENTER>{{$array[$x]}}</CENTER></td>
                <td><CENTER>{{date('Y-m-d',strtotime($p->Create_time))}}</CENTER></td>
                <td>
                    <CENTER>
                        <a  href="{{ route('Group_personnel.show',$p->Group_personnel_id) }}" title="預覽"><span class="glyphicon glyphicon-list-alt" style=color:#337ab7;></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a  href="{{ route('Group_personnel.edit',$p->Group_personnel_id) }}" title="修改"><span class="glyphicon glyphicon-pencil" style=color:#337ab7;></span></a>&nbsp;&nbsp;&nbsp;
                        {!! Form::open(['method' => 'DELETE','route' => ['Group_personnel.destroy', $p->Group_personnel_id],'style'=>'display:inline']) !!}
                        <button type="submit" class="btn btn-link" title="刪除"><span class="glyphicon glyphicon-trash"></span></button>
                        {!! Form::close() !!}
                    </CENTER>

                </td>
            </tr>
        @endforeach
    </table>
    <center><?php echo $pe->appends(['g_id' => $_GET['g_id']])->render(); ?></center>







@endsection