@extends('layout')
@section('content')
<div class="wrap-categories">
    @foreach($category_name as $key => $name)
    <div class="row">
        <div class="text-center mb-3">
            <a class="title-content" href="#">
                <img src="{{url('public/client/img/dot-title-left.png')}}" alt=""> {{$name->category_name}} <img src="{{url('public/client/img/dot-title-right.png')}}" alt="">
            </a>
            <h5 class="font-linotteBold">{{$name->category_desc}}</h5>
        </div>
        <div class="wrap-products">
            @foreach($category_by_id as $key => $product)
            <div class="col-xs-12 col-sm-6 col-md-3 list-product">
                <div class="box-product">
                    <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                    <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                    <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                    <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                    <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                    <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                    <a href="{{url('chi-tiet-san-pham/'.$product->product_id)}}">
                        <img src="{{url('public/uploads/product/'.$product->product_image)}}" width="100%" alt="{{$product->product_name}}">
                    </a>
                    <div class="info-product text-center">
                        <h3><a href="{{url('chi-tiet-san-pham/'.$product->product_id)}}">{{$product->product_name}}</a></h3>
                        <div class="price-product text-center">
                            <p>{{number_format($product->product_price,0,',','.')}} VNĐ</p>
                        </div>
                        @php
                            $customer_id = Session::get('customer_id');
                        @endphp
                        @if($customer_id)
                        <button type="button" class="buy-product form-control btn add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Thêm vào giỏ hàng
                        </button>
                        @else
                        <a href="{{url('dang-nhap')}}">
                            <button type="button" class="buy-product form-control btn" name="add-to-cart">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Thêm vào giỏ hàng
                            </button>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection