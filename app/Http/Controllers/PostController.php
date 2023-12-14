<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use App\Models\CatePostModel;
use App\Models\CategoriesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
session_start();

class PostController extends Controller {

    public function AuthLogin() { //Kiểm tra đăng nhập Admin

        $admin_id = Auth::id();
        if($admin_id) {
            return redirect('admin');
        } else {
            return redirect('admin/dang-nhap')->send();
        }
    }
// ------------------------------ SERVER -----------------------------

    public function list_category_post() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $category_post = CatePostModel::orderby('cate_post_id', 'desc')->get();
        return view('admin.post.list_cate_post')->with(compact('category_post'));
    }

    public function add_post() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $category_post = CatePostModel::orderby('cate_post_id', 'desc')->get();
        return view('admin.post.add_post')->with(compact('category_post'));
    }

    public function save_post(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = $request->all();
        $post = new PostModel();
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_status = $data['post_status'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $post->created_at = now();

        $get_image = $request->file('post_image');
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên hình ảnh
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post', $new_image);
            $post->post_image = $new_image;
            $post->save();
            Session::put('message', 'Thêm bài viết thành công!');
            return redirect('/admin/danh-sach-bai-viet');
        } else {
            Session::put('message', 'Vui lòng thêm hình ảnh!');
            return redirect()->back();
        }
    }

    public function list_post() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $list_post = PostModel::with('cate_post')->orderby('post_id', 'desc')->get();
        return view('admin.post.list_post')->with(compact('list_post'));
    }

    public function delete_post($post_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $post = PostModel::find($post_id);
        $post_image = $post->post_image;
        if($post_image) {
            $path = 'public/uploads/post/'.$post_image;
            unlink($path);
        }
        $post->delete();

        Session::put('message', 'Đã xóa bài viết!');
        return redirect()->back();
    }

    public function edit_post($post_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $cate_post = CatePostModel::orderby('cate_post_id')->get();
        $post = PostModel::find($post_id);

        return view('admin.post.edit_post')->with(compact('cate_post', 'post'));
    }
    
    public function update_post(Request $request, $post_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = $request->all();
        $post = PostModel::find($post_id);
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');
        if($get_image) {
            // Xóa ảnh cũ
            $post_image_old = $post->post_image;
            $path = 'public/uploads/post/'.$post_image_old;
            unlink($path);
            // Cập nhật ảnh mới
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên hình ảnh
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post', $new_image);
            $post->post_image = $new_image;
        }
        $post->save();
        Session::put('message', 'Cập nhật bài viết thành công!');
        return redirect('/admin/danh-sach-bai-viet');
    }
    
    // ------------------------------ CLIENT ------------------------------

    public function show_category_post(Request $request, $post_slug) {

        $category_product = CategoriesModel::where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $category_post = CatePostModel::orderby('cate_post_id', 'desc')->get();
        $cate_post = CatePostModel::where('cate_post_slug', $post_slug)->take(1)->get(); 
        foreach($cate_post as $key => $cate) {
            // SEO
            $meta_desc = $cate->cate_post_name;
            $meta_keywords = $cate->cate_post_name;
            $meta_title = $cate->cate_post_name;
            $cate_id = $cate->cate_post_id;
            $url_canonical = $request->url();
            // END SEO
        }
        $post = PostModel::with('cate_post')->where('post_status', 0)->where('cate_post_id', $cate_id)->paginate(20);

        return view('pages.post.category_post')->with(compact('category_product', 'category_post', 'cate_post', 'post',
        'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
    }

    public function show_post(Request $request, $post_slug) {
        $category_product = CategoriesModel::where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $category_post = CatePostModel::orderby('cate_post_id', 'desc')->get();
        $post = PostModel::with('cate_post')->where('post_status', 0)->where('post_slug', $post_slug)->take(1)->get();
        foreach($post as $key => $pos) {
            // SEO
            $meta_desc = $pos->post_desc;
            $meta_keywords = $pos->post_title;
            $meta_title = $pos->post_title;
            $cate_post_id = $pos->cate_post_id;
            $url_canonical = $request->url();
            // END SEO
        }

        $post_relate = PostModel::with('cate_post')->where('post_status', 0)->where('cate_post_id', $cate_post_id)
        ->whereNotIn('post_slug', [$post_slug])->take(5)->get();
        return view('pages.post.show_post')->with(compact('category_product', 'category_post', 'post', 'post_relate',
        'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
    }

}
