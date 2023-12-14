@extends('admin.layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Mã giảm giá</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h5 class="col-md-6 m-0 font-weight-bold text-primary">Danh sách mã giảm giá</h5>
            <div style="text-align: right;" class="col-md-6">
                <a class="btn btn-grape" href="{{url('/admin/them-ma-giam-gia')}}">Thêm mã giảm giá</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <strong class="text-danger" style="font-size: 14px;">
                <?php
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if ($message) {
                    echo $message;
                    Session::put('message', null);
                }
                ?>
            </strong>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tên mã giảm giá</th>
                        <th>Mã giảm giá</th>
                        <th>Số lượng mã</th>
                        <th>Điều kiện giảm</th>
                        <th>Số tiền hoặc % giảm</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupon as $key => $cou)
                    <tr>
                        <td>{{ $cou->coupon_name}}</td>
                        <td>{{ $cou->coupon_code}}</td>
                        <td>{{ $cou->coupon_time}}</td>
                        <td>
                            <?php if($cou->coupon_condition == 1) { ?>
                                Giảm theo %
                            <?php } else { ?>
                                Giảm theo tiền
                            <?php } ?>
                        </td>
                        <td>
                            <?php if($cou->coupon_condition == 1) { ?>
                                Giảm {{$cou->coupon_number}} %
                            <?php } else { ?>
                                Giảm {{number_format($cou->coupon_number,0,',','.')}} VNĐ
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <a href="{{URL('/admin/xoa-ma-giam-gia/'.$cou->coupon_id)}}" onclick="return confirm('Bạn có chắn chắn xóa mã giảm giá này không?')"><button class="btn btn-danger mb-1"><i class="fas fa-trash-alt"></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection