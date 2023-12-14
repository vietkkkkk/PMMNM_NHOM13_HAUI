@extends('admin.layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Đơn hàng</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="col-md-6 m-0 font-weight-bold text-primary">Danh sách đơn hàng</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <p style="color: red; font-size: 14px;">
                <?php
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if ($message) {
                    echo $message;
                    Session::put('message', null);
                }
                ?>
            </p>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Thứ tự</th>
                        <th>Mã đơn hàng</th>
                        <th>Tổng thanh toán</th>
                        <th>Tình trạng</th>
                        <th>Ngày đặt hàng</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                    @foreach($order as $key => $ord)
                    @php $i++; @endphp
                    <tr>
                        @if($ord->order_status == 1)
                            <th class="font-weight-bold">{{$i}}</th>
                            <td class="font-weight-bold">{{$ord->order_code}}</td>
                            <td class="font-weight-bold">{{number_format($ord->total_payment, 0, ',', '.')}} VNĐ</td>
                            <td class="font-weight-bold">Đơn hàng mới - Chưa xử lý</td>
                            <td class="font-weight-bold">{{$ord->created_at}}</td>
                        @elseif($ord->order_status == 2)
                            <td>{{$i}}</td>
                            <td>{{$ord->order_code}}</td>
                            <td>{{number_format($ord->total_payment, 0, ',', '.')}} VNĐ</td>
                            <td>Đã xử lý - Đã giao hàng</td>
                            <td>{{$ord->created_at}}</td>
                        @else
                            <th class="text-danger">{{$i}}</th>
                            <td class="text-danger">{{$ord->order_code}}</td>
                            <td class="text-danger">{{number_format($ord->total_payment, 0, ',', '.')}} VNĐ</td>
                            <td class="text-danger">Đã hủy đơn</td>
                            <td class="text-danger">{{$ord->created_at}}</td>
                        @endif
                        
                        <td class="text-center">
                            <a class="mr-2" href="{{url('/admin/don-hang/xem-don-hang/'.$ord->order_code)}}"><i style="font-size: 24px;" class=" text-apple fas fa-eye"></i></a>
                            <!-- <a href="{{url('/admin/xoa-don-hang/'.$ord->order_code)}}" onclick="return confirm('Bạn có chắn chắn xóa danh mục sản phẩm này không?')"><i style="font-size: 24px;" class="text-danger fas fa-trash-alt"></i></a> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection