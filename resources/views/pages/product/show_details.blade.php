<style>
    li.active {
        border: 2px solid #92278f;
    }
</style>
@extends('layout')
@section('content')
<div class="row">
    <div class="wrap-categories">
        <div class="text-center mb-3">
            <a href="#" class="title-content">
                <img src="{{url('public/client/img/dot-title-left.png')}}" alt=""> Chi tiết sản phẩm <img src="{{url('public/client/img/dot-title-right.png')}}" alt="">
            </a>
        </div>
        <div class="container mb-4">
            <form action="{{url('/luu-gio-hang')}}" method="post">
                @csrf
                @foreach($product_details as $key =>$value)
                <div class="wrap-product row">
                    <div class="col-sm-12 col-md-5 p-4">
                        <ul id="imageGallery">
                            @foreach($gallery as $key => $gal)
                            <li data-thumb="{{url('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{url('public/uploads/gallery/'.$gal->gallery_image)}}">
                                <img src="{{url('public/uploads/gallery/'.$gal->gallery_image)}}" alt="{{$gal->gallery_name}}" width="100%">
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <form>
                        @csrf
                    <ul class="col-sm-12 col-md-7 product-info">
                        <li class="product-title">{{$value->product_name}}</li>
                        <li>
                            <p class="product-view">Lượt xem: <span>5218</span></p>
                            <div style="bottom: -8px;" class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
                            <div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button_count" data-size="small">
                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse"
                                class="fb-xfbml-parse-ignore">Chia sẻ</a>
                            </div>
                        </li>
                        <li class="product-price">
                            <b>Giá: <span>{{number_format($value->product_price,0,',','.')}} VNĐ</span></b>
                        </li>
                        <li><b>Đơn vị tính:</b> <span>{{$value->product_unit}}</span></li>
                        <li><b>Số lượng sẵn có:</b> <span>{{$value->product_quantity}} {{$value->product_unit}}</span></li>
                        <li><b>Xuất xứ:</b> <span>{{$value->product_origin}}</span></li>
                        <li><b>Danh mục:</b> <span>{{$value->category_product->category_name}}</span></li>
                        <li>
                            <b>Tình trạng: </b>
                            <span>
                                @if($value->product_quantity > 10)
                                    Còn hàng
                                @elseif($value->product_quantity <= 10)
                                    Sắp hết
                                @else
                                    Hết hàng
                                @endif
                            </span>
                        </li>
                        <form>
                            @csrf
                            <li>
                                <div class="product-qty">
                                    <div class="row">
                                        <div class="show col-sm-12 col-md-2"><label>Số lượng:</label></div>
                                        <div class="col-sm-12 col-md-2 mb-2 px-3">
                                            <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                                            <input class="form-control text-center cart_product_qty" type="number" name="cart_product_qty" value="1" min="1">
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <button type="button" class="form-control btn btn-grape add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </form>
                        <li>
                            <div><span style="font-size: 16px;">{!!$value->product_desc!!}</span></div>
                        </li>
                    </ul>
                </div>
                <p><span style="font-size: 16px;">
                                    <strong>
                                        <span class="text-apple">Đặc điểm nổi bật:</span>
                                </strong> {!!$value->product_content!!}
                                </span>
                            </p>
                @endforeach
                <div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="10"></div>
            </form>
            <div class="product-contact">
                <div class="text-center mb-3">
                    <div style="color: #fff;" class="title-content">
                        <img src="{{url('public/client/img/dot-title-left.png')}}" alt=""> Bình luận đánh giá <img src="{{url('public/client/img/dot-title-right.png')}}" alt="">
                    </div>
                </div>
                <div class="pro-contact-content">
                    <form>
                        @csrf
                        <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
                        <div id="comment_show" class="mb-5">
                        </div>
                    </form>
                    <form class="row col-md-6">
                        @csrf
                        <label><strong>Viết đánh giá của bạn</strong></label>
                        @php
                            $customer_id = Session::get('customer_id');
                        @endphp
                        <input type="text" class="form-control mb-2 comment_name" placeholder="Họ và tên" />
                        <textarea style="resize: none;" class="form-control mb-2 comment_content" cols="60" rows="3" placeholder="Nội dung"></textarea>
                        @if($customer_id)
                        <input type="button" class="btn btn-grape send-comment" value="Bình luận">
                        @else
                        <a href="{{url('/dang-nhap')}}"><input type="button" class="btn btn-grape" value="Bình luận"></a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="text-center mb-3">
            <div class="title-content">
                <img src="{{url('public/client/img/dot-title-left.png')}}" alt=""> Sản phẩm liên quan <img src="{{url('public/client/img/dot-title-right.png')}}" alt="">
            </div>
        </div>
        <div class="wrap-products slick-product">
            @foreach($relate as $key => $pro_relate)
            <div class="col-xs-12 col-sm-6 col-md-3 list-product">
                <div class="box-product">
                    <form>
                        @csrf
                        <input type="hidden" value="{{$pro_relate->product_id}}" class="cart_product_id_{{$pro_relate->product_id}}">
                        <input type="hidden" value="{{$pro_relate->product_name}}" class="cart_product_name_{{$pro_relate->product_id}}">
                        <input type="hidden" value="{{$pro_relate->product_image}}" class="cart_product_image_{{$pro_relate->product_id}}">
                        <input type="hidden" value="{{$pro_relate->product_price}}" class="cart_product_price_{{$pro_relate->product_id}}">
                        <input type="hidden" value="{{$pro_relate->product_quantity}}" class="cart_product_quantity_{{$pro_relate->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$pro_relate->product_id}}">
                        <a href="{{url('chi-tiet-san-pham/'.$pro_relate->product_id)}}">
                            <img src="{{url('/public/uploads/product/'.$pro_relate->product_image)}}" width="100%" alt="{{$pro_relate->product_name}}">
                        </a>
                        <div class="info-product text-center">
                            <h3><a href="{{url('chi-tiet-san-pham/'.$pro_relate->product_id)}}">{{$pro_relate->product_name}}</a></h3>
                            <div class="price-product text-center">
                                <p>{{number_format($pro_relate->product_price,0,',','.')}} VNĐ</p>
                            </div>
                            
                            @if($customer_id)
                            <button type="button" class="buy-product form-control btn add-to-cart" data-id_product="{{$pro_relate->product_id}}" name="add-to-cart">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Thêm vào giỏ hàng
                            </button>
                            @else
                            <a href="{{url('/dang-nhap')}}">
                                <button type="button" class="buy-product form-control btn" name="add-to-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Thêm vào giỏ hàng
                                </button>
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection