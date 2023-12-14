@extends('admin.layout')
@section('admin_content')
<h1 class="h3 mb-4 text-gray-800">Thư viện ảnh sản phẩm</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <h5 class="col-md-4 m-0 font-weight-bold text-primary">Thêm thư viện hình ảnh</h5>
            <div class="col-md-8 text-center">
                <strong id="success_update" class="text-danger" style="font-size: 14px;">
                    @php
                    use Illuminate\Support\Facades\Session;
                    $message = Session::get('message');
                    if ($message) {
                        echo $message;
                        Session::put('message', null);
                    }
                    @endphp
                </strong>
            </div>
        </div>
    </div>
    <form action="{{url('/admin/luu-anh'.$pro_id)}}" method="post" enctype="multipart/form-data" class="container card-body">
        @csrf
        <div class="form-group row">
            <input type="file" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng tải ảnh lên!"
            name="file[]" id="file" style="padding: .2rem .75rem;" class="form-control col-md-6 m-1" accept="image/*" multiple>
            <button type="submit" name="upload" class="col-md-2 btn btn-grape m-1">Tải ảnh lên</button>
        </div>
        <span id="error_gallery"></span>
    </form>
    <div class="container card-body">
        <input type="hidden" name="pro_id" value="{{$pro_id}}" class="pro_id">
        <form>
            @csrf
            <div id="gallery_load" class="table-responsive">
                
            </div>
        </form>
    </div>
</div>
@endsection
