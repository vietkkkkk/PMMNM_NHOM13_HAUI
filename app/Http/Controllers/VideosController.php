<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideosModel;
use Illuminate\Support\Facades\Auth;

class VideosController extends Controller {

    public function AuthLogin() { //Kiểm tra đăng nhập Admin

        $admin_id = Auth::id();
        if($admin_id) {
            return redirect('admin');
        } else {
            return redirect('admin/dang-nhap')->send();
        }
    }
    public function list_video() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin
        return view('admin.videos.list_video');
    }

    public function insert_video(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = $request->all();
        $video = new VideosModel();
        $sub_link= substr($data['video_link'], 17);
        $video->video_title = $data['video_title'];
        $video->video_slug = $data['video_slug'];
        $video->video_link = $sub_link;

        $get_image = $request->file('file');
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/video_image', $new_image);
            $video->video_image = $new_image;
        }
        $video->save();
    }

    public function delete_video(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $video_id = $request->video_id;
        $video = VideosModel::find($video_id);
        unlink('public/uploads/video_image/'.$video->video_image);
        $video->delete();
    }

    public function select_video(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $video = VideosModel::orderby('video_id', 'desc')->get();
        $video_count = $video->count();
        $output = ' <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Video</th>
                            <th>Hình ảnh</th>
                            <th>Tên video</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>';
        if($video_count > 0) {
            $i = 0;
            foreach($video as $key => $vid) {
                $i++;
                $output.='
                        <tr>
                            <th class="text-center-height text-center">'.$i.'</th>
                            <td class="text-center-height">
                                <iframe width="200" height="120" src="https://www.youtube.com/embed/'.$vid->video_link.'"
                                    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
                                    encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                </iframe>
                            </td>
                            <td class="text-center-height text-center">
                                <img width="100px" src="'.url('public/uploads/video_image/'.$vid->video_image).'" alt="'.$vid->video_title.'">
                            </td>
                            <td class="text-center-height">'.$vid->video_title.'</td>
                            <td class="text-center-height text-center">
                                <button data-video_id="'.$vid->video_id.'" class="btn btn-sm delete_video">
                                    <i style="font-size: 24px;" class="text-danger fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>';
            }
        } else {
            $output.='      <tr>
                                <td colspan="4" style="text-align: center;">Ko có dữ liệu trong bảng</td>
                            </tr>';
        }
        $output.='  </tbody>';
        echo $output;
    }
}
