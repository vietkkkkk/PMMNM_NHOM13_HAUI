<?php

namespace App\Http\Controllers;

use App\Models\GalleryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
session_start();

class GalleryController extends Controller {

    public function AuthLogin() { //Kiểm tra đăng nhập Admin

        $admin_id = Auth::id();
        if($admin_id) {
            return redirect('admin');
        } else {
            return redirect('admin/dang-nhap')->send();
        }
    }

    public function add_gallery($product_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $pro_id = $product_id;
        return view('admin.gallery.add_gallery')->with(compact('pro_id'));
    }

    public function insert_gallery(Request $request, $pro_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $get_image = $request->file('file');
        if($get_image) {
            foreach($get_image as $image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move('public/uploads/gallery', $new_image);
                $data['product_image'] = $new_image;
                $gallery = new GalleryModel();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $pro_id;
                $gallery->save();
            }
        }
        
        Session::put('message', 'Thêm thư viện ảnh sản phẩm thành công!');
        return redirect()->back();
    }
    public function update_gallery_name(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = GalleryModel::find($gal_id);
        $gallery->gallery_name = $gal_text;
        $gallery->save();
    }

    public function delete_gallery(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $gal_id = $request->gal_id;
        $gallery = GalleryModel::find($gal_id);
        unlink('public/uploads/gallery/'.$gallery->gallery_image);
        $gallery->delete();
    }

    public function select_gallery(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin
        $product_id = $request->pro_id;
        $gallery = GalleryModel::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '<table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th style="width: 80px;" class="text-center px-0">Hình ảnh</th>
                                <th>Tên hình ảnh</th>
                                <th class="text-center px-0">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>';
        if($gallery_count > 0) {
            $i = 0;
            $output.='      <form>
                                '.csrf_field().'';
            foreach($gallery as $key => $gal) {
                $i++;
                    $output.='  <tr>
                                    <th class="text-center text-center-height">'.$i.'</th>
                                    <td class="text-center">
                                        <img width="100px" src="'.url('public/uploads/gallery/'.$gal->gallery_image).'" alt="'.$gal->gallery_name.'">
                                    </td>
                                    <td contenteditable class="text-center-height edit_gal_name" data-gal_id="'.$gal->gallery_id.'">'.$gal->gallery_name.'</td>
                                    <td class="text-center text-center-height">
                                        <button type="button" data-gal_id="'.$gal->gallery_id.'" class="btn btn-danger mb-1 delete_gallery"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>';
            }
            $output.='      </form>';
        } else {
            $output.='      <tr>
                                <td colspan="4" style="text-align: center;">Sản phẩm này chưa có ảnh</td>
                            </tr>';
        }
        $output.='      </tbody>
                    </table>';
        echo $output;
    }
}
