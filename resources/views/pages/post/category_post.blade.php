@extends('layout')
@section('content')
<div class="wrap-categories">
    @foreach($cate_post as $key => $cate)
    <div class="row">
        <div class="text-center mb-3">
            <a class="title-content" href="#">
                <img src="{{url('public/client/img/dot-title-left.png')}}" alt=""> {{$cate->cate_post_name}} <img src="{{url('public/client/img/dot-title-right.png')}}" alt="">
            </a>
        </div>
        <div class="wrap-products row">
            @foreach($post as $key => $pos)
            <div class="col-md-4 col-sm-6 col-xs-6 px-2">
                <div class="box-product text-center">
                    <a href="{{url('bai-viet/'.$pos->post_slug)}}">
                        <img style="border-radius: 8px;" src="{{url('public/uploads/post/'.$pos->post_image)}}" height="240px" alt="{{$pos->post_title}}">
                    </a>
                    <h5 class="mt-3 mb-2"><a style="font-size: 18px; height: 48px;" class="text-grape d-block" href="{{url('bai-viet/'.$pos->post_slug)}}">{{$pos->post_title}}</a></h5>
                    <div style="font-size: 12px">
                        Bình luận: 0
                        &ensp;-&ensp; Ngày tạo: {{$pos->created_at}} &ensp;-&ensp; Lượt xem: 190
                    </div>
                    <p style="font-size: 16px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{$pos->post_desc}}</p>
                    <p><a style="border-radius: 50px; width: 120px;" class="btn btn-grape" href="{{url('bai-viet/'.$pos->post_slug)}}">Xem thêm</a></p>
                </div>    
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
<!-- <ul class="pagination pagination-sm m-t-none m-b-none">
    {!!$post->links()!!}
</ul> -->
<!-- <div class="container page" aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item disabled">
            <a style="background: none; color: #fff; border-color: #fff;" class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <li class="page-item active"><a style="background: #696969; border-color: #fff;" class="page-link" href="./sanpham.html">1</a></li>
        <li class="page-item"><a class="page-link" href="./sanpham2.html">2</a></li>
        <li class="page-item"><a class="page-link" href="./sanpham3.html">3</a></li>
        <li class="page-item disabled"><a style="background: none; color: #fff; border-color: #fff;" class="page-link" href="#">...</a></li>
        <li class="page-item">
            <a class="page-link" href="./sanpham2.html" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</div> -->

@endsection