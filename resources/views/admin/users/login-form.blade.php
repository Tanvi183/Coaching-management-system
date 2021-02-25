<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coaching | Login Form</title>
    <!--    Font Awesome Stylesheet-->
    <link rel="stylesheet" href="{{ asset('/public/admin/fonts/fa/css/all.min.css') }}">
    <!--    Animate CSS-->
    <link rel="stylesheet" href="{{ asset('/public/admin/css/bootstrap.min.css') }}">
    <!--    Theme Stylesheet-->
    <link rel="stylesheet" href="{{ asset('/public/admin/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('/public/images/favicon.png') }}" type="image/x-icon">
</head>
<body>

<!--Content Start-->
<section class="container-fluid">
    <div class="row content login-form">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Admin Login Form</h4>
                </div>
            </div>

            <form action="{{ route('login') }}" method="post" enctype="multipart/form-data" autocomplete="off" class="form-inline">
                  @csrf

                <div class="form-group col-12 mb-3">
                    <label for="fatherMobile" class="col-sm-3 col-form-label text-right">Mobile No.</label>

                    <input id="fatherMobile" type="text" name="mobile" placeholder="Mobile Number" class="form-control col-sm-9 @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" required autocomplete="mobile" minlength="8" autofocus>
                    <span class="text-danger"></span>

                    @error('mobile')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label for="password" class="col-sm-3 col-form-label text-right">Password</label>
                    <div class="input-group col-sm-9 pl-0 pr-0">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="passwordToggle"><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <span class="text-danger"></span>
                     @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                     @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label class="col-sm-3"></label>
                    <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!--Content End-->

<script src="{{asset('/public/admin/js/jquery-3.3.1.slim.min.js')}}"></script>
<script src="{{asset('/public/admin/js/script.js')}}"></script>
</body>
</html>