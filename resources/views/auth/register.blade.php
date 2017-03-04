<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIS | Register</title>

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

        <h3>Register</h3>
        <p>Create your account!</p>
            
        <form class="m-t" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" 
                        name="name"
                        class="form-control" 
                        placeholder="Name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus>
                @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email"
                        value="{{ old('email') }}" 
                        required>

            @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" 
                        class="form-control"
                        name="password"
                        placeholder="Password"
                        required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" 
                        class="form-control" 
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        required>
            </div>

            <!-- Hide For the now
            <div class="form-group">
                <div class="checkbox i-checks">
                    <label>
                        <input type="checkbox">
                        <i></i>Agree the terms and policy
                    </label>
                </div>
            </div>
            -->

            <button type="submit" class="btn btn-primary block full-width m-b">
                Register
            </button>

            <p class="text-muted text-center">
                <small>Already have an account?</small>
            </p>

            <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Login</a>
        </form>
        
        <p class="m-t">
            <small>Schoo Information System &copy; 2017</small>
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
