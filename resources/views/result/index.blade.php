@extends('layouts.default')
@section('content')

    <style>
        table#result_tb tr:nth-child(even) {
            background-color: #eee;
        }
        table#result_tb tr:nth-child(odd) {
            background-color:#fff;
        }
        table#result_tb th {
            background-color: #4F4F4F;
            /*color: white;*/
        }
    </style>

    <div class="row">
    <div class="col-md-12">
        <h1><a href="{{ route('result.index') }}">結果管理</a></h1>
    </div>
    </div>
    <div class="col-md-12">
        <div class="input-group custom-search-form">
            {!! Form::open(['method'=>'GET','url'=>'result','class'=>'navbar-form navbar-left','role'=>'search']) !!}
            <input type="text" name="search_1" class="form-control" placeholder="排程編號" size="15">
            <button type="submit" class="form-control"><span class="glyphicon glyphicon-search"></span></button>
        </div>
    </div>
    {!! Form::close() !!}

    <div class="form-group row add">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('result.create') }}"><span class="glyphicon glyphicon-plus"></span> 新增結果</a>
        </div>
    </div>
      @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless" id="result_tb">
                <tr>
                    <th width="50"><CENTER><font color="f0f8ff">I D</font></CENTER></th>
                    <th width="30"><CENTER><font color="f0f8ff">排程編號</font></CENTER></th>
                    <th width="10"><CENTER><font color="f0f8ff">項次</font></CENTER></th>
                    <th width="50"><CENTER><font color="f0f8ff">器示值</font></CENTER></th>
                    <th width="10"><CENTER><font color="f0f8ff">標準值</font></CENTER></th>
                    <th width="10"><CENTER><font color="f0f8ff">器差值</font></CENTER></th>
                    <th width="10"><CENTER><font color="f0f8ff">最小不確定度</font></CENTER></th>
                    <th width="100"><CENTER><font color="f0f8ff">編輯</font></CENTER></th>
                </tr>
                {{ csrf_field() }}
                @foreach($results as $key=>$result)
                    <tr>
                        <td><CENTER>{{$result->Result_id}}</CENTER></td>
                        <td><CENTER>{{$result->Schedule_id}}</CENTER></td>
                        <td><CENTER>{{$result->Line}}</CENTER></td>
                        <td><CENTER>{{$result->Lndication_value}}</CENTER></td>
                        <td><CENTER>{{$result->Standard_value}}</CENTER></td>
                        <td><CENTER>{{$result->D_value}}</CENTER></td>
                        <td><CENTER>{{$result->Minimum_uncertainty}}</CENTER></td>
                        <td>
                            <CENTER>
                                <a  href="{{ route('result.show',$result->Result_id) }}"><span class="glyphicon glyphicon-list-alt"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a  href="{{ route('result.edit',$result->Result_id) }}"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                {{--<a class="btn btn-success" href="{{route('schedule.edit')}}">校驗結果</a>--}}
                                {{--<a class="btn btn-info" href="{{ route('schedule.show',$schedule->Schedule_id) }}">顯示</a>--}}
                                {{--{!! Form::open(['method' => 'DELETE','route' => ['schedule.destroy', $schedule->Schedule_id],'style'=>'display:inline']) !!}--}}
                                {{--{!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}--}}
                                {{--{!! Form::close() !!}--}}
                            </CENTER>
                        </td>
                    </tr>
                @endforeach
            </table>
            <CENTER> {!! $results->render() !!}</CENTER>
        </div>
    </div>
@stop