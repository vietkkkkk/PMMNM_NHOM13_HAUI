@extends('layout')
@section('content')
<div class="wrap-categories">
    <div class="row">
        <div class="col-md-9">
            @foreach($post as $key => $pos)
            <div style="text-transform: none;" class="title-content">{{$pos->post_title}}</div>
            <div style="font-size: 12px" class="mb-3">
                Bình luận: 0
                &ensp;-&ensp; Ngày tạo: {{$pos->created_at}} &ensp;-&ensp; Lượt xem: 190
            </div>
            <p><b>{{$pos->post_desc}}</b></p>
            <p>{!!$pos->post_content!!}</p>
            @endforeach
            
            <div style="height: 300px;"></div>
        </div>
        <div class="col-md-3">
            <div style="text-transform: none;" class="text-center mb-3 title-content">Bài viết liên quan</div>
            <ul>
                @foreach($post_relate as $key => $relate)
                <li class="list-unstyled"><a class="text-grape" href="{{url('bai-viet/'.$relate->post_slug)}}"><i class="fas fa-angle-double-right"></i> {{$relate->post_title}}</a></li>
                <hr>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection