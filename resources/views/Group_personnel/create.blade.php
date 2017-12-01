@extends('layouts.default')
@section('content')
    <?php use Illuminate\Support\Facades\Auth;

    ?>


    <SCRIPT LANGUAGE="JavaScript" >

        var checkflag = "false";
        function check(fieldName)
        {
            var field=document.getElementsByName(fieldName);
            if (checkflag == "false" )
            {
                for (i = 0; i < field.length; i++)
                {
                    field[i].checked = true;


                }
                checkflag = "true"; return "Uncheck All";
            } else {
                for (i = 0; i < field.length; i++) {
                    field[i].checked = false;
                } checkflag = "false"; return "Check All"; }}

    </script>
    {{--JavaScript--}}


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <?php
                $serverName = "163.17.9.113\SQLEXPRESS";
                $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                $check = \Request::get('chk','');
                date_default_timezone_set('Asia/Taipei');
                $datetime = date ("Y-m-d H:i:s");
                if($check!='') {
                    for ( $i=0 ; $i<count($_GET['chk']) ; $i++ ) {
                        $sql="INSERT INTO DB_Group_personnel (Group_id,id,Create_id,Create_time) VALUES (".$_GET['g_id'].",".$_GET['chk'][$i].",".Auth::user()->id.",'".$datetime."')";
                        $query=sqlsrv_query($conn,$sql);
                    }

                    header("Location: /Group_personnel?g_id=".$_GET['g_id']."");
                    die();
                }

                $sql="select*from DB_Group where Group_id=".$_GET['g_id'];
                $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
                while($row=sqlsrv_fetch_array($result)){
                ?>
                <h2><a onclick="history.back()"> <font color="gray"> 群組人員管理</font></a> &raquo;  新增人員   &raquo; <?php echo  $row[2];    }?></h2>
            </div>
        </div>
    </div>
    <hr>

    {{--這是搜尋--}}

    <div class="col-md-12">
        <div class="input-group custom-search-form navbar-form navbar-left">
            <form action="create" method="GET">
            <select name="tag_group_personnel" id="tag_group_personnel" class="form-control">
                <option  value="id">人員編號</option>
                <option  value="Member_name">人員名稱</option>

            </select>

            <input type="text" name="search" class="form-control" placeholder="Search ...." size="15">
                <input type="hidden" name="g_id" id="g_id" value=<?php echo  $_GET['g_id'];?>>
                <button type="submit" class="form-control"><span class="glyphicon glyphicon-search"></span></button>
            </form>
        </div>
    </div>

    {{--這是搜尋--}}




    @if (count($errors) > 0)
        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="create" method="GET">
        <input type="hidden" name="g_id" id="g_id" value=<?php echo $_GET['g_id'];?>>

        <table class="table table-hover" >


            <?php
            $serverName = "163.17.9.113\SQLEXPRESS";
            $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            $t_p = \Request::get('tag_group_personnel','id');
            $search_p = \Request::get('search','');
            $sql_acc="select*from DB_Group_personnel";
            if($search_p!=''){
                $sql_acc="select*from DB_Group_personnel where ".$t_p." like '%".$search_p."%'";
            }
            $result=sqlsrv_query($conn,$sql_acc)or die("sql error".sqlsrv_errors());
            $q=0;	$array_acc[][]=0; $z=0;
            while($row=sqlsrv_fetch_array($result)){
                $array_acc[$q][2]=$row[2];
                $array_acc[$q][1]=$row[1];
                $bca[$z]= $row[2];


                $z++; ?>

            <?php  $q++;
            } ?>

        </table>

        <table class="table table-hover" >
            <tr>
                <th><input type=checkbox value="全選" onClick="this.value=check('chk[]')" ></th>
                <th>人員編號</th>
                <th>人員帳號</th>
                <th>人員名稱</th>
            </tr>

            <?php
            $serverName = "163.17.9.113\SQLEXPRESS";
            $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            $t_p = \Request::get('tag_group_personnel','id');
            $search_p = \Request::get('search','');
            $sql="select*from DB_Member";
            if($search_p!=''){
                $sql="select*from DB_Member where ".$t_p." like '%".$search_p."%'";
            }
            $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
            $x=0;	$array[][]=0; $y=0;
            while($row=sqlsrv_fetch_array($result)){
            $array[$x][0]=$row[0];
            $array[$x][1]=$row[1];
            $array[$x][3]=$row[3];
                $abc[$y]= $row[0];
                $y++;
                $x++;
            } ?>

            <?php
            for ( $i=0 ; $i<$y ; $i++ ) {
                $mo=0;
                for ($a=0;$a<$z;$a++){
                    if($array[$i][0]==$array_acc[$a][2]and $array_acc[$a][1]==$_GET['g_id']){
                        $mo=1;
                    }
                }
                if ($mo==0){
                    echo '<tr>';
                    echo '<td>';
                    echo '<input type="checkbox" value='.$array[$i][0].' name="chk[]" id="chk[]"  >';
                    echo '</td>';
                    echo '<td> '.$array[$i][0].' </td>';
                    echo '<td> '.$array[$i][1].' </td>';
                    echo '<td> '.$array[$i][3].' </td>';
                    echo '</tr>';
                }
            }
            ?>

        </table>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> 送出</button>
            <button type="reset" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> 重製</button>
            <a class="btn btn-warning"  onclick=history.back()><span class="glyphicon glyphicon-log-out"></span> 返回</a>
            <br><br>
        </div>

        </div>
    </form>

@endsection
