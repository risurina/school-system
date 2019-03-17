<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIS | Login</title>

    <link href="{{ URL::to('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name" style="font-size: 40px;">&nbsp;</h1>
        </div>

        <h3>Login</h3>
        <p>Please login to start!</p>
            
        <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" 
                            type="email" 
                            class="form-control" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required autofocus
                            placeholder="Email" 
                    >

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" 
                            type="password" 
                            class="form-control" 
                            name="password" 
                            required
                            placeholder="Password" >

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row">

                    <div class="col-xs-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                        </div>
                    </div>

                    <!--
                    <div class="col-xs-6">
                        <a class="btn btn-white btn-block" href="{{ route('login.employee') }}">
                            Log as employee
                        </a>
                    </div>

                    <div class="col-xs-6">
                        <a class="btn btn-white btn-block" href="{{ route('login.student') }}">
                            Log as student
                        </a>
                    </div>

                    <div class="col-xs-12">
                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Create an account</a>
                    </div>
                    -->
                </div>
        </form>
        
        <p class="m-t">
            <small>Izkul - Attendance System</small>
        </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{ URL::to('assets/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ URL::to('assets/js/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>

</body>
</html>
