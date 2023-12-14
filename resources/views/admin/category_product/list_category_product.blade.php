@extends('admin.layout')
@section('admin_content')
<h1 class="h3 mb-4 text-gray-800">Danh mục sản phẩm</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h5 class="col-md-6 m-0 font-weight-bold text-primary">Danh sách danh mục sản phẩm</h5>
            <div style="text-align: right;" class="col-md-6">
                <a class="btn btn-grape" href="{{url('/admin/them-danh-muc')}}">Thêm danh mục</a>
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
                        <th>Tên danh mục</th>
                        <th>Chỉnh sửa lần cuối</th>
                        <th class="text-center">Kích hoạt</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_categories_product as $key => $cate_pro)
                    <tr>
                        <td>{{ $cate_pro->category_name}}</td>
                        <td>
                            @if($cate_pro->updated_at == '')
                                    {{ $cate_pro->created_at}}
                            @else
                                    {{ $cate_pro->updated_at}}
                            @endif
                        </td>
                        <td class="text-center">
                            @if($cate_pro->category_status == 0)
                                <a href="{{url('/admin/ngung-kich-hoat-danh-muc/'.$cate_pro->category_id)}}"><i class="fa-2x fas fa-times text-danger"></i></a>
                            @else
                                <a href="{{url('/admin/kich-hoat-danh-muc/'.$cate_pro->category_id)}}"><i class="fa-2x fas fa-check text-success"></i></a>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{url('/admin/chinh-sua-danh-muc/'.$cate_pro->category_id)}}"><i style="font-size: 28px;" class="text-warning mb-1 mr-1 fas fa-edit"></i></button></a>
                            <a href="{{url('/admin/xoa-danh-muc/'.$cate_pro->category_id)}}" onclick="return confirm('Bạn có chắn chắn xóa danh mục sản phẩm này không?')"><i style="font-size: 28px;" class="text-danger mb-1 fas fa-trash-alt"></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection