@extends('admin.layout')
@section('admin_content')
<h1 class="h3 mb-4 text-gray-800">Sản phẩm</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h5 class="col-md-6 m-0 font-weight-bold text-primary">Danh sách sản phẩm</h5>
            <div style="text-align: right;" class="col-md-6">
                <a class="btn btn-grape" href="{{url('/admin/them-san-pham')}}">Thêm sản phẩm</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <strong style="color: red; font-size: 14px;">
                @php
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if ($message) {
                    echo $message;
                    Session::put('message', null);
                }
                @endphp
            </strong>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center px-0">Thư viện ảnh</th>
                        <th style="width: 80px;" class="text-center px-0">Hình sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Xuất xứ</th>
                        <th>Đơn vị tính</th>
                        <th class="text-center px-0">Tình trạng</th>
                        <th class="text-center px-0">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_product as $key => $pro)
                    <tr>
                        <td class="text-center text-center-height px-0">
                            <a class="btn btn-sm btn-apple" href="{{url('/admin/thu-vien-anh/'.$pro->product_id)}}" title="Thêm thư viện ảnh sản phẩm">
                                <i class="fas fa-plus"></i>
                            </a>
                        </td>
                        <td style="padding: .5rem;" class="text-center">
                            <img src="{{url('public/uploads/product/'.$pro->product_image)}}" width="80" height="80" alt="{{ $pro->product_name}}">
                        </td>
                        <td class="text-center-height">{{ $pro->product_name}}</td>
                        <td class="text-center-height">{{ $pro->product_quantity}}</td>
                        <td class="text-center-height">{{ $pro->category_product->category_name}}</td>
                        <td class="text-center-height">{{number_format($pro->product_price,0,',','.')}} VNĐ</td>
                        <td class="text-center-height">{{ $pro->product_origin}}</td>
                        <td class="text-center-height">{{ $pro->product_unit}}</td>
                        <td class="text-center text-center-height">
                            @if($pro->product_status == 0)
                                <a href="{{url('/admin/ngung-kich-hoat-san-pham/'.$pro->product_id)}}">
                                    <i class="fa-2x fas fa-times text-danger" title="Sản phẩm này đang ẩn trên trang chủ! Click để hiển thị lên!"></i>
                                </a>
                            @else
                                <a href="{{url('/admin/kich-hoat-san-pham/'.$pro->product_id)}}">
                                    <i class="fa-2x fas fa-check text-success" title="Sản phẩm này đang hiển thị trên trang chủ! Click để ẩn đi!"></i>
                                </a>
                            @endif
                        </td>
                        <td class="text-center text-center-height">
                            <a href="{{url('/admin/chinh-sua-san-pham/'.$pro->product_id)}}"><button class="btn btn-warning mb-1"><i class="fas fa-edit"></i></button></a>
                            <a href="{{url('/admin/xoa-san-pham/'.$pro->product_id)}}" onclick="return confirm('Bạn có chắc chắn xóa sản phẩm này không?')"><button class="btn btn-danger mb-1"><i class="fas fa-trash-alt"></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection