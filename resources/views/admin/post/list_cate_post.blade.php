@extends('admin.layout')
@section('admin_content')
<h1 class="h3 mb-4 text-gray-800">Bài viết</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Danh mục bài viết</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Tên danh mục bài viết</th>
                        <th>Slug</th>
                        <th class="text-center">Hiển thị</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                    @foreach($category_post as $key => $cate_post)
                    @php $i++; @endphp
                    <tr>
                        <th class="text-center">{{$i}}</th>
                        <td>{{$cate_post->cate_post_name}}</td>
                        <td>{{$cate_post->cate_post_slug}}</td>
                        <td class="text-center">
                            @if($cate_post->cate_post_status == 1)
                                <a href="{{url('/admin/ngung-kich-hoat-danh-muc/'.$cate_post->cate_post_id)}}"><i class="fa-2x fas fa-times text-danger"></i></a>
                            @else
                                <a href="{{url('/admin/kich-hoat-danh-muc/'.$cate_post->cate_post_id)}}"><i class="fa-2x fas fa-check text-success"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection