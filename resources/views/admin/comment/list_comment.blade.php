@extends('admin.layout')
@section('admin_content')
<style>
    .table td {padding: 4px 12px !important;}
</style>
<h1 class="h3 mb-4 text-gray-800">Bình luận - đánh giá</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Danh sách bình luận</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <strong id="notify-comment" style="color: red; font-size: 14px;">
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
                        <th>Tên người gửi</th>
                        <th>Nội dung</th>
                        <th>Phản hồi</th>
                        <th>Sản phẩm</th>
                        <th>Ngày gửi</th>
                        <th class="text-center px-0">Duyệt / ẩn</th>
                        <th class="text-center px-0">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comment as $key => $comm)
                    <tr>
                        <td class="text-center-height">{{$comm->comment_name}}</td>
                        <td class="text-center-height">{{$comm->comment}}
                            <ul>
                            @foreach($comment_reply as $key => $comm_reply)
                                @if($comm_reply->comment_parent_comment == $comm->comment_id)
                                <li style="font-size: 14px;" class="text-grape">Đã trả lời: {{$comm_reply->comment}}</li>
                                @endif
                            @endforeach
                            </ul>
                        </td>
                        <td class="text-center-height">
                            @if($comm->comment_status == 0)
                            <div class="row">
                                <textarea class="col-md-10 form-control reply-comment-{{$comm->comment_id}}" rows="1" placeholder="Phản hồi"></textarea>
                                <button class="btn btn-sm col-md-2 text-center-height text-center btn-reply-comment" data-product_id="{{$comm->comment_product_id}}" data-comment_id="{{$comm->comment_id}}"><i style="font-size: 20px;" class="text-grape fas fa-reply"></i></button>
                            </div>
                            @endif
                        </td>
                        <td class="text-center-height"><a href="{{url('chi-tiet-san-pham/'.$comm->product->product_id)}}" target="_blank">{{$comm->product->product_name}}</a></td>
                        <td class="text-center-height">{{$comm->comment_date}}</td>
                        <td class="text-center-height text-center">
                            @if($comm->comment_status == 0)
                            <a href="{{url('/admin/an-binh-luan/'.$comm->comment_id)}}" title="Click để ẩn bình luận này!"><i style="font-size: 24px;" class="text-apple fas fa-eye-slash"></i></a>
                            @else
                            <a href="{{url('/admin/hien-thi-binh-luan/'.$comm->comment_id)}}" title="Click để hiển thị bình luận này!"><i style="font-size: 24px;" class="text-apple fas fa-eye"></i></a>
                            @endif
                        </td>
                        <td class="text-center-height text-center">
                            <a href="" title="Xóa" onclick="return confirm('Bạn có chắc chắn xóa bình luận này không?')"><i style="font-size: 24px;" class="text-danger fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection