@extends('admin.layout')
@section('admin_content')
<h1 class="h3 mb-4 text-gray-800">Người dùng</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h5 class="col-md-6 m-0 font-weight-bold text-primary">Danh sách người dùng</h5>
            @hasrole('admin')
            <div style="text-align: right;" class="col-md-6">
                <a class="btn btn-grape" href="{{url('/admin/them-nguoi-dung')}}">Thêm người dùng</a>
            </div>
            @endhasrole
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <strong style="color: red; font-size: 14px;">
                @php
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if ($message) {
                    echo $message;
                    Session::put('message', null);
                }
                @endphp
            </strong>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th class="text-center">Admin</th>
                        <th class="text-center">Quản lý</th>
                        <th class="text-center">Nhân viên</th>
                        @hasrole('admin')
                        <th class="text-center">Thao tác</th>
                        @endhasrole
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($admin as $key => $user)
                        <tr></tr>
                        <form action="{{url('/admin/phan-quyen')}}" method="POST">
                            @csrf
                            <tr>
                                <td>{{$user->admin_name}}</td>
                                <td>
                                    {{$user->admin_user}}
                                    <input type="hidden" name="admin_email" value="{{ $user->admin_user }}"></td>
                                <td>{{$user->admin_phone}}</td>
                                <td class="text-center"><input type="checkbox" name="admin_role" {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                                <td class="text-center"><input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}}></td>
                                <td class="text-center"><input type="checkbox" name="user_role" {{$user->hasRole('user') ? 'checked' : ''}}></td>
                                @hasrole('admin')
                                <td class="text-center">
                                    <input type="submit" value="Cấp quyền" class="btn btn-sm btn-light mb-1">&ensp;
                                    <a href="{{url('/admin/xoa-nguoi-dung/'.$user->admin_id)}}" title="Xóa người dùng" onclick="return confirm('Bạn có chắn chắn xóa người dùng này không?')">
                                        <i style="font-size: 24px;" class="text-danger fas fa-trash-alt"></i>
                                    </a>
                                </td> 
                                @endhasrole
                            </tr>
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection