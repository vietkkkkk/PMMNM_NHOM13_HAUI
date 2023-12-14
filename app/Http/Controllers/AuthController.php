<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    
    public function login_auth() {
        return view('admin.login');
    }

    public function login(Request $request) {

        $data = $request->validate([
            'g-recaptcha-response' => new Captcha(),
        ]);
        if(Auth::attempt(['admin_user' => $request->admin_email, 'admin_password' => $request->admin_password])) {
            return redirect('/admin');
        } else {
            return redirect('/admin/dang-nhap')
            ->with('message', 'Tên đăng nhập hoặc mật khẩu không chính xác!<br>Vui lòng kiểm tra lại!');
        }
    }

    public function logout() {
        
        Auth::logout();
        return redirect('/admin/dang-nhap');
    }
}
