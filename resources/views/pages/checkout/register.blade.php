<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Đăng ký tài khoản - PT Fruit</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{('public/client/img/ico-logo.ico')}}">
    <link href="{{asset('public/server/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('public/server/css/admin.min.css')}}" rel="stylesheet">
</head>
<body class="bg-body">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đăng ký tài khoản</h1>
                            </div>
                            <form class="user" action="{{url('/them-khach-hang')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tên tài khoản!"
                                    class="form-control form-control-user" name="customer_name" placeholder="Tên tài khoản...">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập Email đăng nhập!"
                                        class="form-control form-control-user" name="customer_email" placeholder="Email đăng nhập...">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Vui lòng nhập số điện thoại!"
                                        class="form-control form-control-user" name="customer_phone" placeholder="Số điện thoại...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập mật khẩu!"
                                    class="form-control form-control-user" name="customer_password" placeholder="Mật khẩu...">
                                </div>
                           
                                @foreach($errors->all() as $error)
                                    <strong style="color: red; font-size: 12px;">{{$error}}</strong><br>
                                @endforeach
                                <button type="submit" class="btn btn-grape btn-user btn-block">Đăng ký</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{url('/dang-nhap')}}">Bạn đã có tài khoản? Đăng nhập ngay!</a>
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

    

    <!-- Form validator -->
    <script src="{{asset('public/server/js/jquery.form-validator.min.js')}}"></script>
    <script type="text/javascript">
        $.validate({

        });
    </script>
</body>
</html>