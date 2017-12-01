<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>檢驗儀器校驗管理系統</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/style.css">


</head>



<body>

<!-- Mixins-->
<!-- Pen Title-->
<div class="pen-title">
    <h1>檢 驗 儀 器 校 驗 管 理 系 統</h1>
    @if ($errors->has('Account_number'))
        <span  style="color:red" >
                        <font size="5px">
                            <strong>{{ $errors->first('Account_number') }}</strong>
                        </font>
                    </span>
    @endif
    {{--<span>Pen <i class='fa fa-code'></i> by <a href='#'>Xiu En</a></span>--}}
</div>

<div class="rerun"><a href="">Rerun Pen</a></div>

<div class="container">
    <div class="card"></div>
    <div class="card">
        <h1 class="title">登入</h1>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="input-container{{ $errors->has('Account_number') ? ' has-error' : '' }}">
                <input type="#{type}" id="Account_number" name="Account_number" value="{{ old('Account_number') }}" required="required" autofocus />　　　
                <label for="#{label}">帳號</label>
                <div class="bar"></div>
            </div>
            <div class="input-container {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" id="password" name="password" required="required"/>
                <label for="#{label}">密碼</label>
                @if ($errors->has('password'))
                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
                <div class="bar"></div>
            </div>
            <div class="button-container">
                <button type="submit"><span>Go</span></button>
            </div>
            {{--<div class="footer"><a href={{ route('password.request') }}>忘記密碼?</a></div>--}}
        </form>
    </div>
    <div class="card alt">
        <div class="bg" ></div>
        {{--<h1 class="title">Register--}}
            <div class="close"></div>
        {{--</h1>--}}
            {{--<div class="input-container">--}}
                {{--<label for="#{label}">Username</label>--}}
                {{--<input type="#{type}" id="#{label}" required="required"/>--}}
                {{--<div class="bar"></div>--}}
            {{--</div>--}}
            {{--<div class="input-container">--}}
                {{--<input type="#{type}" id="#{label}" required="required"/>--}}
                {{--<label for="#{label}">Password</label>--}}
                {{--<div class="bar"></div>--}}
            {{--</div>--}}
            {{--<div class="input-container">--}}
                {{--<input type="#{type}" id="#{label}" required="required"/>--}}
                {{--<label for="#{label}">Repeat Password</label>--}}
                {{--<div class="bar"></div>--}}
            {{--</div>--}}
            {{--<div class="button-container">--}}
                {{--<button><span>Next</span></button>--}}
            {{--</div>--}}
    </div>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>

</body>
</html>
