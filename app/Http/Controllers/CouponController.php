<?php

namespace App\Http\Controllers;

use App\Models\CouponModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
session_start();

class CouponController extends Controller {

    public function AuthLogin() { //Kiểm tra đăng nhập Admin

        $admin_id = Auth::id();
        if($admin_id) {
            return redirect('admin');
        } else {
            return redirect('admin/dang-nhap')->send();
        }
    }

    public function add_coupon() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        return view('admin.coupon.add_coupon');
    }

    public function list_coupon() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $coupon = CouponModel::orderBy('coupon_id', 'desc')->get();
        return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }

    public function save_coupon(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = $request->all();
        $coupon = new CouponModel;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->save();
        
        Session::put('message', 'Thêm mã giảm giá thành công!');
        return redirect('/admin/danh-sach-ma-giam-gia');
    }

    public function delete_coupon($coupon_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin
        
        $coupon = CouponModel::find($coupon_id);
        $coupon->delete();
        Session::put('message', 'Đã xóa mã giảm giá thành công!');
        return redirect('/admin/danh-sach-ma-giam-gia');
    }
}
