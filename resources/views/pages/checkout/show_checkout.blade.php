@extends('layout')
@section('content')
<div class="container">
    <h1 class="h3 mb-2 mb-4">Thanh toán giỏ hàng</h1>
    <div class="card shadow mb-2">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6"><h5 class="m-0 font-weight-bold text-primary">Xem lại giỏ hàng</h5></div>
                <div style="text-align: right;" class="col-md-6"><a href="{{url('/gio-hang')}}" class="btn btn-apple text-white">Quay lại giỏ hàng</a></div>
            </div>
        </div>
        <div class="container card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <form class="row" action="{{url('/cap-nhat-gio-hang')}}" method="post">
                            @csrf
                            <thead>
                                <tr>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th style="text-align: right;" scope="col">Thành tiền</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Session::get('cart') == true)
                                @php
                                    $total = 0;
                                @endphp
                                @foreach(Session::get('cart') as $key => $cart)
                                    @php
                                        $subtotal = $cart['product_price'] * $cart['product_qty'];
                                        $total += $subtotal;
                                    @endphp
                                <tr>
                                    <td><img src="{{asset('/public/uploads/product/'.$cart['product_image'])}}" alt="{{$cart['product_name']}}" width="50" height="50"></td>
                                    <td><b>{{$cart['product_name']}}</b></td>
                                    <td>{{number_format($cart['product_price'],0,',','.')}} VNĐ</td>
                                    <td style="justify-content: center;">
                                        <input style="width: 60px; margin-right: 4px;" class="form-control tex-center cart_quantity"
                                        type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                    </td>
                                    <td style="text-align: right;">{{number_format($subtotal, 0, ',', '.')}} VNĐ</td>
                                    <td class="text-center"><a href="{{url('/xoa-sp-gio-hang/'.$cart['session_id'])}}"><i style="font-size: 24px;" class="text-danger fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-danger" colspan="6">Giỏ hàng rỗng!</td>
                                    </tr>
                                @endif        
                            </tbody>
                            @if(Session::get('cart') == true)
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                    <strong style="color: red; font-size: 14px;">
                                        @php
                                        $message = Session::get('message');
                                        if ($message) {
                                            echo $message;
                                            Session::put('message', null);
                                        }
                                        @endphp
                                    </strong>
                                    </td>
                                    <th style="text-align: right;">Tổng tiền:</th>
                                    <th style="text-align: right;">{{number_format($total, 0, ',', '.')}} VNĐ</th>
                                    <td class="text-center"><input type="submit" value="Cập nhật" name="update_qty" class="btn btn-grape"></td>
                                </tr>
                            </tfoot>
                            @endif
                        </form>
                    </table>
                </div>
            </div>
            @if(Session::get('cart') == true)
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12 col-md-8 mb-5">
                        <form class="mb-2" action="{{url('/kiem-tra-ma-giam-gia')}}" method="post">
                            @csrf
                            <label for="exampleInputEmail1"><strong>Mã giảm giá</strong></label>
                            <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập mã giảm giá!"
                            style="width: 32%; display: inline;" name="coupon" class="form-control" placeholder="Nhập mã giảm giá">
                            <input type="submit" class="btn btn-grape" value="Áp dụng"><br>
                        </form>
                        @if (Session::get('coupon'))
                            @foreach (Session::get('coupon') as $key => $cou)
                                <strong> Mã giảm giá đang áp dụng: <span class="text-danger">{{$cou['coupon_code']}}</span></strong>
                                <a class="btn btn-danger" href="{{url('/xoa-ma-giam-gia')}}">Xóa mã giảm giá</a>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <table>
                            <tr>
                                <th>Tổng tiền hàng:</th>
                                <th style="text-align: right;">{{number_format($total, 0, ',', '.')}} VNĐ</th>
                            </tr>
                            <tr>
                                <th>Phí vận chuyển:</th>
                                @if (Session::get('fee'))
                                <th style="text-align: right;">
                                    
                                    {{number_format(Session::get('fee'), 0, ',', '.')}} VNĐ
                                </th>
                                <th>&emsp;<a href="{{url('/xoa-phi-van-chuyen')}}"><i style="font-size: 20px;" class="text-danger fas fa-times"></i></a></th>
                                @endif
                            </tr>
                            @if (Session::get('coupon'))
                                @foreach (Session::get('coupon') as $key => $cou)
                                    @if ($cou['coupon_condition']== 1)
                                        <tr>
                                            <th>Giảm giá (Giảm {{$cou['coupon_number']}}%):</th>
                                            @php
                                                $subtotal_coupon = ($total * $cou['coupon_number']) / 100;
                                                $total_coupon = $total - $subtotal_coupon;
                                            @endphp
                                            <th style="text-align: right;">{{number_format($subtotal_coupon, 0, ',', '.')}} VNĐ</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>Giảm giá:</th>
                                            @php
                                                $total_coupon = ($total - $cou['coupon_number']);
                                            @endphp
                                            <th style="text-align: right;">{{number_format($cou['coupon_number'], 0, ',', '.')}} VNĐ</th>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            <tr>
                                <th class="text-danger text-uppercase">Tổng thanh toán:&emsp;</th>
                                @php
                                    if (Session::get('fee')) {
                                        $total_after_fee = $total + Session::get('fee');
                                    }
                                    if (Session::get('fee') && !Session::get('coupon')) {
                                        $total_after = $total_after_fee;
                                    } elseif(!Session::get('fee') && Session::get('coupon')) {
                                        $total_after = $total_coupon;
                                    } elseif(Session::get('fee') && Session::get('coupon')) {
                                        $total_after = $total_coupon;
                                        $total_after = $total_after + Session::get('fee');
                                    } elseif(!Session::get('fee') && !Session::get('coupon') ) {
                                        $total_after = $total;
                                    }
                                @endphp
                                <th class="text-danger" style="text-align: right;">{{number_format($total_after, 0, ',', '.')}} VNĐ</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 px-1 mb-3">
            <div class="card shadow">
                <form class="mb-2" method="post">
                    @csrf
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Thông tin người đặt hàng</h5>
                    </div>
                    <div class="container card-body">
                        @if(Session::get('cart') == true)
                        <input type="hidden" name="shipping_payment" class="shipping_payment" value="{{$total_after}}">
                        @endif
                        <div class="form-group mb-1">
                            <label><strong>Họ và tên</strong></label>
                            <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập họ và tên người nhận hàng!"
                            class="form-control shipping_name" name="shipping_name" placeholder="Họ và tên...">
                        </div>
                        <div class="form-group mb-1">
                            <label><strong>Số điện thoại</strong></label>
                            <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập số điện thoại!"
                            class="form-control shipping_phone" name="shipping_phone" placeholder="Số điện thoại...">
                        </div>
                        <div class="form-group mb-1">
                            <label><strong>Email</strong></label>
                            <input type="email" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập email!"
                            class="form-control shipping_email" name="shipping_email" placeholder="Email...">
                        </div>
                        <div class="form-group mb-1">
                            <label><strong>Địa chỉ</strong></label>
                            <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập địa chỉ nhận hàng!"
                            class="form-control shipping_address" name="shipping_address" placeholder="Địa chỉ nhận hàng...">
                        </div>
                        @if(Session::get('fee'))
                            <input type="hidden" class="order_fee" name="order_fee" value="{{Session::get('fee')}}">
                        @else
                            <input type="hidden" class="order_fee" name="order_fee" value="35000">
                        @endif
                        @if(Session::get('coupon'))
                            @foreach(Session::get('coupon') as $key => $cou)
                                <input type="hidden" class="order_coupon" name="order_coupon" value="{{$cou['coupon_code']}}">
                            @endforeach
                        @else
                            <input type="hidden" class="order_coupon" name="order_coupon" value="no">
                        @endif
                        <div class="form-group mb-1">
                            <label><strong>Hình thức thanh toán</strong></label>
                            <select name="payment_select" class="form-control form-control-sm payment_select">
                                <option value="1">Thanh toán khi nhận hàng</option>
                                <option value="0">Tài khoản ngân hàng</option>
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label><strong>Ghi chú đơn hàng</strong></label>
                            <textarea class="form-control shipping_notes" name="shipping_notes" rows="3" placeholder="Ghi chú đơn hàng của bạn..."></textarea>
                        </div>
                        <input type="button" name="send_order" class="form-control btn btn-grape send_order" value="Xác nhận đơn hàng">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 px-1 mb-3">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Phí vận chuyển</h5>
                </div>
                <div class="container card-body">
                    <form>
                        @csrf
                        <div class="form-group mb-2">
                            <label><strong>Tỉnh / Thành Phố</strong></label>
                            <select id="city" name="city" class="form-control form-control-sm choose city">
                                <option value="">--- Chọn Tỉnh / Thành phố ---</option>
                                @foreach ($city as $key => $ci)
                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label><strong>Quận / Huyện</strong></label>
                            <select id="province" name="province" class="form-control form-control-sm choose province">
                                <option value="">--- Chọn Quận / Huyện ---</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label><strong>Xã / Phường</strong></label>
                            <select id="wards" name="wards" class="form-control form-control-sm wards">
                                <option value="">--- Chọn Xã / Phường ---</option>
                            </select>
                        </div>
                        <div style="text-align: right;" class="mt-2">
                            <button type="button" name="calculate_order" class="btn btn-grape calculate_delivery">Áp dụng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection