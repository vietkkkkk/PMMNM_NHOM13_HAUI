@extends('admin.layout')
@section('admin_content')
<h1 class="h3 mb-4 text-gray-800">Bài viết</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h5 class="col-md-6 m-0 font-weight-bold text-primary">Danh sách bài viết</h5>
            <div style="text-align: right;" class="col-md-6">
                <a class="btn btn-grape" href="{{url('/admin/them-bai-viet')}}">Thêm bài viết</a>
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
                        <th style="width: 80px;" class="text-center">Avatar bài viết</th>
                        <th>Tên bài viết</th>
                        <th>Danh mục bài viết</th>
                        <th>Tóm tắt nội dung</th>
                        <th class="text-center">Hiển thị</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_post as $key => $post)
                    <tr>
                        <td class="text-center" style="padding: .5rem;"><img src="{{url('public/uploads/post/'.$post->post_image)}}" height="80" alt="{{ $post->post_name}}"></td>
                        <td class="text-center-height">{{$post->post_title}}</td>
                        <td class="text-center-height">{{$post->cate_post->cate_post_name}}</td>
                        <td class="text-center-height">{{$post->post_desc}}</td>
                        <td class="text-center-height text-center">
                            @if($post->product_status == 0)
                            Hiển thị
                            @else
                                Ẩn
                            @endif
                        </td>
                        <td class="text-center-height text-center">
                            <a href="{{url('/admin/chinh-sua-bai-viet/'.$post->post_id)}}"><button class="btn btn-warning mb-1"><i class="fas fa-edit"></i></button></a>
                            @hasrole(['admin', 'author'])
                            <a href="{{url('/admin/xoa-bai-viet/'.$post->post_id)}}" onclick="return confirm('Bạn có chắc chắn xóa bài viết này không?')"><button class="btn btn-danger mb-1"><i class="fas fa-trash-alt"></i></button></a>
                            @endhasrole
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection