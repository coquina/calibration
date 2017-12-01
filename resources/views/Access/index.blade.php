@extends('layouts.default')

@section('content')

    <style>
        table#access tr:nth-child(even) {
            background-color: #eee;
        }
        table#access tr:nth-child(odd) {
            background-color:#fff;
        }
        table#access th {
            background-color: #4F4F4F;
            /*color: white;*/
        }
            a:link
            {
                color: #ffffff;
            }
        a:visited {
            color:#ffffff;
        }
    </style>
    <h2><a href="{{ route('Group.index') }}"><font color="gray"> 群組管理</font></a> &raquo;  權限管理</h2>
    <hr>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">


            </div>

            <div class="pull-left">
                {{--這是搜尋--}}
                {{--<div class="col-md-6">--}}
                    {{--{!! Form::open(['method'=>'GET','url'=>'Access','class'=>'navbar-form navbar-left','role'=>'search']) !!}--}}
                    {{--<div class="input-group custom-search-form">--}}
                        {{--<input type="text" name="search" class="form-control" placeholder="搜尋權限編號...">--}}
                        {{--<span class="input-group-btn">--}}
                            {{--<button type="submit" class="btn btn-default-sm">--}}
                                {{--<i class="fa fa-search">Go</i>--}}
                            {{--</button>--}}
                        {{--</span>--}}
                    {{--</div>--}}
                    {{--{!! Form::close() !!}--}}
                {{--</div>--}}
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

                <div class="pull-right">
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <a href="Access/create?g_id=<?php echo $_GET['g_id'];?>"><span class="btn btn-success" > 新增權限</a>
                    <a class="btn btn-info" href="{{ route('Group.index') }}">返回群組</a>

                </div>
                <br><br>
            </div>
        </div>
    </div>
    <?php
    if(isset($_REQUEST['success'])=="done")
    {
        echo "<div class='success'>新增成功</div>";
    }
    ?>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>

        </div>
    @endif

    <table class="table table-hover" name="access" id="access">
        <tr>
            {{--<th>NO.</th>--}}
            {{--<th><font color="white">權限編號</th>--}}
            {{--<th><font color="white">群組流水號</th>--}}
            {{--<th><font color="white">次功能流水號</th>--}}
            {{--<th><font color="white">建立者</th>--}}
            {{--<th><font color="white">建立日期</th>--}}
            {{--<th><font color="white">Actions</th>--}}

            <th width=""15"><CENTER><font color="f0f8ff">@sortablelink('Access_id','權限編號')</font></CENTER></th>
            <th width=""15"><CENTER><font color="f0f8ff">@sortablelink('Group_id','群組流水號')</font></CENTER></th>
            <th width=""15"><CENTER><font color="f0f8ff">@sortablelink('Minor_function_id','次功能名稱')</font></CENTER></th>
            <th width=""15"><CENTER><font color="f0f8ff">@sortablelink('Create_id','建立者')</font></CENTER></th>
            <th width=""15"><CENTER><font color="f0f8ff">@sortablelink('Create_time','建立日期')</font></CENTER></th>

            <th width=""15"><CENTER><font color="f0f8ff">動作</font></CENTER></th>


        </tr>
        @foreach ($as as $key => $a)
            <tr>
                {{--<td>{{ ++$i }}</td>--}}
                <td><center>{{$a->Access_id}}</center></td>

                <td><center>{{$a->Group_id}}</center></td>
                {{--<td><center>{{$a->Minor_function_id}}</center></td>--}}
                <?php
                $name=$a->Minor_function_id;
                $serverName = "163.17.9.113\SQLEXPRESS";
                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                $sql="select*from DB_Minor_function_list where Minor_function_id='".$name."'";
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                $x=0;	$array[]=0;
                while($row=sqlsrv_fetch_array($result)){
                    $array[$x]=$row[2];

                }
                ?>
                <td><center>{{$array[$x]}}</center></td>


                <?php
                $n=$a->Create_id;
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
                <td><center>{{$array[$x]}}</center></td>
                <td><center>{{date('Y-m-d',strtotime($a->Create_time))}}</center></td>

                <td><center>
                    <a  href="{{ route('Access.show',$a->Access_id) }}"title="顯示"><span class="glyphicon glyphicon-list-alt" style="color:#337abc"></span> </a> &nbsp &nbsp
                    {{--<a  href="{{ route('Access.edit',$a->Access_id) }}"title="編輯"><span class="glyphicon glyphicon-pencil" style="color:#337abc"></span> </a>--}}
                    <a title="編輯" href="Access/<?php echo $a->Access_id;?>/edit?g_id=<?php echo $a->Group_id;?>"><span class="glyphicon glyphicon-pencil" style=color:#337ab7></span></a>
                    {!! Form::open(['method' => 'DELETE','route' => ['Access.destroy', $a->Access_id],'style'=>'display:inline','title'=>'刪除']) !!}
                    <button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button>

                    {!! Form::close() !!}
                    </center>
                </td>

            </tr>
        @endforeach
    </table>

    <center><?php echo $as->appends(['g_id' => $_GET['g_id']])->render(); ?></center>


@endsection