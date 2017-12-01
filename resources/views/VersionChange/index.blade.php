@extends('layouts.default')

@section('content')
    <style>
        table#versionchange_table tr:nth-child(even) {
            background-color: #eee;
        }
        table#versionchange_table tr:nth-child(odd) {
            background-color:#fff;
        }
        table#versionchange_table th {
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
        {{--<div class="col-lg-12 margin-tb">--}}
            <div class="col-md-12">
                <h2><a href="{{ route('VersionChange.index') }}"><font color="gray">歷史版次</font></a></h2>
                <hr>
            </div>


            {{--<div class="pull-left">--}}
                {{--這是搜尋--}}
                <div class="col-md-6">
                    {!! Form::open(['method'=>'GET','url'=>'VersionChange','class'=>'navbar-form navbar-left','role'=>'search']) !!}
                    <div class="input-group custom-search-form">
                        {{--<input type="text" name="search" class="form-control" placeholder="Search ....">--}}
                        {{--<span class="input-group-btn">--}}
                            {{--<button type="submit" class="btn btn-default-sm">--}}
                                {{--<i class="fa fa-search">Go</i>--}}
                            {{--</button>--}}
                        {{--</span>--}}
                    </div>
                    {!! Form::close() !!}
                </div>

                {{--<div class="pull-right">--}}
                    {{--<a class="btn btn-success" href="{{ route('VersionChange.create') }}"> 新增規範</a>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-hover" name="versionchange_table" id="versionchange_table">
        <tr>
            {{--<th>NO</th>--}}
            {{--<th>規範流水號</th>--}}
            {{--<th><font color="f0f8ff">規範編號</font></th>--}}
            {{--<th><font color="f0f8ff">規範名稱</font></th>--}}
            {{--<th><font color="f0f8ff">建立者</font></th>--}}
            {{--<th>建立日期</th>--}}
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
        @foreach ($versionchange as $key => $DB_version_change)
            <tr>
                {{--<td>{{ ++$i }}</td>--}}
                {{--<td>{{$DB_version_change->Standard_id}}</td>--}}
                <td><center>{{$DB_version_change->Standard_no}}</center></td>
                <td><center>{{$DB_version_change->Standard_name}}</center></td>
                {{--<td>{{$DB_version_change->Create_id}}</td>--}}

                <td><center>
                    <?php
                    $serverName = "163.17.9.113\SQLEXPRESS";
                    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                    $conn = sqlsrv_connect( $serverName, $connectionInfo);
                    $sql="select Member_name from DB_Member where id=".$DB_version_change->Create_id;
                    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                    $array[]=0;
                    while($row=sqlsrv_fetch_array($result)){
                        echo $row[0];
                    }
                    ?>
                    </center></td>

                {{--<td>{{$DB_version_change->Create_time}}</td>--}}
                {{--<td>{{$DB_version_change->File_norm}}</td>--}}
                {{--<td>{{$DB_version_change->File_norm_code}}</td>--}}
                <td><center>{{$DB_version_change->Cycle_R}}</center></td>
                {{--<td>{{$DB_version_change->S_Department}}</td>--}}
                {{--<td>{{$DB_version_change->Issuse_Department}}</td>--}}
                {{--<td>{{$DB_version_change->Citation}}</td>--}}
                <td><center>{{$DB_version_change->Version}}</center></td>
                {{--<td>{{$DB_version_change->Standard_Status}}</td>--}}
                <td><center>
                    <a  href="{{ route('VersionChange.show',$DB_version_change->Standard_id) }}"  title="顯示"><span class="glyphicon glyphicon-list-alt"  style="color:#337ab7"></span></a>
                    {{--<a class="btn btn-info" href="{{ route('VersionChange.show',$DB_version_change->Standard_id) }}">顯示</a>--}}
                    {{--<a class="btn btn-primary" href="{{ route('VersionChange.edit',$DB_version_change->Standard_id) }}">編輯</a>--}}
                    {{--{!! Form::open(['method' => 'DELETE','route' => ['VersionChange.destroy', $DB_version_change->Standard_id],'style'=>'display:inline']) !!}--}}
                    {{--{!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}--}}
                    {{--{!! Form::close() !!}--}}
                    </center></td>
            </tr>
        @endforeach
    </table>

    <center>{!! $versionchange->render() !!}</center>

@endsection