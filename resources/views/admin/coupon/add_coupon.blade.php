@extends('admin.layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Mã giảm giá</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Thêm mã giảm giá</h5>
    </div>
    <div class="container card-body">
        <form action="{{URL('/admin/luu-ma-giam-gia')}}" method="post">
            @csrf
            <div class="form-group">
                <label><strong>Tên mã giảm giá</strong></label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tên mã giảm giá!"
                class="form-control" name="coupon_name" placeholder="Tên mã giảm giá...">
            </div>
            <div class="form-group">
                <label><strong>Mã giảm giá</strong></label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập mã giảm giá!"
                class="form-control" name="coupon_code" placeholder="Mã giảm giá...">
            </div>
            <div class="form-group">
                <label><strong>Số lượng mã</strong></label>
                <input type="text" data-validation="number" data-validation-error-msg="Vui lòng nhập số lượng mã!"
                class="form-control" name="coupon_time" placeholder="Số lượng mã...">
            </div>
            <div class="form-group">
                <label><strong>Tính năng mã</strong></label>
                <select name="coupon_condition" class="form-control form-control-sm">
                    <option value="0">---Chọn---</option>
                    <option value="1">Giảm theo %</option>
                    <option value="2">Giảm theo tiền</option>
                </select>
            </div>
            <div class="form-group">
                <label><strong>Số % hoặc tiền giảm</strong></label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập số % hoặc tiền giảm!"
                class="form-control" name="coupon_number" placeholder="Số % hoặc tiền giảm...">
            </div>
            <button type="submit" name="add_coupon" class="btn btn-grape">Thêm mã giảm</button>
        </form>
    </div>
</div>
<!-- Success Modal-->
@endsection