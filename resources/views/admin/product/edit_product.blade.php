@extends('admin.layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Sản phẩm</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa sản phẩm</h6>
    </div>
    <div class="container card-body">
        @foreach($edit_product as $key => $pro)
        <form action="{{url('/admin/cap-nhat-san-pham/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_name">Tên sản phẩm</label>
                <input type="text"  data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tên sản phẩm!"
                class="form-control" id="product_name" name="product_name" value="{{$pro->product_name}}" placeholder="Tên sản phẩm...">
            </div>
            <div class="form-group">
                <label for="product_quantity"><strong>Số lượng</strong></label>
                <input type="text" data-validation="number" data-validation-error-msg="Vui lòng nhập số lượng sản phẩm!"
                class="form-control" id="product_quantity" name="product_quantity" value="{{$pro->product_quantity}}" placeholder="Số lượng sản phẩm...">
            </div>
            <div class="form-group">
                <label for="product_image">Hình ảnh sản phẩm</label>
                <input type="file" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng tải hình ảnh sản phẩm lên!"
                style="padding: .2rem .75rem;" class="form-control" id="product_image" name="product_image">
            </div>
            <div class="form-group">
                <label for="product_cate">Danh mục sản phẩm</label>
                <select id="product_cate" name="product_cate" class="form-control form-control-sm">
                @foreach($cate_product as $key => $cate)
                    @if($cate->category_id==$pro->category_id)
                    <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                    @else
                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                    @endif
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="product_price">Giá sản phẩm</label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập giá sản phẩm!"
                class="form-control" id="product_price" name="product_price" value="{{$pro->product_price}}" placeholder="Giá sản phẩm...">
            </div>
            <div class="form-group">
                <label for="product_desc">Mô tả sản phẩm</label>
                <textarea style="resize: none;" class="form-control" id="product_desc" name="product_desc" rows="3" placeholder="Mô tả sản phẩm...">{{$pro->product_desc}}</textarea>
            </div>
            <div class="form-group">
                <label for="product_content">Đặc điểm sản phẩm</label>
                <textarea style="resize: none;" class="form-control" id="product_content" name="product_content" rows="3" placeholder="Đặc điểm sản phẩm...">{{$pro->product_content}}</textarea>
            </div>
            <div class="form-group">
                <label for="product_origin">Xuất xứ</label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập xuất xứ của sản phẩm!"
                class="form-control" id="product_origin" name="product_origin" value="{{$pro->product_origin}}" placeholder="Xuất xứ...">
            </div>
            <div class="form-group">
                <label for="product_unit">Đơn vị tính</label>
                <select id="product_unit" name="product_unit" class="form-control form-control-sm">
                    <option selected>{{$pro->product_unit}}</option>
                    <option>Kg</option>
                    <option>Gram</option>
                    <option>Hộp</option>
                    <option>Giỏ</option>
                </select>
            </div>
            <button type="submit" name="add_product" class="btn btn-grape">Cập nhật sản phẩm</button>
        </form>
        @endforeach
    </div>
</div>
<!-- Success Modal-->
@endsection