@extends('layouts.default')
@section('content')
    <style>
           table#member_tb tr:nth-child(even) {
               background-color: #eee;
           }
        table#member_tb tr:nth-child(odd) {
            background-color:#fff;
        }
        table#member_tb th {
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
        <h2> <a  href="{{ route('member.index') }}" ><font color="gray"> 人員管理</font></a></h2>

        <HR>

    <div class="col-lg-12 margin-tb">
        <div class="col-md-6">
            <div class="input-group custom-search-form">
                {!! Form::open(['method'=>'GET','url'=>'member','class'=>'navbar-form navbar-left','role'=>'search']) !!}
                <select name="search_t" id="search_t" class="form-control">
                    <option  value="Account_number">帳號</option>
                    <option  value="Member_name">姓名</option>
                    <option  value="email">電子郵件</option>
                    <option  value="Job_title">職稱</option>
                    <option  value="Member_phone">聯絡電話</option>
                    <option  value="Cell_phone">手機</option>
                    <option  value="Member_address">聯絡地址</option>
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
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('member.create') }}"><span class="glyphicon glyphicon-plus"> 新增人員</span></a>
            </div>
    </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-hover" id="member_tb">
        <tr>
            <th width="15"><CENTER><font color="f0f8ff">No.</font></CENTER></th>
            <th width="8"><CENTER><font color="f0f8ff">@sortablelink('Account_number','帳號')</font></CENTER></th>
            <th width="15"><CENTER><font color="f0f8ff">@sortablelink('Member_name','姓名')</font></CENTER></th>
            <th width="25"><CENTER><font color="f0f8ff">@sortablelink('E_mail','電子郵件')</font></CENTER></th>
            <th width="60"><CENTER><font color="f0f8ff">@sortablelink('Job_title','職稱')</font></CENTER></th>
            <th width="20"><CENTER><font color="f0f8ff">@sortablelink('Cell_phone','手機')</font></CENTER></th>
            <th width="50"><CENTER><font color="f0f8ff">@sortablelink('Member_address','地址')</font></CENTER></th>
            <th width="100"><CENTER><font color="f0f8ff">功能</font></CENTER></th>
        </tr>
        @foreach ($ms as $key => $m)
            <tr>
                <td><CENTER>{{ ++$i }}</CENTER></td>
                <td><CENTER>{{$m->Account_number}}</CENTER></td>
                <td><CENTER>{{$m->Member_name}}</CENTER></td>
                <td><CENTER>{{$m->email}}</CENTER></td>
                <td><CENTER>{{$m->Job_title}}</CENTER></td>
                <td><CENTER>{{$m->Cell_phone}}</CENTER></td>
                <td><center>{{$m->Member_address}}</center></td>
                <td>
                    <CENTER>
                        <a  href="{{ route('member.show',$m->id) }}"><span class="glyphicon glyphicon-list-alt" style="color:#337ab7" title="顯示"></span></a>&nbsp;&nbsp;
                        <a  href="{{ route('member.edit',$m->id) }}" title="編輯"><span class="glyphicon glyphicon-pencil" style="color:#337ab7"></span></a>
                    {!! Form::open(['method' => 'DELETE','route' => ['member.destroy', $m->id],'style'=>'display:inline','title'=>'刪除']) !!}
                        <button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button>
                    {!! Form::close() !!}
                    </CENTER>
                </td>
            </tr>
        @endforeach
    </table>

    {{--<CENTER>{!! $ms->render() !!}</CENTER>--}}
    <CENTER> {!! $ms->appends(\Request::except('page'))->render() !!}</CENTER>

@stop