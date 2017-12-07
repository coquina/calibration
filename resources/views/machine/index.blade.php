@extends('layouts.default')
@section('content')
    <?php
    use Illuminate\Support\Facades\Auth;
    $serverName = "calibration.database.windows.net";
    $connectionInfo = array( "Database"=>"calibration", "UID"=>"en", "PWD"=>"@sS10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    ?>
    <style>
        table#machine_tb tr:nth-child(even) {
            background-color: #eee;
        }
        table#machine_tb tr:nth-child(odd) {
            background-color:#fff;
        }
        table#machine_tb th {
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
    <div class="col-md-12">
        <h1><a href="{{ route('machine.index') }}"><font color="gray">機器管理</font></a></h1>
        <hr>
    </div>
    </div>
    <div class="col-md-10">
        <div class="input-group custom-search-form">
            {!! Form::open(['method'=>'GET','url'=>'machine','class'=>'navbar-form navbar-left','role'=>'search']) !!}
            <select name="tag_machine_status" id="tag_machine_status" class="form-control">
                <option value="">狀態 - 全部</option>
                <option value="1">正常</option>
                <option value="0">維修</option>
                <option value="9">報廢</option>
            </select>
            <label class="form-control" >-</label>
            <select name="tag_machine_Instrument_sort" id="tag_machine_Instrument_sort" class="form-control">
                <option  value="">儀器分類- 全部</option>
                <option  value="層析">層析</option>
                <option  value="質譜">質譜</option>
                <option  value="光譜">光譜</option>
                <option  value="熱脫附">熱脫附</option>
                <option  value="熱裂解">熱裂解</option>
                <option  value="粒徑分析">粒徑分析</option>
                <option  value="自動化前處理/進樣">自動化前處理/進樣</option>
                <option  value="實驗室氣體產生器">實驗室氣體產生器</option>
                <option  value="移動實驗車">移動實驗車</option>
            </select>
            <label class="form-control" >-</label>
            <select name="tag_machine_1" id="tag_machine_1" class="form-control">
                <option  value="Machine_No">機器編號</option>
                <option  value="Machine_name">機器名稱</option>
                <option  value="Purchasing_department">採購部門</option>
            </select>
            <input type="text" name="search_1" class="form-control"  size="15">
            <select name="tag_machine_2" id="tag_machine_2" class="form-control">
                <option  value="Machine_No">機器編號</option>
                <option  value="Machine_name">機器名稱</option>
                <option  value="Purchasing_department">採購部門</option>
            </select>
            <input type="text" name="search_2" class="form-control" size="15">
            <button type="submit" class="form-control"><span class="glyphicon glyphicon-search"></span></button>
            </div>
    </div>
            {!! Form::close() !!}
    <div class="form-group row add">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('machine.create') }}"><span class="glyphicon glyphicon-plus"></span> 新增機器</a>
        </div>
    </div>
@if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless" id="machine_tb" name="machine_tb" >
                <tr>
                    <th width="20"><CENTER><font color="#f0f8ff">@sortablelink('Machine_No','機器編號')</font></CENTER></th>
                    <th width="30"><CENTER><font color="#f0f8ff">@sortablelink('Machine_name','機器名稱')</font></CENTER></th>
                    <th width="40"><CENTER><font color="#f0f8ff">@sortablelink('Machine_name','採購人')</font></CENTER></th>
                    <th width="60"><CENTER><font color="#f0f8ff">@sortablelink('Purchase_date','採購日期')</font></CENTER></th>
                    <th width="60"><CENTER><font color="#f0f8ff">@sortablelink('Instrument_sort','儀器分類')</font></CENTER></th>
                    <th width="50"><CENTER><font color="#f0f8ff">@sortablelink('Machine_prices','機器價格')</font></CENTER></th>
                    <th width="40"><CENTER><font color="#f0f8ff">@sortablelink('Status','狀態')</font></CENTER></th>
                    <th width="100"><CENTER><font color="#f0f8ff">功 能</font></CENTER></th>
                </tr>
                {{ csrf_field() }}
                @foreach($machines as $key=>$machine)
                    <tr>
                        <td><CENTER>{{$machine->Machine_No}}</CENTER></td>
                        <td><CENTER>{{$machine->Machine_name}}</CENTER></td>
                        <td><CENTER>
                                <?php
                                $n=$machine->id;
                                $sql="select Member_name from DB_Member where id='".$n."'";
                                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                                $x=0;	$array[]=0;
                                while($row=sqlsrv_fetch_array($result)){
                                    echo $row[0];
                                } ?></CENTER></td>
                        <td><CENTER>{{date('Y-m-d',strtotime($machine->Purchase_date))}}</CENTER></td>
                        <td><CENTER>{{$machine->Instrument_sort}}</CENTER></td>
                        {{--<td><CENTER>{{$machine->Service_life}}</CENTER></td>--}}
                        <td><CENTER>{{"$".$machine->Machine_prices}}</CENTER></td>
                        <td><CENTER><?php if($machine->Status==1){
                                    echo '<font color="green"  style="font-weight:bold;">正常</font>';
                                }elseif($machine->Status==0){
                                    echo '<font color="orange"  style="font-weight:bold;">維修</font>';
                                }else{
                                    echo '<font color="red"  style="font-weight:bold;">報廢</font>';
                                }?></CENTER></td>
                        <td>
                            <center>
                            <a  href="MachineRepair?m_id=<?php echo $machine->Machine_id;?>"><span class="glyphicon glyphicon-wrench" style="color:#337ab7"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a  href="{{ route('machine.show',$machine->Machine_id) }}"><span class="glyphicon glyphicon-list-alt" style="color:#337ab7" title="顯示"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a  href="{{ route('machine.edit',$machine->Machine_id) }}"><span class="glyphicon glyphicon-pencil" style="color:#337ab7" title="編輯"></span></a>&nbsp;&nbsp;&nbsp;
                            {!! Form::open(['method' => 'DELETE','title'=>'刪除','route' => ['machine.destroy', $machine->Machine_id],'style'=>'display:inline']) !!}
                            <button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button>
                            {!! Form::close() !!}
                            </center>
                      </td>
                    </tr>
                @endforeach
            </table>
            <CENTER>{!! $machines->render() !!}</CENTER>
        </div>
    </div>
@stop