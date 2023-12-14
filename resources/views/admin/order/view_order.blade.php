@extends('admin.layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Xem chi tiết đơn hàng</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
            <h5 class="col-md-6 m-0 font-weight-bold text-primary">Thông tin đơn hàng</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 table-responsive">
                <table class="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Thông tin vận chuyển đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Tên người nhận hàng</th>
                            <td>{{$shipping->shipping_name}}</td>
                        </tr>
                        <tr>
                            <th style="border-top: none;">Số điện thoại</th>
                            <td style="border-top: none;">{{$shipping->shipping_phone}}</td>
                        </tr>
                        <tr>
                            <th style="border-top: none;">Email người nhận</th>
                            <td style="border-top: none;">{{$shipping->shipping_email}}</td>
                        </tr>
                        <tr>
                            <th style="border-top: none;">Địa chỉ nhận hàng</th>
                            <td style="border-top: none;">{{$shipping->shipping_address}}</td>
                        </tr>
                        <tr>
                            <th style="border-top: none;">Hình thức thanh toán</th>
                            <td style="border-top: none;">
                                @if ($shipping->shipping_method == 1)
                                    Thanh toán khi nhận hàng
                                @else
                                    Tài khoản ngân hàng
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="border-top: none;">Ghi chú đơn hàng</th>
                            <td style="border-top: none;">
                                @if($shipping->shipping_notes)
                                    {{$shipping->shipping_notes}}
                                @else
                                    Không có ghi chú
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 table-responsive">
                <table class="table" width="100%" cellspacing="0">
                    <thead>
                        <tr><th colspan="2" class="text-center">Thông tin khách hàng đăng nhập</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Tên khách hàng</th>
                            <td>{{$customer->customer_name}}</td>
                        </tr>
                        <tr>
                            <th style="border-top: none;">Số điện thoại</th>
                            <td style="border-top: none;">{{$customer->customer_phone}}</td>
                        </tr>
                        <tr>
                            <th style="border-top: none;">Email khách hàng</th>
                            <td style="border-top: none;">{{$customer->customer_email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h5>
    </div>
    <div class="card-body">
        <div class="container table-responsive">
            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng kho</th>
                        <th class="text-center">Mã giảm giá</th>
                        <th style="text-align: right;">Đơn giá</th>
                        <th class="text-center">Số lượng</th>
                        <th style="text-align: right;">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                        $total = 0;
                    @endphp
                    @foreach($order_details as $key => $details)
                        @php
                            $i++;
                            $subtotal = $details->product_price * $details->product_sales_quantity;
                            $total += $subtotal;
                        @endphp
                        <tr class="color_qty_{{$details->product_id}}">
                            <td class="text-center"><strong>{{$i}}</strong></td>
                            <td>{{$details->product_name}}</td>
                            <td class="text-center">{{$details->product->product_quantity}}</td>
                            <td class="text-center">
                                @if ($details->product_coupon != 'no')
                                    {{$details->product_coupon}}
                                @else
                                    Không có mã giảm giá
                                @endif
                            </td>
                            <td style="text-align: right;">{{number_format($details->product_price, 0, ',', '.')}} VNĐ</td>
                            <!-- <td class="text-center">{{$details->product_sales_quantity}}</td> -->
                            <td style="display: flex; justify-content: center;">
                                <input style="width: 60px; margin-right: 4px;" {{$order_status != 1 ? 'disabled' : '' }} class="form-control tex-center order_qty_{{$details->product_id}}"
                                type="number" min="1" name="product_sales_quantity" value="{{$details->product_sales_quantity}}">
                                <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
                                <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">
                                <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
                                @if($order_status ==1)
                                <button class="btn btn-light update_quantity_order" data-product_id="{{$details->product_id}}" name="update_quantity_order"><i style="font-size: 20px;" class="fas fa-save"></i></button>
                                @endif
                            </td>
                            <td style="text-align: right;">{{number_format($subtotal, 0, ',', '.')}} VNĐ</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" style="display: table-cell; vertical-align: middle;"><a class="btn btn-secondary" target="_blank" href="{{url('/admin/in-don-hang/'.$details->order_code)}}"><i class="fas fa-print"></i>&ensp;In đơn hàng</a></th>
                        <th colspan="3" style="display: table-cell; vertical-align: middle;">
                            @foreach($order as $key => $or)
                                <form>
                                    @csrf
                                    @if($or->order_status == 1)
                                        <select class="form-control order_details">
                                            <option value="">----- Cập nhật đơn hàng -----</option>
                                            <option id="{{$or->order_id}}" value="1" selected>Đơn hàng mới - Chưa xử lý</option>
                                            <option id="{{$or->order_id}}" value="2">Đã xử lý - Đã giao hàng</option>
                                            <option id="{{$or->order_id}}" value="3">Đã hủy đơn</option>
                                        </select>
                                    @elseif($or->order_status == 2)
                                        <select disabled class="form-control order_details">
                                            <option value="">----- Cập nhật đơn hàng -----</option>
                                            <option id="{{$or->order_id}}" value="1">Đơn hàng mới - Chưa xử lý</option>
                                            <option id="{{$or->order_id}}" value="2" selected>Đã xử lý - Đã giao hàng</option>
                                            <option id="{{$or->order_id}}" value="3">Đã hủy đơn</option>
                                        </select>
                                    @else
                                        <select disabled class="form-control order_details">
                                            <option value="">----- Cập nhật đơn hàng -----</option>
                                            <option id="{{$or->order_id}}" value="1">Đơn hàng mới - Chưa xử lý</option>
                                            <option id="{{$or->order_id}}" value="2">Đã xử lý - Đã giao hàng</option>
                                            <option id="{{$or->order_id}}" value="3" selected>Đã hủy đơn</option>
                                        </select>
                                    @endif
                                </form>
                            @endforeach
                        </th>
                        <th style="text-align: right;">Tổng:<br>Phí ship:<br>Giảm giá:<br>TỔNG THANH TOÁN:</th>
                        @php
                            $total_coupon = 0;
                        @endphp
                        @if($coupon_condition == 1)
                            @php
                                $total_after_coupon = ($total * $coupon_number) / 100;
                                $total_coupon = $total + $details->product_feeship - $total_after_coupon;
                            @endphp
                        @else
                            @php
                                $total_after_coupon = $coupon_number;
                                $total_coupon = $total + $details->product_feeship - $coupon_number;
                            @endphp
                        @endif
                        <th style="text-align: right;">{{number_format($total, 0, ',', '.')}} VNĐ<br>{{number_format($details->product_feeship, 0, ',', '.')}} VNĐ<br>{{number_format($total_after_coupon, 0, ',', '.')}} VNĐ<br>{{number_format($total_coupon, 0, ',', '.')}} VNĐ</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection