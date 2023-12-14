@extends('admin.layout')
@section('admin_content')
<h1 class="h3 mb-4 text-gray-800">Người dùng</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Thêm người dùng</h5>
    </div>
    <div class="card-body">
        <div class="col-lg-8 m-auto p-5">
            <div class="text-center">
                <h1 class="h4 mb-4"><strong>Thêm người dùng</strong></h1>
            </div>
            <form class="user" action="{{url('/admin/luu-nguoi-dung')}}" method="post">
                @csrf
                <div class="form-group">
                    <label><strong>Tên người dùng</strong></label>
                    <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tên tài khoản!"
                    class="form-control form-control-user" name="admin_name" placeholder="Tên tài khoản...">
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label><strong>Email</strong></label>
                        <input type="email" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập Email đăng nhập!"
                        class="form-control form-control-user" name="admin_email" placeholder="Email...">
                    </div>
                    <div class="col-sm-6">
                        <label><strong>Số điện thoại</strong></label>
                        <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Vui lòng nhập số điện thoại!"
                        class="form-control form-control-user" name="admin_phone" placeholder="Số điện thoại...">
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>Mật khẩu đăng nhập</strong></label>
                    <input type="password" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập mật khẩu!"
                    class="form-control form-control-user" name="admin_password" placeholder="Mật khẩu...">
                </div>
                <button type="submit" class="btn btn-grape btn-user btn-block">Thêm người dùng</button>
            </form>
        </div>
    </div>
</div>
@endsection