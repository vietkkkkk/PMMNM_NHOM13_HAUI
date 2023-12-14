<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use App\Models\ContactModel;
use App\Models\CatePostModel;
use App\Models\CategoriesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
session_start();

class ContactController extends Controller {

    public function AuthLogin() { //Kiểm tra đăng nhập Admin

        $admin_id = Auth::id();
        if($admin_id) {
            return redirect('admin');
        } else {
            return redirect('admin/dang-nhap')->send();
        }
    }

    public function contact(Request $request) {

        // SEO
        $meta_keywords = "trai cay mien tay, trái cây miền tây, trái cây";
        $meta_title = "Liên hệ PT Fruit - Thương hiệu trái cây miền Tây số 1 Việt Nam";
        $meta_desc = "Đơn vị chuyên phân phối sỉ và lẻ trái cây miền Tây với chất lượng và giá cả tốt nhất thị trường";
        $url_canonical = $request->url();
        // END SEO
        
        $category_post = CatePostModel::orderby('cate_post_id', 'desc')->get();
        $category_product = CategoriesModel::where('category_status', '1')->orderBy('category_name', 'asc')->get();

        return view('pages.contact')->with(compact('meta_keywords', 'meta_title', 'meta_desc', 'url_canonical',
        'category_product', 'category_post'));
    }

    public function information() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        return view('admin.contact.add_information');
    }
    
}
