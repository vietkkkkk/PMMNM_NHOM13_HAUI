<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\RolesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller {

    public function AuthLogin() { //Kiểm tra đăng nhập Admin

        $admin_id = Auth::id();
        if($admin_id) {
            return redirect('admin');
        } else {
            return redirect('admin/dang-nhap')->send();
        }
    }

    public function index() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $admin = AdminModel::with('roles')->orderby('admin_id', 'desc')->get();
        return view('admin.users.list_user')->with(compact('admin'));
    }

    public function add_user() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        return view('admin.users.add_user');
    }

    public function assign_roles(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập

        $user = AdminModel::where('admin_user', $request->admin_email)->first();
        $user->roles()->detach(); // Gỡ các quyền đang có

        if($request->author_role) { // Nếu có check vào quyền author
            $user->roles()->attach(RolesModel::where('name', 'author')->first()); //Thì cấp cho người dùng này quyền author
        }
        if($request->user_role) { // Nếu có check vào quyền user
            $user->roles()->attach(RolesModel::where('name', 'user')->first()); //Thì cấp cho người dùng này quyền admin
        }
        if($request->admin_role) { // Nếu có check vào quyền admin
            $user->roles()->attach(RolesModel::where('name', 'admin')->first()); //Thì cấp cho người dùng này quyền admin
        }
        return redirect()->back()->with('message', 'Cấp quyền cho người dùng thành công!');
    }

    public function store_users(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = $request->all();
        $admin = new AdminModel();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_user = $data['admin_email'];
        $admin->admin_password = $data['admin_password'];
        $admin->save();
        $admin->roles()->attach(RolesModel::where('name', 'user')->first());
        Session::put('message', 'Thêm người dùng thành công!');
        return redirect('/admin/nguoi-dung');
    }

    public function delete_user_roles($admin_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập

        if(Auth::id() == $admin_id) {
            return redirect()->back()->with('message', 'Cảnh báo!! Bạn không được xóa chính mình');
        }
        $admin = AdminModel::find($admin_id);
        if($admin) {
            $admin->roles()->detach();
            $admin->delete();
        }
        return redirect()->back()->with('message', 'Đã xóa người dùng!');
    }

    public function users_transfer($admin_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $user = AdminModel::where('admin_id', $admin_id)->first();
        if($user) {
            session()->put('users_transfer', $user->admin_id);
        }
        return redirect('/admin/nguoi-dung');
    }

    public function users_transfer_destroy() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        session()->forget('users_transfer');
        return redirect('/admin/nguoi-dung');
    }
}
