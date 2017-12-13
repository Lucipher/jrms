<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | JRPoP</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('/favicon.ico')}}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <!-- <link href="/plugins/bootstrap/css/bootstrap.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ URL::asset('/plugins/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('/plugins/node-waves/waves.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('/plugins/animate-css/animate.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('/css/style.css')}}">

    <!-- Waves Effect Css -->
    <!-- <link href="/plugins/node-waves/waves.css" rel="stylesheet" /> -->

    <!-- Animation Css -->
    <!-- <link href="/plugins/animate-css/animate.css" rel="stylesheet" /> -->

    <!-- Custom Css -->
    <!-- <link href="/css/style.css" rel="stylesheet"> -->
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a><b>Jesus Redeems</b></a>
            <small>Management System</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="email" placeholder="E-mail Address" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>-->
                        <div class="col-xs-4 col-offset-xs-8">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <!--<div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>-->
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <!-- <script src="/plugins/jquery/jquery.min.js"></script> -->
    <script src="{{ URL::asset('/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('/plugins/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{ URL::asset('/plugins/node-waves/waves.js')}}"></script>
    <script src="{{ URL::asset('/plugins/jquery-validation/jquery.validate.js')}}"></script>
    <script src="{{ URL::asset('/js/admin.js')}}"></script>
    <script src="{{ URL::asset('/js/pages/examples/sign-in.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <!-- <script src="/plugins/bootstrap/js/bootstrap.js"></script> -->

    <!-- Waves Effect Plugin Js -->
    <!-- <script src="/plugins/node-waves/waves.js"></script> -->

    <!-- Validation Plugin Js -->
    <!-- <script src="/plugins/jquery-validation/jquery.validate.js"></script> -->

    <!-- Custom Js -->
    <!-- <script src="/js/admin.js"></script> -->
    <!-- <script src="/js/pages/examples/sign-in.js"></script> -->
</body>

</html>
