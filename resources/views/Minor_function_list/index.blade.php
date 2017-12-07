@extends('layouts.default')

@section('content')

    <style>
        table#minor tr:nth-child(even) {
            background-color: #eee;
        }
        table#minor tr:nth-child(odd) {
            background-color:#fff;
        }
        table#minor th {
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
    <?php
    use Illuminate\Support\Facades\Auth;
    $serverName = "calibration.database.windows.net";
    $connectionInfo = array( "Database"=>"calibration", "UID"=>"en", "PWD"=>"@sS10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    ?>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">

                <h2> <a href="{{ route('Main_function_list.index') }}"> <span style="color:gray">主功能管理</span> </a><font size="5"><span class="glyphicon glyphicon-menu-right"></span></font> 次功能管理 </h2>
            </div>

            <br><br>    <br><br>




                                    <center><font color="#FFAC12" size="5"><b>
                                        主功能名稱: <?php
                                        $sql="select Main_function_name from DB_Main_function_list where Main_function_id=".$_GET['find_main_id'];
                                        $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                                        $array[]=0;
                                        while($row=sqlsrv_fetch_array($result)){
                                            echo $row[0];
                                        }
                                        ?>
                                        群組名稱: <?php echo $_GET['find_main_id'];?>   </b> </font> </center>


               <br>

            <hr>
            {{--<div class="pull-left">--}}
                {{--這是搜尋--}}


                <div class="pull-right">
                    {{--&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp--}}
                    {{--&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp--}}
                    {{--&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp--}}
                    {{--&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp--}}
                    {{--&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp--}}
                    {{--&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp--}}
                    <a class="btn btn-success" href="Minor_function_list/create?find_main_id=<?php echo $_GET['find_main_id']?>"> 新增次功能</a>



                </div>
            <br><br>
            {{--</div>--}}

        </div>

    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-hover" name="minor" id="minor">
        <tr>
            {{--<th>NO.</th>--}}
            {{--<th>次功能流水號</th>--}}
            {{--<th><font color="white">次功能編號</th>--}}
            {{--<th><font color="white">次功能名稱</th>--}}
            {{--<th><font color="white">建立者名稱</th>--}}
            {{--<th><font color="white">建立日期</th>--}}
            {{--<th><font color="white">說明</th>--}}
            {{--<th><font color="white">狀態</th>--}}
            {{--<th><font color="white">次功能程式</th>--}}
            {{--<th><font color="white">Actions</th>--}}

            <th width="15"><CENTER><font color="f0f8ff">@sortablelink('Minor_function_No','次功能編號')</font></CENTER></th>
            <th width="15"><CENTER><font color="f0f8ff">@sortablelink('Minor_function_name','次功能名稱')</font></CENTER></th>
            <th width="15"><CENTER><font color="f0f8ff">@sortablelink('Create_id','建立者名稱')</font></CENTER></th>
            <th width="15"><CENTER><font color="f0f8ff">@sortablelink('Create_time','建立日期')</font></CENTER></th>
            <th width="15"><CENTER><font color="f0f8ff">@sortablelink('Description','說明')</font></CENTER></th>
            <th width="15"><CENTER><font color="f0f8ff">@sortablelink('Status','狀態')</font></CENTER></th>
            <th width="15"><CENTER><font color="f0f8ff">@sortablelink('Minor_function_program','次功能程式')</font></CENTER></th>

            <th width="15"><CENTER><font color="f0f8ff">動作</font></CENTER></th>
        </tr>
        @foreach ($minors as $key => $minor)
            <tr>
                {{--<td>{{ ++$i }}</td>--}}
                {{--<td>{{$minor->Minor_function_id}}</td>--}}
                <td><CENTER>{{$minor->Minor_function_No}}</CENTER></td>
                <td><CENTER>{{$minor->Minor_function_name}}</CENTER></td>
                <?php
                $n=$minor->Create_id;
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
                {{--<td>{{$minor->Create_id}}</td>--}}
                {{--<td>{{$minor->Create_id}}</td>--}}
                <td><CENTER>{{date('Y-m-d',strtotime($minor->Create_time))}}</CENTER></td>
                <td><CENTER>{{$minor->Description}}</CENTER></td>
                <td><CENTER><?php if($minor->Status==1){
                    echo "啟用";
                    }elseif($minor->Status==0){
                    echo "停用";

                    }?></CENTER></td>
                {{--<td>{{$minor->Status}}</td>--}}
                {{--<td>{{$minor->Status}}</td>--}}
                <td><CENTER>{{$minor->Minor_function_program}}</CENTER></td>
                <td><CENTER>
                    <a  href="{{ route('Minor_function_list.show',$minor->Minor_function_id) }}"title="顯示"><span class="glyphicon glyphicon-list-alt" style="color:#337abc"></span> </a>&nbsp&nbsp&nbsp
                    {!! Form::open(['method' => 'DELETE','route' => ['Minor_function_list.destroy', $minor->Minor_function_id],'style'=>'display:inline','title'=>'刪除']) !!}
                    {{--<a  href="{{ route('Minor_function_list.edit',$minor->Minor_function_id) }}"title="編輯"><span class="glyphicon glyphicon-pencil" style="color:#337abc"></span> </a>--}}
                    <a title="編輯" href="Minor_function_list/<?php echo $minor->Minor_function_id;?>/edit?find_main_id=<?php echo $minor->Main_function_id;?>"><span class="glyphicon glyphicon-pencil" style=color:#337ab7></span></a>
                    <button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button>
                    {!! Form::close() !!}

                    {{--{!! Form::open(['method' => 'DELETE','route' => ['Minor_function_list.destroy', $minor->Minor_function_id],'style'=>'display:inline']) !!}--}}
                    {{--{!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}--}}
                    {{--{!! Form::close() !!}--}}
                    </CENTER>
                </td>
            </tr>
        @endforeach
    </table>

    <center><?php echo $minors->appends(['find_main_id' => $_GET['find_main_id']])->render(); ?></center>


@endsection