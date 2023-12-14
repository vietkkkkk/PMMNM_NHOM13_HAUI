<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CommentModel;
use App\Models\GalleryModel;
use App\Models\CatePostModel;
use App\Models\CategoriesModel;
use App\Models\RatingModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
session_start();

class ProductController extends Controller {
    
    public function AuthLogin() { //Kiểm tra đăng nhập Admin

        $admin_id = Auth::id();
        if($admin_id) {
            return redirect('admin');
        } else {
            return redirect('admin/dang-nhap')->send();
        }
    }

    public function list_comment() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $comment = CommentModel::with('product')->where('comment_parent_comment', NULL)->orderby('comment_date', 'desc')->get();
        $comment_reply = CommentModel::with('product')->orderby('comment_date', 'desc')->get();
        return view('admin.comment.list_comment')->with(compact('comment', 'comment_reply'));
    }

    public function send_comment(Request $request) {
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new CommentModel();
        $comment-> comment_product_id = $product_id;
        $comment-> comment = $comment_content;
        $comment-> comment_name = $comment_name;
        $comment->comment_status = 0;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $comment->comment_date = now();
        $comment->save();

    }

    public function load_comment(Request $request) {

        $product_id = $request->product_id;
        $comment = CommentModel::where('comment_product_id', $product_id)->where('comment_status', 0)->get();
        $comment_reply = CommentModel::where('comment_product_id', $product_id)->where('comment_status', 2)->get();
        $output ='';
        foreach($comment as $key => $comm) {
            $output.=' 
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-1">
                        <img src="'.url('public/client/img/avatar.png').'" width="40" alt="Avatar">
                    </div>
                    <div class="col-sm-12 bg-light box-comment col-md-10 align-self-center p-2">
                        <div class="text-grape"><strong>@'.$comm->comment_name.'</strong>&emsp;<span class="small">'.$comm->comment_date.'</span></div>
                        '.$comm->comment.'
                    </div>
                </div>';
            foreach($comment_reply as $key => $rep_comment) {
                if($rep_comment->comment_parent_comment == $comm->comment_id) {
                $output.='<div style="margin-left: 40px;" class="row mb-2">
                    <div class="col-sm-12 col-md-1">
                        <img src="'.url('public/client/img/logo-image.png').'" width="40" alt="Avatar">
                    </div>
                    <div class="col-sm-12 bg-light box-comment col-md-10 align-self-center p-2">
                        <div class="text-grape"><strong>@Admin PT Fruit</strong>&emsp;<span class="small">'.$rep_comment->comment_date.'</span></div>
                        '.$rep_comment->comment.'
                    </div>
                </div>';
                }
            }
        }
        echo $output;
    }

    public function hide_comment($comment_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        CommentModel::where('comment_id', $comment_id)->update(['comment_status'=>1]);
        Session::put('message', 'Đã ẩn bình luận!');
        return redirect()->back();
    }

    public function shows_comment($comment_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        CommentModel::where('comment_id', $comment_id)->update(['comment_status'=>0]);
        Session::put('message', 'Đã hiển thị bình luận!');
        return redirect()->back();
    }

    public function reply_comment(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = $request->all();
        $comment = new CommentModel();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_name = 'Admin PT Fruit';
        $comment->comment_status = 2;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $comment->comment_date = now();
        $comment->save();
    }

    public function add_product() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $cate_product = CategoriesModel::orderBy('category_id', 'desc')->get();
        return view('admin.product.add_product')->with(compact('cate_product'));

    }

    public function list_product() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $list_product = ProductModel::with('category_product')->orderBy('product_id', 'desc')->get();
        return view('admin.product.list_product')->with(compact('list_product'));
    }

    public function save_product(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->product_cate;
        $data['product_image'] = $request->product_image;
        $data['product_price'] = $request->product_price;
        $data['product_keywords'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_origin'] = $request->product_origin;
        $data['product_unit'] = $request->product_unit;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';

        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            File::copy($path.$new_image, $path_gallery.$new_image);
            $data['product_image'] = $new_image;
        }
        $pro_id = ProductModel::insertGetId($data);
        $gallery = new GalleryModel();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id= $pro_id;
        $gallery->save();
        Session::put('message', 'Thêm sản phẩm thành công!');
        return redirect('/admin/danh-sach-san-pham');
        
    }

    public function unactive_product($product_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        ProductModel::where('product_id', $product_id)->update(['product_status'=>1]);
        Session::put('message', 'Đã hiển thị sản phẩm!');
        return redirect()->back();
    }

    public function active_product($product_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        ProductModel::where('product_id', $product_id)->update(['product_status'=>0]);
        Session::put('message', 'Đã ẩn sản phẩm này!');
        return redirect()->back();
    }

    public function edit_product($product_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $cate_product = CategoriesModel::orderBy('category_id', 'desc')->get();
        $edit_product = ProductModel::where('product_id', $product_id)->get();
        $manager_product = view('admin.product.edit_product')->with(compact('edit_product', 'cate_product'));
        
        return view('admin.layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->product_cate;
        $data['product_image'] = $request->product_image;
        $data['product_price'] = $request->product_price;
        $data['product_keywords'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_origin'] = $request->product_origin;
        $data['product_unit'] = $request->product_unit;
        $get_image = $request->file('product_image');

        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            ProductModel::where('product_id', $product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công!');
            return redirect('/admin/danh-sach-san-pham');
        }
        ProductModel::where('product_id', $product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công!');
        return redirect('/admin/danh-sach-san-pham');
    }

    public function delete_product($product_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $product = ProductModel::find($product_id);
        $product_image = $product->product_image;
        if($product_image) {
            $path = 'public/uploads/product/'.$product_image;
            unlink($path);
        }
        $product->delete();

        Session::put('message', 'Đã xóa sản phẩm thành công!');
        return redirect()->back();
    }

    public function details_product(Request $request, $product_id) {
        
        $category_product = CategoriesModel::where('category_status', '1')->orderBy('category_name', 'asc')->get();
        $category_post = CatePostModel::orderby('cate_post_id', 'desc')->get();
        $product_details = ProductModel::with('category_product')->where('product_id', $product_id)->get();
        
        
        foreach($product_details as $key => $value) {
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            // SEO
            $meta_desc = $value->product_desc;
            $meta_keywords = $value->product_keywords;
            $meta_title = $value->product_name;
            $url_canonical = $request->url();
            // END SEO
        }
        $gallery = GalleryModel::where('product_id', $product_id)->orderby('gallery_id', 'desc')->get();

        $relate = ProductModel::with('category_product')->where('category_id', $category_id)
        ->whereNotIn('product.product_id', [$product_id])->get();

        return view('pages.product.show_details')->with(compact('category_product', 'category_post', 'product_details',
        'relate', 'gallery', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
    }

    public function insert_rating(Request $request) {

        $data = $request->all();
        $rating = new RatingModel();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }

    public function file_browser() {
        $paths = glob(public_path('uploads/ckeditor/*'));
        $filesNames = array();
        foreach($paths as $path) {
            array_push($filesNames, basename($path));
        }
        $data = array(
            'fileNames' => $filesNames
        );
        return view('admin.images.file_browser')->with($data);
    }

    public function ckeditor_image(Request $request) {

        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $filesName = pathinfo($originName, PATHINFO_FILENAME); // Lấy tên hình ảnh
            $extension = $request->file('upload')->getClientOriginalExtension(); // Lấy đuôi mở rộng hình ảnh
            $filesName = $filesName.'_'.time().'.'.$extension; // Thêm time vào tên hình ảnh để tránh trùng tên và nối với đuôi hình ảnh
            $request->file('upload')->move('public/uploads/ckeditor', $filesName); // Upload vào thu mục ckeditor

            $CKEditorFuncNum = $request->input('CKEditorFuncNum'); //Trả $url về đường dẫn URL 
            $url = asset('public/uploads/ckeditor/'.$filesName);
            $msg = 'Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
