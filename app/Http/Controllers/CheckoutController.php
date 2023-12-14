<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModel;
use Illuminate\Http\Request;
use App\Models\CityModel;
use App\Models\OrderModel;
use App\Models\WardsModel;
use App\Models\FeeshipModel;
use App\Models\CatePostModel;
use App\Models\CustomerModel;
use App\Models\ProvinceModel;
use App\Models\ShippingModel;
use App\Models\OrderDetailsModel;
use Illuminate\Support\Facades\Session;
use App\Rules\Captcha;

session_start();

class CheckoutController extends Controller {

    public function AuthLogin() { //Kiểm tra đăng nhập
        
        $customer_id = Session::get('customer_id');
        if($customer_id) {
            return redirect('/');
        } else {
            return redirect('/dang-nhap')->send();
        }
    }

    public function confirm_order(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập

        $data = $request->all();
        $shipping = new ShippingModel();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()), rand(0,26),5);

        $order = new OrderModel();
        $order->customer_id = Session::get('customer_id');
        $order->total_payment = $data['shipping_payment'];
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();

        if (Session::get('cart')) {
            foreach (Session::get('cart') as $key => $cart) {
                $order_details = new OrderDetailsModel();
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');

    }

    public function del_fee() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập

        Session::forget('fee');
        return redirect()->back();
    }

    public function calculate_fee(Request $request) {

        $data = $request->all();
        if ($data['matp']) {
            $feeship = FeeshipModel::where('fee_matp', $data['matp'])->where('fee_maqh', $data['maqh'])->where('fee_xaid', $data['xaid'])->get();
            if ($feeship) {
                $count_feeship = $feeship->count();
                if ($count_feeship > 0) {
                    foreach ($feeship as $key => $fee) {
                        Session::put('fee', $fee->fee_feeship);
                        Session::save();
                    }
                } else {
                    Session::put('fee', 35000);
                    Session::save();
                }
            }
            
        }
    }

    public function select_delivery_home(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập

        $data = $request->all();
    	if($data['action']) {
    		$output = '';
    		if ($data['action']=="city") {
    			$select_province = ProvinceModel::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>--- Chọn Quận / Huyện ---</option>';
    			foreach ($select_province as $key => $province) {
    				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}
    		} else {
    			$select_wards = WardsModel::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>--- Chọn Xã / Phường ---</option>';
    			foreach ($select_wards as $key => $ward) {
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    		echo $output;
    	}
    }

    public function login_checkout() {
        return view('pages.checkout.login_checkout');
    }

    public function register() {
        return view('pages.checkout.register');
    }
    
    public function add_customer(Request $request) {

        $data = $request->validate([
            'g-recaptcha-response' => new Captcha(),
        ]);

        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);

        $customer_id = CustomerModel::insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);

        return redirect('/dang-nhap');
    }

    public function checkout(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập

        // SEO
        $meta_desc = "Đơn vị chuyên phân phối sỉ và lẻ trái cây miền Tây với chất lượng và giá cả tốt nhất thị trường";
        $meta_keywords = "trai cay mien tay, trái cây miền tây, trái cây, ptfruit";
        $meta_title = "Thanh toán giỏ hàng - PT Fruit";
        $url_canonical = $request->url();

        // END SEO
        $category_product = CategoriesModel::where('category_status', '1')->orderBy('category_name', 'asc')->get();
        $category_post = CatePostModel::orderby('cate_post_id', 'desc')->get();
        $city = CityModel::orderby('matp', 'asc')->get();

        return view('pages.checkout.show_checkout')->with(compact('category_product', 'category_post',
        'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'city'));
    }

    public function logout_checkout() {

        Session::flush();
        return redirect('/dang-nhap');
    }

    public function login_customer(Request $request) {

        $data = $request->validate([
            'g-recaptcha-response' => new Captcha(),
        ]);

        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = CustomerModel::where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_email', $result->customer_email);
            Session::put('customer_phone', $result->customer_phone);
            return redirect('/');
        } else {
            Session::put('message', 'Tên đăng nhập hoặc mật khẩu không chính xác!<br> Vui lòng kiểm tra lại!');
            return redirect('/dang-nhap');
        }

    }
}
