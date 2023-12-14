<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Đăng nhập Admin - PT Fruit</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/client/img/ico-logo.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('public/server/css/admin.min.css')}}" rel="stylesheet">
</head>
<body class="bg-body">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-10 col-lg-12 col-md-9 mt-5">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-grape mb-4">Đăng nhập Vào Admin</h1>
                                    </div>
                                    <form class="user" action="{{URL('/admin/dang-nhap-auth')}}" autocomplete="off" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập email đăng nhập!"
                                            name="admin_email" class="form-control form-control-user" placeholder="Email đăng nhập...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập mật khẩu!"
                                            name="admin_password" class="form-control form-control-user" placeholder="Mật khẩu...">
                                        </div>
                                       
                                        @foreach($errors->all() as $error)
                                            <strong style="color: red; font-size: 12px;">{{$error}}</strong><br>
                                        @endforeach
                                        <strong style="color: red; font-size: 12px;">
                                            @php
                                            use Illuminate\Support\Facades\Session;
                                            $message = Session::get('message');
                                            if ($message) {
                                                echo $message;
                                                Session::put('message', null);
                                            }
                                            @endphp
                                        </strong>
                                        <button type="submit" class="btn btn-grape btn-user btn-block">Đăng nhập</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="">Quên mật khẩu?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

    <!-- Form validator -->
    <script src="{{asset('public/server/js/jquery.form-validator.min.js')}}"></script>
    <script type="text/javascript">
        $.validate({

        });
    </script>
</body>
</html>