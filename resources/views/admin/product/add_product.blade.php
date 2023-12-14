@extends('admin.layout')
@section('admin_content')
<h1 class="h3 mb-4 text-gray-800">Sản phẩm</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h5>
    </div>
    <div class="container card-body">
        <form action="{{URL('/admin/luu-san-pham')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_name"><strong>Tên sản phẩm</strong></label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tên sản phẩm!"
                class="form-control" id="product_name" name="product_name" placeholder="Tên sản phẩm...">
            </div>
            <div class="form-group">
                <label for="product_quantity"><strong>Số lượng</strong></label>
                <input type="text" data-validation="number" data-validation-error-msg="Vui lòng nhập số lượng sản phẩm!"
                class="form-control" id="product_quantity" name="product_quantity" placeholder="Số lượng sản phẩm...">
            </div>
            <div class="form-group">
                <label style="margin-bottom: 0;" for="product_image"><strong>Hình ảnh sản phẩm</strong></label>
                <small style="margin-top: 0;" class="form-text text-muted">Vui lòng thêm hình ảnh sản phẩm có kích thước 350 x 300</small>
                <input type="file" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng tải hình ảnh sản phẩm lên!"
                style="padding: .2rem .75rem;" class="form-control" id="product_image" name="product_image">
            </div>
            <div class="form-group">
                <label for="product_cate"><strong>Danh mục sản phẩm</strong></label>
                <select id="product_cate" name="product_cate" class="form-control form-control-sm">
                @foreach($cate_product as $key => $cate)
                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="product_price"><strong>Giá sản phẩm</strong></label>
                <input type="text" data-validation="number" data-validation-error-msg="Vui lòng nhập giá sản phẩm!"
                class="form-control" id="product_price" name="product_price" placeholder="Giá sản phẩm...">
            </div>
            <div class="form-group">
                <label for="product_desc"><strong>Mô tả sản phẩm</strong></label>
                <textarea style="resize: none;" class="form-control" id="product_desc" name="product_desc" rows="3" placeholder="Mô tả sản phẩm..."></textarea>
            </div>
            <div class="form-group">
                <label for="product_content"><strong>Đặc điểm sản phẩm</strong></label>
                <textarea style="resize: none;" class="form-control" id="product_content" name="product_content" rows="3" placeholder="Đặc điểm sản phẩm..."></textarea>
            </div>
            <div class="form-group">
                <label for="product_origin"><strong>Xuất xứ</strong></label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập xuất xứ của sản phẩm!"
                class="form-control" id="product_origin" name="product_origin" placeholder="Xuất xứ...">
            </div>
            <div class="form-group">
                <label for="product_unit"><strong>Đơn vị tính</strong></label>
                <select id="product_unit" name="product_unit" class="form-control form-control-sm">
                    <option>Kg</option>
                    <option>Gram</option>
                    <option>Hộp</option>
                    <option>Giỏ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="product_status"><strong>Tình trạng</strong></label>
                <select id="product_status" name="product_status" class="form-control form-control-sm">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
            <button type="submit" name="add_product" class="btn btn-grape">Thêm sản phẩm</button>
        </form>
    </div>
</div>
@endsection