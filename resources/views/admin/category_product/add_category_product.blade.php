@extends('admin.layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Danh mục sản phẩm</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Thêm danh mục sản phẩm</h5>
    </div>
    <div class="container card-body">
        <form action="{{url('/admin/luu-danh-muc')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="category_product_name"><strong>Tên danh mục</strong></label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tên danh mục sản phẩm!"
                class="form-control" id="category_product_name" name="category_product_name" placeholder="Tên danh mục...">
            </div>
            <div class="form-group">
                <label for="category_product_desc"><strong>Mô tả danh mục</strong></label>
                <textarea style="resize: none;" class="form-control" id="category_product_desc" name="category_product_desc" rows="3" placeholder="Mô tả danh mục..."></textarea>
            </div>
            <div class="form-group">
                <label for="category_product_keywords"><strong>Từ khóa danh mục</strong></label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập từ danh mục sản phẩm!"
                class="form-control" id="category_product_keywords" name="category_product_keywords" placeholder="Từ khóa danh mục...">
            </div>
            <div class="form-group">
                <label for="category_product_status"><strong>Tình trạng</strong></label>
                <select id="category_product_status" name="category_product_status" class="form-control form-control-sm">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
            <button type="submit" name="add_category_product" class="btn btn-grape">Thêm danh mục</button>
        </form>
    </div>
</div>
<!-- Success Modal-->
@endsection