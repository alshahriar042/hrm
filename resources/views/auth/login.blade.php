<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>HR Management</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" type="text/css">

</head>

<body>

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="home-btn d-none d-sm-block">
        {{-- <a href="#" class="text-white"><i class="fas fa-home h2"></i></a> --}}
    </div>
    <div class="wrapper-page">
        <div class="card card-pages shadow-none">

            <div class="card-body">
                <div class="text-center m-t-0 m-b-15">
                    <a href="#" class="logo logo-admin"><img src="https://nextgenitltd.com/assets/media/logo.png"
                            alt="" height="24"></a>
                </div>
                <h5 class="font-18 text-center">Welcome Back!</h5>

                <form class="form-horizontal m-t-30" action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <div class="col-12">
                            <label>Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Enter email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Password</label>
                            <input type="password" name="password" required=""
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <div class="checkbox checkbox-primary">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember" value="1">
                                    <label class="custom-control-label" for="remember"> Remember me</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log
                                In</button>
                        </div>
                    </div>

                    <div class="form-group row m-t-30 m-b-0">
                        {{-- <div class="col-sm-7">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-muted">
                                    <i class="fa fa-lock m-r-5"></i>
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div> --}}
                        {{-- <div class="col-sm-5 text-right">
                            <a href="pages-register.html" class="text-muted">Create an account</a>
                        </div> --}}
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/assets/js/waves.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

</body>

</html>
