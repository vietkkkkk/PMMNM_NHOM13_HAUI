<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\CouponModel;
use App\Models\ProductModel;
use App\Models\ShippingModel;
use App\Models\CustomerModel;
use App\Models\OrderDetailsModel;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {

    public function AuthLogin() { //Kiểm tra đăng nhập Admin

        $admin_id = Auth::id();
        if($admin_id) {
            return redirect('admin');
        } else {
            return redirect('admin/dang-nhap')->send();
        }
    }

    public function update_order_qty(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = $request->all();
        $order_details = OrderDetailsModel::where('product_id', $data['order_product_id'])
        ->where('order_code', $data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();
    }

    public function update_order_status(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = $request->all();
        $order = OrderModel::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        if($order->order_status == 2) {
            foreach($data['order_product_id'] as $key => $product_id) {
                $product = ProductModel::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty) {
                    if($key == $key2) {
                        $pro_remain = $product_quantity - $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();
                    }
                }
            }
        } elseif($order->order_status == 1) {
            foreach($data['order_product_id'] as $key => $product_id) {
                $product = ProductModel::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty) {
                    if($key == $key2) {
                        $pro_remain = $product_quantity + $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold - $qty;
                        $product->save();
                    }
                }
            }
        }
    }

    public function manage_order() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $order = OrderModel::orderby('order_status', 'asc')->get();

        return view('admin.order.manage_order')->with(compact('order'));
    }

    public function view_order($order_code) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $order = OrderModel::where('order_code', $order_code)->get();
        $order_details = OrderDetailsModel::with('product')->where('order_code', $order_code)->get();

        foreach ($order as $key => $ord) {
            $customer_id =$ord->customer_id;
            $shipping_id =$ord->shipping_id;
            $order_status =$ord->order_status;
        }
        $customer = CustomerModel::where('customer_id', $customer_id)->first();
        $shipping = ShippingModel::where('shipping_id', $shipping_id)->first();
        $order_details_product = OrderDetailsModel::with('product')->where('order_code', $order_code)->get();

        foreach($order_details_product as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
        if($product_coupon != 'no') {
            $coupon = CouponModel::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        return view('admin.order.view_order')->with(compact('order_details', 'customer', 'shipping', 'order_details',
        'coupon_condition', 'coupon_number', 'order', 'order_status'));
    }

    public function print_order($checkout_code) {

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $order_details = OrderDetailsModel::where('order_code', $checkout_code)->get();
        $order = OrderModel::where('order_code', $checkout_code)->get();

        foreach ($order as $key => $ord) {
            $customer_id =$ord->customer_id;
            $shipping_id =$ord->shipping_id;
        }
        $customer = CustomerModel::where('customer_id', $customer_id)->first();
        $shipping = ShippingModel::where('shipping_id', $shipping_id)->first();
        $order_details_product = OrderDetailsModel::with('product')->where('order_code', $checkout_code)->get();

        foreach($order_details_product as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
        if($product_coupon != 'no') {
            $coupon = CouponModel::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        $output = '';
        $output.='
        <style>
        body {
            font-family: DejaVu Sans;
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table td, .table th {
            padding: .5rem;
            vertical-align: top;
            border-top: 1px solid #e3e6f0;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        </style>
        <head>
            <title>In đơn hàng - PT Fruit</title>
        </head>
        <h3 style="font-size: 20px;">
            <strong><center>PT Fruit - Thương hiệu trái cây miền tây số 1 Việt Nam</center></strong>
        </h3>   
        <h2><center>HÓA ĐƠN BÁN HÀNG</center></h2>';
        $output.='
        <div class="table-responsive">
            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr><th colspan="2" class="text-center">Thông tin khách hàng đăng nhập</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="text-align: left;">Tên khách hàng</th>
                        <td>'.$customer->customer_name.'</td>
                    </tr>
                    <tr>
                        <th style="border-top: none; text-align: left;">Số điện thoại</th>
                        <td style="border-top: none;">'.$customer->customer_phone.'</td>
                    </tr>
                    <tr>
                        <th style="border-top: none; text-align: left;">Email khách hàng</th>
                        <td style="border-top: none;">'.$customer->customer_email.'</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">Thông tin vận chuyển đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="text-align: left;">Tên người nhận hàng</th>
                        <td>'.$shipping->shipping_name.'</td>
                    </tr>
                    <tr>
                        <th style="border-top: none; text-align: left;">Số điện thoại</th>
                        <td style="border-top: none;">'.$shipping->shipping_phone.'</td>
                    </tr>
                    <tr>
                        <th style="border-top: none; text-align: left;">Email người nhận</th>
                        <td style="border-top: none;">'.$shipping->shipping_email.'</td>
                    </tr>
                    <tr>
                        <th style="border-top: none; text-align: left;">Địa chỉ nhận hàng</th>
                        <td style="border-top: none;">'.$shipping->shipping_address.'</td>
                    </tr>
                    <tr>
                        <th style="border-top: none; text-align: left;">Hình thức thanh toán</th>
                        <td style="border-top: none;">';
                            if ($shipping->shipping_method == 1) {
        $output.='              Thanh toán khi nhận hàng';
                            } else {
        $output.='              Tài khoản ngân hàng';
                            }
        $output.='      </td>
                    </tr>';
                    if($shipping->shipping_notes) {
        $output.='  <tr>
                        <th style="border-top: none; text-align: left;">Ghi chú đơn hàng</th>
                        <td style="border-top: none;">'.$shipping->shipping_notes.'</td>
                    </tr>';
                    }
        $output.='
                </tbody>
            </table>
        </div>
        <div class="container table-responsive">
            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center;">#</th>
                        <th>Tên sản phẩm</th>
                        <th style="text-align: center;">Mã giảm giá</th>
                        <th style="text-align: right;">Đơn giá</th>
                        <th style="text-align: center;">Số lượng</th>
                        <th style="text-align: right;">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>';
                $i = 0;
                $total = 0;
                foreach($order_details as $key => $details) {
                    $i++;
                    $subtotal = $details->product_price * $details->product_sales_quantity;
                    $total += $subtotal;
        $output.='  <tr>
                        <td style="text-align: center;"><strong>'.$i.'</strong></td>
                        <td>'.$details->product_name.'</td>
                        <td style="text-align: center;">';
                            if($details->product_coupon != 'no') {
        $output.='            '.$details->product_coupon.'';
                            } else {
        $output.='            Không có';
                            }
        $output.='  </td>
                        <td style="text-align: right;">'.number_format($details->product_price, 0, ',', '.').' VNĐ</td>
                        <td style="text-align: center;">'.$details->product_sales_quantity.'</td>
                        <td style="text-align: right;">'.number_format($subtotal, 0, ',', '.').' VNĐ</td>
                    </tr>';
                }
        $output.='</tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" style="text-align: right;">Tổng:<br>Phí ship:<br>Giảm giá:<br>TỔNG THANH TOÁN:</th>';
                        $total_coupon = 0;
                        if($coupon_condition == 1) {
                            $total_after_coupon = ($total * $coupon_number) / 100;
                            $total_coupon = $total + $details->product_feeship - $total_after_coupon;
                        } else {
                            $total_after_coupon = $coupon_number;
                            $total_coupon = $total + $details->product_feeship - $coupon_number;
                        }
        $output.='      <th style="text-align: right;">
                            '.number_format($total, 0, ',', '.').' VNĐ<br>
                            '.number_format($details->product_feeship, 0, ',', '.').' VNĐ<br>
                            '.number_format($total_after_coupon, 0, ',', '.').' VNĐ<br>
                            '.number_format($total_coupon, 0, ',', '.').' VNĐ
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <table width="100%">
            <tbody>
                <tr>
                    <td style="width: 50%;"></td>
                    <td style="width: 50%;"><center><i>Ngày.....tháng.....năm 20...</i></center></td>
                </tr>
                <tr>
                    <th style="width: 50%;">KHÁCH HÀNG</th>
                    <th style="width: 50%;">NGƯỜI BÁN HÀNG</th>
                </tr>
                <tr>
                    <td colspan="2" style="height: 100px;"></td>
                </tr>
            </tbody>
        </table>';
        return $output;
    }
}
