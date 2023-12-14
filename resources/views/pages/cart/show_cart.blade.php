@extends('layout')
@section('content')
<style>
    .table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
</style>
<div class="container mb-4">
    <div class="row table-responsive">
        <div class="col-12">
            <div class="table-responsive">
                <div class="row">
                    <p class="col-md-8" style="color: red; font-size: 14px;">
                        <?php use Illuminate\Support\Facades\Session; ?>
                    </p>
                    <div style="text-align: right;" class="col-md-4">
                        <a href="{{url('/')}}" class="btn btn-apple text-white">Tiếp tục mua sắm</a>
                        @if(Session::get('cart') == true)
                        <a class="btn btn-danger" href="{{url('/xoa-gio-hang')}}">Xóa giỏ hàng</a>
                        @endif
                    </div>
                </div>
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
                                    <?php
                                    $message = Session::get('message');
                                    if ($message) {
                                        echo $message;
                                        Session::put('message', null);
                                    }
                                    ?>
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
                            @if (Session::get('coupon'))
                            <th class="text-danger" style="text-align: right;">{{number_format($total_coupon, 0, ',', '.')}} VNĐ</th>
                            @else
                            <th class="text-danger" style="text-align: right;">{{number_format($total, 0, ',', '.')}} VNĐ</th>
                            @endif
                        </tr>
                        <tr>
                            <th style="text-align: right;" colspan="2">
                                <a class="btn btn-grape" href="{{url('/thanh-toan')}}">Thanh toán</a>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection