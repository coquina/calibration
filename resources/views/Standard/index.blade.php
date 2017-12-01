@extends('layouts.default')
@section('content')
    <?php use Illuminate\Support\Facades\Auth;
    $user=Auth::user()->id;
    $serverName = "163.17.9.113\SQLEXPRESS";
    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    $sql="select Group_id from DB_Group_personnel where id=".$user;
    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
    $array_gp[]=0;
    while($row=sqlsrv_fetch_array($result)){
        $array_gp[0]=$row[0];
    }
    //echo $array_gp[0];

    $sql="select Minor_function_id from DB_Access where Group_id=".$array_gp[0];
    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
    $array_acc[]=0;
    while($row=sqlsrv_fetch_array($result)){
        $array_acc[0]=$row[0];
    }
    $sql="select Minor_function_name from DB_Minor_function_list where Minor_function_id=". $array_acc[0];
    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
    $array_m[]=0;
    while($row=sqlsrv_fetch_array($result)){
        $array_m[0]=$row[0];
    }
    //echo   $array_m[0];





    //     if(Auth::user()->Member_name){
    //
    //     }

    ?>


    <style>
        table#standard_table tr:nth-child(even) {
            background-color: #eee;
        }
        table#standard_table tr:nth-child(odd) {
            background-color:#fff;
        }
        table#standard_table th {
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
        {{--<div class="pull-left">--}}
        <div class="col-md-12">
            <h2><a href="{{ route('Standard.index') }}"><font color="gray">規範管理</font></a></h2>
            <hr>
        </div>
        {{--<a href="{{ route('VersionChange.index') }}"> 版次異動</a>--}}
        <div class="col-lg-12 margin-tb">





            {{--<div class="pull-left">--}}
                {{--這是搜尋--}}
                <div class="col-md-6">
                    <div class="input-group custom-search-form">
                    {!! Form::open(['method'=>'GET','url'=>'Standard','class'=>'navbar-form navbar-left','role'=>'search']) !!}
                        <p>
                        <select name="Standard" id="Standard" class="form-control">
                            <option  value="Standard_name">規範名稱</option>
                        </select>

                         <input type="text" name="search" class="form-control" placeholder="Search ....">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default-sm">
                                <i class="fa fa-search">Go</i>
                            </button>
                        </span>
                        </p>
                        {{--<p>--}}

                            {{--<select name="Standard" id="Standard" class="form-control">--}}
                                {{--<option  value=""></option>--}}
                                {{--<option  value="Create_time">建立日期</option>--}}
                            {{--</select>--}}
                            {{--<input type="date" name="search" value="Create_time" class="form-control" placeholder="Search ....">--}}
                            {{--<button type="submit" class="btn btn-default-sm">--}}
                                {{--<i class="fa fa-search">Go</i>--}}
                            {{--</button>--}}
                        {{--</p>--}}
                    {!! Form::close() !!}

                    </div>
                </div>


                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('Standard.create') }}"><span class="glyphicon glyphicon-plus"></span> 新增規範</a>
                </div>

            {{--</div>--}}
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-hover" name="standard_table" id="standard_table">
        <tr>
            {{--<th>NO</th>--}}
            {{--<th>規範流水號</th>--}}
            {{--<th><font color="f0f8ff">規範編號</font></th>--}}
            {{--<th><font color="f0f8ff">規範名稱</font></th>--}}
            {{--<th><font color="f0f8ff">建立者</font></th>--}}
            {{--<th>建立日期</th>--}}
            {{--<th>原始文件規範檔名</th>--}}
            {{--<th>系統文件規範編碼</th><th>建立日期</th>--}}
            {{--<th>原始文件規範檔名</th>--}}
            {{--<th>系統文件規範編碼</th>--}}
            {{--<th><font color="f0f8ff">建議週期(月)</font></th>--}}
            {{--<th>規範所屬單位</th>--}}
            {{--<th>發行單位</th>--}}
            {{--<th>引用出處</th>--}}
            {{--<th><font color="f0f8ff">版次</font></th>--}}
            {{--<th>規範狀態</th>--}}
            {{--<th><font color="f0f8ff">編輯</font></th>--}}


            <th width="30"><CENTER><font color="f0f8ff">@sortablelink('Standard_no','規範編號')</font></CENTER></th>
            <th width="60"><CENTER><font color="f0f8ff">@sortablelink('Standard_name','規範名稱')</font></CENTER></th>
            <th width="30"><CENTER><font color="f0f8ff">@sortablelink('Create_id','建立者')</font></CENTER></th>
            <th width="50"><CENTER><font color="f0f8ff">@sortablelink('Cycle_R','建議週期(月)')</font></CENTER></th>
            <th width="30"><CENTER><font color="f0f8ff">@sortablelink('Version','版次')</font></CENTER></th>
            <th width="100"><CENTER><font color="f0f8ff">功能</font></CENTER></th>


        </tr>
        @foreach ($standard as $key => $DB_Standard)
            <tr><center>
                {{--<td>{{ ++$i }}</td>--}}
                {{--<td>{{$DB_Standard->Standard_id}}</td>--}}
                    <td><center>{{$DB_Standard->Standard_no}}</center></td>
                    <td><center>{{$DB_Standard->Standard_name}}</center></td>
                {{--<td>{{$DB_Standard->Create_id}}</td>--}}

                <td><center>
                <?php
                $serverName = "163.17.9.113\SQLEXPRESS";
                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                $sql="select Member_name from DB_Member where id=".$DB_Standard->Create_id;
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                $array[]=0;
                while($row=sqlsrv_fetch_array($result)){
                    echo $row[0];
                }
                ?></center></td>

                {{--<td>{{$DB_Standard->Create_time}}</td>--}}
                {{--<td>{{$DB_Standard->File_norm}}</td>--}}
                {{--<td>{{$DB_Standard->File_norm_code}}</td>--}}
                <td><center>{{$DB_Standard->Cycle_R}}</center></td>
                {{--<td>{{$DB_Standard->S_Department}}</td>--}}
                {{--<td>{{$DB_Standard->Issuse_Department}}</td>--}}
                {{--<td>{{$DB_Standard->Citation}}</td>--}}
                <td><center>{{$DB_Standard->Version}}</center></td>
                {{--<td>{{$DB_Standard->Standard_Status}}</td>--}}
                <td><center>
                    <a  href="{{ route('Standard.show',$DB_Standard->Standard_id) }}"  title="顯示"><span class="glyphicon glyphicon-list-alt"  style="color:#337ab7"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{--<a class="btn btn-info" href="{{ route('Standard.show',$DB_Standard->Standard_id) }}">顯示</a>--}}

                    <a  href="{{ route('Standard.edit',$DB_Standard->Standard_id) }}"  title="編輯"><span class="glyphicon glyphicon-pencil"  style="color:#337ab7"></span></a>
                    {{--<a class="btn btn-primary" href="{{ route('Standard.edit',$DB_Standard->Standard_id) }}">編輯</a>--}}

                    {!! Form::open(['method' => 'DELETE','route' => ['Standard.destroy', $DB_Standard->Standard_id],'style'=>'display:inline','title'=>'刪除']) !!}
                    <button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button>

                    {{--{!! Form::open(['method' => 'DELETE','route' => ['Standard.destroy', $DB_Standard->Standard_id],'style'=>'display:inline']) !!}--}}
                    {{--{!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}--}}
                    {{--<a class="btn btn-warning" href="{{ route('VersionChange.index',$DB_Standard->Standard_id) }}">歷史版次</a>--}}
                    <a  href="VersionChange?history_no=<?php echo $DB_Standard->Standard_no;?>"  title="歷史版次"><span class="glyphicon glyphicon-file"  style="color:#337ab7"></span></a>
                    {!! Form::close() !!}
                    </center></td>
                </tr>
        @endforeach
    </table>

    <center>{!! $standard->render() !!}</center>

@endsection