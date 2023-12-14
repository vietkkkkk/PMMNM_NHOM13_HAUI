<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
session_start();

class MessageController extends Controller {

    public function AuthLogin() { //Kiểm tra đăng nhập Admin

        $admin_id = Auth::id();
        if($admin_id) {
            return redirect('admin');
        } else {
            return redirect('admin/dang-nhap')->send();
        }
    }

    public function contact_with_us(Request $request) {
        $data = $request->all();
        $message = new MessageModel();
		$message->name_mess = $data['name_mess'];
		$message->phone_mess = $data['phone_mess'];
		$message->email_mess = $data['email_mess'];
		$message->content_mess = $data['content_mess'];
		$message->mess_status = 1;
		$message->save();
    }

    public function mess_with_us() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $message = MessageModel::whereNotIn('mess_status', [0])->orderby('mess_status', 'asc')->get();
        return view('admin.message.list_message')->with(compact('message'));
    }

    public function update_message($mess_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        MessageModel::where('mess_id', $mess_id)->update(['mess_status'=>3]);
        Session::put('message', 'Đã cập nhật thành công!');
        return redirect()->back();
    }

    public function send_mail($mess_id) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $sub_get_mail = MessageModel::where('mess_id', $mess_id)->get('email_mess');
        $cut = substr($sub_get_mail, 16);
        $get_mail = substr($cut, 0, -3);
        
        //send mail
        $to_name = "PT Fruit";
        $to_email = $get_mail;//send to this email

        $data = array("name"=>"Cảm ơn bạn đã liên hệ với chúng tôi!",
                    "body"=>'Chúng tôi sẽ liên hệ lại với bạn bằng số điện thoại bạn đã đăng ký để hỗ trợ cho bạn trong thời gian sớm nhất có thể!',
                    "thank"=>'PT Fruit kính chúc quý khách hàng thật nhiều sức khỏe!');
    
        Mail::send('admin.message.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Phản hồi từ PT Fruit tới khách hàng');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        $update_status = MessageModel::find($mess_id);
        $update_status->mess_status = 2;
        $update_status->save();
        return redirect()->back()->with('message', 'Đã gửi mail phản hồi thành công!');
    }

    public function edit_mail() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        return view('admin.message.edit_message');
    }
    
}
