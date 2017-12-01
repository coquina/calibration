@extends('layouts.default')

@section('content')
    <style>
        table#group_u tr:nth-child(even) {
            background-color: #eee;
        }
        table#group_u tr:nth-child(odd) {
            background-color:#fff;
        }
        table#group_u th {
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
    <h2><a href="{{ route('Group.index') }}"><font color="gray">群組管理</font></a></h2>
    <hr>
    {{--JavaScript--}}
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">


                <div class="pull-left">

                    {{--這是搜尋--}}
                    <div class="col-md-12">

                        <div class="input-group custom-search-form">
                            {!! Form::open(['method'=>'GET','url'=>'Group','class'=>'navbar-form navbar-left','role'=>'search']) !!}
                            <select name="tag_group" id="tag_group" class="form-control">
                                <option  value="Group_No">群組編號</option>
                                <option  value="Group_name">群組名稱</option>
                                <option  value="Description">說明</option>
                                <option  value="Status">狀態</option>

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
            </div>
        </div>
    </div>


    {{--Button--}}
    <div class="form-group row add">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('Group.create') }}"> 新增群組</a>
        </div>
    </div>
    {{--Button--}}

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-hover" id="group_u" name="group_u">
        <tr>
            <th><CENTER><font color="fof8ff">@sortablelink('Group_No','群組編號')</font></CENTER></th>
            <th><CENTER><font color="fof8ff">@sortablelink('Group_name','群組名稱')</font></CENTER></th>
            <th><CENTER><font color="fof8ff">@sortablelink('Create_id','建立者名稱')</font></CENTER></th>
            <th><CENTER><font color="fof8ff">@sortablelink('Create_time','建立日期')</font></CENTER></th>
            <th><CENTER><font color="fof8ff">@sortablelink('Description','說明')</font></CENTER></th>
            <th><CENTER><font color="fof8ff">@sortablelink('Status','狀態')</font></CENTER></th>
            <th><CENTER><font color="fof8ff">功能</font></CENTER></th>
        </tr>
        @foreach ($gr as $key => $g)
            <tr>
                {{--<td>{{$g->Group_id}}</td>--}}
                <td><CENTER>{{$g->Group_No}}</CENTER></td>
                <td><CENTER>{{$g->Group_name}}</CENTER></td>
                <?php
                $serverName = "163.17.9.113\SQLEXPRESS";
                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                $sql="select Member_name from DB_Member where id=".$g->Create_id;
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                $array[]=0;
                while($row=sqlsrv_fetch_array($result)){
                    $array[0]=$row[0];
                }
                ?>
                <td><CENTER><?php echo $array[0];?></CENTER></td>

                <td><CENTER>{{date('Y-m-d',strtotime($g->Create_time))}}</CENTER></td>
                <td><CENTER><?php echo substr("{$g->Description}", 0, 10);?></CENTER></td>
                {{--<td><CENTER>{{$g->Description}}</CENTER></td>--}}

                <td><CENTER><?php if($g->Status==1){
                            echo "啟用";
                        }elseif($g->Status==0){
                            echo "未啟用";
                        }?>
                    </CENTER></td>
                <td><CENTER>

                        <a title="權限管理" href="Access?g_id=<?php echo $g->Group_id;?>"><span class="glyphicon glyphicon-cog" style=color:#337ab7></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{--人員--}}<a  href="Group_personnel?g_id=<?php echo $g->Group_id;?>" title="人員"><span class="glyphicon glyphicon-user" style=color:#337ab7;></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{--預覽--}}<a  href="{{ route('Group.show',$g->Group_id) }}" title="預覽"><span class="glyphicon glyphicon-list-alt" style=color:#337ab7;></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{--修改--}}<a  href="{{ route('Group.edit',$g->Group_id) }}" title="修改"><span class="glyphicon glyphicon-pencil" style=color:#337ab7;></span></a>&nbsp;
                        {{--刪除--}}{!! Form::open(['method' => 'DELETE','route' => ['Group.destroy', $g->Group_id],'style'=>'display:inline']) !!}
                                    <button type="submit" class="btn btn-link" title="刪除"><span class="glyphicon glyphicon-trash"></span></button>
                                    {!! Form::close() !!}{{--刪除--}}
                    </CENTER>
                </td>



            </tr>
        @endforeach
    </table>

    <center>{!! $gr->render() !!}</center>

@endsection