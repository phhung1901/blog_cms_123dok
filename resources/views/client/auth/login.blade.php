<!DOCTYPE html>
<html lang="en">

@include("admin.inc.head")

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>User</b></a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    {!! \Session::get('error') !!}
                </div>
            @endif
            <form action="{{route("user.login.submit")}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        {{--                        <div class="icheck-primary">--}}
                        {{--                            <input type="checkbox" id="remember" name="remember">--}}
                        {{--                            <label for="remember">--}}
                        {{--                                Remember Me--}}
                        {{--                            </label>--}}
                        {{--                        </div>--}}
                    </div>

                    <div class="col-4">
                        <button name="submit" type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>

                </div>
            </form>
            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>

            <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="{{route("user.register.view")}}" class="text-center">Register a new membership</a>
            </p>
        </div>

    </div>
</div>

@include("admin.inc.script")

</body>
</html>
