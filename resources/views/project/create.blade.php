@extends('layouts.default')
@section('content')
    <style>
        hr {
            border:0; height:2px; background-color:#FFAC12;
            color:#d4d4d4
        }
    </style>
    <script  type="text/javascript">
        function insert_c_value() {
            var form = document.getElementById("form_name");
            var country = form.Standard_search.value;
            var country_sp = country.split(",");
            document.getElementById("Standard_id").value=country_sp[0];
            document.getElementById("Cycle").value=country_sp[1];
        }
    </script>
    <?php
    use Illuminate\Support\Facades\Auth;
    $serverName = "163.17.9.113";
    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    date_default_timezone_set('Asia/Taipei');
    $no_key = date ("ms");?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><a href="{{ route('project.index') }}"><font color="gray">計畫管理&nbsp;</font></a><font color="gray" size="5"><span class="glyphicon glyphicon-menu-right"></span></font><font color="black">&nbsp;新增計畫</font></h2>
            </div>
        </div>
    </div><br><br><br>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open(array('route' => 'project.store','method'=>'POST','id'=>'form_name')) !!}
    <strong><font color="#FFAC12" size="5">計 畫 資 料</font></strong>
    <HR><br>
    <input type="hidden" name="Project_No" class="form-control" value="<?php echo $no_key.Auth::user()->id?>" readonly>
    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong><font color="#FF0000">* </font>計畫名稱:</strong>
            {!! Form::text('Project_name', null, array('placeholder' => '計畫名稱','class' => 'form-control')) !!}
        </div>
    </div>
          <br><br><br><br>
    <strong><font color="#FFAC12" size="5">規 範 資 料</font></strong>
    <HR><br>
    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <strong><font color="#FF0000">* </font>校驗方式:</strong>
            <select name="Check_method" id="Check_method" class="form-control">
                <option  value="內校">內校</option>
                <option  value="外校">外校</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong><font color="#FF0000">* </font>規範:</strong>
                <select name="Standard_search" id="Standard_search" class="form-control" onclick="insert_c_value()">
                    <?php
                    $sql="select Standard_id,Standard_name,Cycle_R from DB_Standard";
                    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                    while($row=sqlsrv_fetch_array($result)){ ?>
                    <option value='<?php echo $row[0]?>,<?php echo $row[2]?>'><?php echo $row[1]?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    <input type="hidden" name="Standard_id" id="Standard_id">
    <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong><font color="#FF0000">* </font>週期:</strong>
                <input type="number" name="Cycle" id="Cycle" min="1" max="20" class="form-control" placeholder="週期 (1~20)" readonly>
            </div>
        </div>
    <input type="hidden" name="Create_id" class="form-control" value="<?php echo Auth::user()->id?>" readonly>
    <?php
    date_default_timezone_set('Asia/Taipei');
    $datetime = date ("Y-m-d H:i:s");?>
    <input type="hidden" name="Create_time" value=<?php echo $datetime;?>>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br><br>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
                <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
                <a href="{{ route('project.index') }}" class="btn btn-warning"><span class="glyphicon glyphicon-log-out"></span> 返回</a>
           </div>
    {!! Form::close() !!}

@endsection