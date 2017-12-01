<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>儀器校驗管理系統</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="{{ asset('css/default.css') }}" rel="stylesheet">
</head>

<body>
<div id="wrapper">
    <div class="overlay"></div>
    <nav class="nav navbar-default" style="background-color: #1a1a1a;">
        <div class="container-fluid" >
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                    @else
                        <li>
                            <a href="#"  data-toggle="dropdown" role="button" aria-expanded="false">
                                <h4><font color="#f0f8ff"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;{{ Auth::user()->Member_name }}</font></h4>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">登出</a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">

<FONT color="white">

    <?php
    use Illuminate\Support\Facades\Auth;
    $user=Auth::user()->id;     //
    $serverName = "163.17.9.113";
    $connectionInfo = array( "Database"=>"cc", "UID"=>"sa", "PWD"=>"s10314161", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    // 登入資料庫
    // (1) 先抓出登入者所屬 Group ID => 放在 $array_gp[0]
    $sql="select DISTINCT c.Main_function_name,b.Minor_function_name,b.Minor_function_program,c.icon
FROM DB_Access a,DB_Minor_function_list b,DB_Main_function_list c,DB_Group_personnel d,DB_Group e
where  b.Minor_function_id=a.Minor_function_id and c.Main_function_id=b.Main_function_id and a.Group_id=d.Group_id and d.id=".$user." and e.Status=1
order by c.Main_function_name";
    $array_access[][]=0; $x=0;
    $result=sqlsrv_query($conn,$sql)or die("sql error".sqlsrv_errors());
    while($row=sqlsrv_fetch_array($result)){
        //echo $row[0]."---".$row[1]."<br>";
        $array_access[$x][0]=$row[0];   // 主功能名稱
        $array_access[$x][1]=$row[1];   // 次功能名稱
        $array_access[$x][2]=$row[2];   // 功能路徑
        $array_access[$x][3]=$row[3];   // 主功能圖案
        $x++;
    }
    ?>
</font>

            <li class="sidebar-brand" name="home">
                <a href="{{route('home.index')}}"><span><img height="45" width="100" src="http://163.17.9.113/logo.png" /></span>&nbsp;&nbsp;</a>
            </li>

            <?php
                $check_key=0;  //  0=第一次
            for($i=0;$i<$x;$i++){
                if($check_key==0){ ?>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="<?php echo $array_access[$i][3];?>"></span>&nbsp;&nbsp;<font size="4"><?php echo $array_access[$i][0];?></font><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $array_access[$i][2]?>"><font size="4"><?php echo $array_access[$i][1]?></font></a></li><?php $check_key++;
                }else{
                        if($array_access[$i-1][0]==$array_access[$i][0]){ ?>
                    <li name="abc"><a href="<?php echo $array_access[$i][2]?>"><font size="4"><?php echo $array_access[$i][1]?></font></a></li> <?php
                        }else{ ?>
                </ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="<?php echo $array_access[$i][3];?>"></span>&nbsp;&nbsp;<font size="4"><?php echo $array_access[$i][0];?></font><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $array_access[$i][2]?>"><font size="4"><?php echo $array_access[$i][1]?></font></a></li><?php
                    }
                }
                if(($i+1)==$x){ ?>
                        </ul>
                    </li> <?php
                }
            }
            ?>
            <li class="dropdown">
                <a href="{{route('Parameter.index')}}"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;<font size="4">設 定</font></a>
            </li>


        </ul>
    </nav>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
            <span class="hamb-top"> </span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
    </div>

    <div class="container">
        @yield('content')
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="{{ asset('js/default.js') }}"></script>
</body>
</html>