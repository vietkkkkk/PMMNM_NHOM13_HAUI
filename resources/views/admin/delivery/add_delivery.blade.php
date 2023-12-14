@extends('admin.layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Phí vận chuyển</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Thêm phí vận chuyển</h5>
    </div>
    <div class="container card-body">
        <form>
            @csrf
            <div class="form-group">
                <label><strong>Tỉnh / Thành Phố</strong></label>
                <select id="city" name="city" class="form-control form-control-sm choose city">
                    <option value="">--- Chọn Tỉnh / Thành phố ---</option>
                    @foreach ($city as $key => $ci)
                    <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label><strong>Quận / Huyện</strong></label>
                <select id="province" name="province" class="form-control form-control-sm choose province">
                    <option value="">--- Chọn Quận / Huyện ---</option>
                </select>
            </div>
            <div class="form-group">
                <label><strong>Xã / Phường</strong></label>
                <select id="wards" name="wards" class="form-control form-control-sm wards">
                    <option value="">--- Chọn Xã / Phường ---</option>
                </select>
            </div>
            <div class="form-group">
                <label><strong>Phí vận chuyển</strong></label>
                <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập phí vận chuyển!"
                class="form-control fee_ship" name="fee_ship" placeholder="Phí vận chuyển...">
            </div>
            <button type="button" name="add_delivery" class="btn btn-grape add_delivery">Thêm phí vận chuyển</button>
        </form>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Danh sách phí vận chuyển</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Tỉnh / Thành phố</th>
                        <th>Quận / Huyện</th>
                        <th>Xã / Phường</th>
                        <th>Phí ship</th>
                    </tr>
                </thead>
                <tbody id="load_delivery"></tbody>
            </table>
        </div>
    </div>
</div>
@endsection