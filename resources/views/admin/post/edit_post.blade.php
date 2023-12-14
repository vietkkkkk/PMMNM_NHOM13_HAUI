@extends('admin.layout')
@section('admin_content')
<h1 class="h3 mb-4 text-gray-800">Bài viết</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Chỉnh sửa bài viết</h5>
    </div>
    <div class="container card-body">
        <form action="{{url('/admin/cap-nhat-bai-viet/'.$post->post_id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label><strong>Tiêu đề bài viết</strong></label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tiêu đề bài viết!"
                class="form-control" onkeyup="ChangeToSlug();" value="{{$post->post_title}}" name="post_title" id="slug" placeholder="Tiêu đề bài viết...">
            </div>
            <div style="display: none;" class="form-group">
                <label><strong>Slug</strong></label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tiêu đề bài viết!"
                class="form-control" id="convert_slug" value="{{$post->post_slug}}" name="post_slug" placeholder="Tiêu đề bài viết...">
            </div>
            <div class="form-group">
                <label style="margin-bottom: 0;"><strong>Avatar bài viết</strong></label>
                <input type="file" style="padding: .2rem .75rem;" class="form-control" name="post_image">
            </div>
            <div class="form-group">
                <label><strong>Danh mục bài viết</strong></label>
                <select name="cate_post_id" class="form-control form-control-sm">
                @foreach($cate_post as $key => $cate)
                    <option {{ $post->cate_post_id == $cate->cate_post_id ? 'selected' : ''}} value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label><strong>Tóm tắt nội dung bài viết</strong></label>
                <textarea data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tóm tắt tiêu đề bài viết!"
                style="resize: none;" class="form-control" name="post_desc" id="post_desc" rows="2" placeholder="Tóm tắt nội dung bài viết...">{{$post->post_desc}}</textarea>
            </div>
            <div class="form-group">
                <label><strong>Nội dung bài viết</strong></label>
                <textarea data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập nội dung bài viết!"
                style="resize: none;" class="form-control" name="post_content" id="post_content" rows="3" placeholder="Nội dung bài viết...">{{$post->post_content}}</textarea>
            </div>
            <div class="form-group">
                <label><strong>Tình trạng</strong></label>
                <select name="post_status" class="form-control form-control-sm">
                    @if($post->post_status == 0)
                        <option selected value="0">Hiển thị</option>
                        <option value="1">Ẩn</option>
                    @else
                        <option value="0">Hiển thị</option>
                        <option selected value="1">Ẩn</option>
                    @endif
                </select>
            </div>
            <button type="submit" name="update_post" class="btn btn-grape">Cập nhật bài viết</button>
        </form>
    </div>
</div>
@endsection