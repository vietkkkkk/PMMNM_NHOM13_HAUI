<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Đăng nhập - PT Fruit</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{('public/client/img/ico-logo.ico')}}">
    <link href="{{asset('public/server/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('public/server/css/admin.min.css')}}" rel="stylesheet">
</head>
<body class="bg-body">
    <div class="container-fluid">
        <div class="row justify-content-center mt-3">
            <div class="col-xl-10 col-lg-12 col-md-10">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div style="background-color: #e7f8cf; position: relative;" class="col-lg-7 d-none d-lg-block">
                                <img style="width: 97%; position: absolute; bottom: 0;" src="{{url('/public/server/img/bg-login.png')}}">
                            </div>
                            <div class="col-lg-5">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-grape mb-4">Đăng nhập</h1>
                                    </div>
                                    <form class="user" action="{{url('/dang-nhap-khach-hang')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập Email đăng nhập!"
                                            name="email_account" class="form-control form-control-user" placeholder="Email đăng nhập...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập mật khẩu!"
                                            name="password_account" class="form-control form-control-user" placeholder="Mật khẩu...">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ghi nhớ đăng nhập</label>
                                            </div>
                                        </div>
                             
                                        @foreach($errors->all() as $error)
                                            <strong style="color: red; font-size: 12px;">{{$error}}</strong><br>
                                        @endforeach
                                        <strong style="color: red; font-size: 12px;">
                                            <?php
                                            use Illuminate\Support\Facades\Session;
                                            $message = Session::get('message');
                                            if ($message) {
                                                echo $message;
                                                Session::put('message', null);
                                            }
                                            ?>
                                        </strong>
                                        <button type="submit" class="btn btn-grape btn-user btn-block">Đăng nhập</button>
                                        <hr>
                                        <a href="" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Đăng nhập với Google
                                        </a>
                                        <a href="" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng nhập với Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="">Quên mật khẩu?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{url('/dang-ky')}}">Tạo tài khoản mới!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('public/server/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/server/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/server/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('public/server/js/sb-admin-2.min.js')}}"></script>

    <!-- Re Capcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Form validator -->
    <script src="{{asset('public/server/js/jquery.form-validator.min.js')}}"></script>
    <script type="text/javascript">
        $.validate({

        });
    </script>
</body>
</html>