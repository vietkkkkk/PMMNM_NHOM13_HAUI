<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO -->
    <meta name="author" content="">
    <meta name="description" content="{{$meta_desc}}">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="keywords" content="{{$meta_keywords}}">
    <link rel="canonical" href="{{$url_canonical}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('public/client/img/ico-logo.ico')}}">

    <meta property="og:site_name" content="http://localhost/do_an_co_so_2/" />
    <meta property="og:description" content="{{$meta_desc}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:type" content="website" />
    <!-- END SEO -->
    <title>{{$meta_title}}</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="{{asset('public/client/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/client/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/client/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('public/client/css/sweetalert.css')}}">

    <!-- Light Slider -->
    <link rel="stylesheet" href="{{asset('public/client/css/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/client/css/prettify.css')}}">
    <link rel="stylesheet" href="{{asset('public/client/css/lightslider.css')}}">
</head>

<body>
    <!-- Begin Header -->
    <header class="mb-3 fixedElement">
        <!-- Begin Header PC -->
        <div class="wrapper-top py-1">
            <div class="container">
                <div class="detail">
                    <a class="map-top" href="https://goo.gl/maps/zm4MPY3XfUV6NNmN9"><i class="fas fa-map-marker-alt"></i> Địa chỉ: Số 298 Đ. Cầu Diễn, Minh Khai, Bắc Từ Liêm, Hà Nội|</a>
                    <a href="tel: 0941 547 945"><i class="m-lg-1 fas fa-phone-alt"></i> 0911 939 025</a>
                </div>
                <div class="social">
                    Social:
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="container-fluid pb-3 header-pc">
            <div class="row">
                <a class="col-sm-1" href="{{url('/')}}" title="PT Fruit - Thương hiệu trái cây miền Tây số 1 Việt Nam">
                    <img src="{{url('public/client/img/logo.png')}}" alt="PT Fruit - Thương hiệu trái cây miền Tây số 1 Việt Nam" width="192" height="68">
                </a>
                <div class="col-sm-2">
                    <div class="row">
                        <div class="col-md-3 mt-4"><img src="{{url('public/client/img/icon-phone.png')}}" alt="icon-phone"></div>
                        <div class="col-md-9 mt-3">
                            <a class="item-row1" href="#">Hotline</a><br/>
                            <a class="item-row2 text-danger" href="tell: 0911 939 025">0911 939 025</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-md-2 mt-4"><img src="{{url('public/client/img/icon-conversion.png')}}" alt="icon-conversion"></div>
                        <div class="col-md-10 mt-3">
                            <a class="item-row1" href="#">Đổi trả hàng</a><br/>
                            <a class="item-row2" href="#">Cho đến khi bạn hài lòng</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-md-2 mt-4"><img src="{{url('public/client/img/icon-product.png')}}" alt="icon-product"></div>
                        <div class="col-md-10 mt-3">
                            <a class="item-row1" href="#">Sản phẩm PT Fruits</a><br/>
                            <a class="item-row2" href="#">Đẳng cấp thế giới</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 row mt-3">
                    @if(Session::get('cart') == true)
                    <div id="show-cart-qty" class="col-md-6 icon-cart"></div>
                    @else
                    <div class="col-md-6 icon-cart">
                        <a href="{{url('/gio-hang')}}">
                            <span class="num-cart">0</span>
                            <img src="{{url('public/client/img/icon-cart.png')}}" alt="Giỏ hàng" width="40">
                        </a>
                    </div>
                    @endif
                    <div class="col-md-6 icon-search">
                        <img src="{{url('public/client/img/icon-search.png')}}" width="44" alt="Search">
                        <div class="search-content">
                            <div class="icon-down-search"></div>
                            <div class="form-search" id="search-container">
                                <form action="{{url('/tim-kiem')}}" autocomplete="off" method="get">
                                    @csrf
                                    <div class="row">
                                        <input type="text" name="keyword_submit" id="keywords" class="col-md-10 form-control" placeholder="Nhập từ khóa tìm kiếm...">
                                        <button type="submit" class="col-md-2 btn btn-violet"><i class="text-white fas fa-search"></i></button>
                                    </div>
                                    <spanS id="search_ajax"></sp>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="container nav-pc">
            <div class="row">
                <div class="navbar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}"><i class="fas fa-home-alt"></i></a>
                        </li>
                        <li class="nav-item dropdown subnav-item">
                            <a class="nav-link" href="" onclick="return false;">Sản phẩm</a>
                            <ul class="dropdown-menu subnav">
                                @foreach($category_product as $key => $cate_pro)
                                <li class="dropdown-item"><a href="{{url('/danh-muc-san-pham/'.$cate_pro->category_id)}}">{{$cate_pro->category_name}}</a></li>
                                <li class="dropdown-divider"></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="https://www.facebook.com/profile.php?id=100028232147841">Fanpage</a></li>
                        <li class="nav-item dropdown subnav-item">
                            <a class="nav-link" href="" onclick="return false;">Tin tức</a>
                            <ul class="dropdown-menu subnav">
                                @foreach($category_post as $key => $cate_post)
                                <li class="dropdown-item"><a href="{{url('/danh-muc-bai-viet/'.$cate_post->cate_post_slug)}}">{{$cate_post->cate_post_name}}</a></li>
                                <li class="dropdown-divider"></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/lien-he')}}">Liên hệ</a></li>
                        <li class="nav-item dropdown subnav-item">
                            <a class="nav-link" href="" onclick="return false;">Tài khoản</a>
                            <ul class="dropdown-menu subnav">
                                @php
                                    use Illuminate\Support\Facades\Session;
                                    $customer_id = Session::get('customer_id');
                                @endphp
                                @if($customer_id)
                                <li class="dropdown-item"><a href="">Lịch sử mua hàng</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item"><a href="">Thông tin</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item"><a href="{{url('/dang-xuat')}}">Đăng xuất</a></li>
                                @else
                                <li class="dropdown-item"><a href="{{url('/dang-nhap')}}">Đăng nhập</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item"><a href="{{url('/dang-ky')}}">Đăng ký</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Header PC -->
        <!-- Begin Header Responsive -->
        <div class="nav-responsive">
            <div class="logo-homepage">
                <a class="icon-logo" href="{{url('/')}}" title="PT Fruit - Thương hiệu trái cây miền Tây số 1 Việt Nam">
                    <img src="{{url('public/client/img/logo-mobile.png')}}" alt="PT Fruit - Thương hiệu trái cây miền Tây số 1 Việt Nam">
                </a>
            </div>
            <div class="nav-wrapper-res">
                <ul class="nav nav-tabs">
                    <li id="" class="show-nav-respon js-left-nav">
                        <button class="mt-1">
                            <span class="navicon-line"></span>
                            <span class="navicon-line"></span>
                            <span class="navicon-line"></span>
                        </button>
                    </li>
                    <li class="col-tab-1 js-support">
                        <button></button>
                    </li>
                    <li class="col-tab-2 js-social">
                        <button></button>
                    </li>
                    <li class="col-tab-3 js-search">
                        <button></button>
                    </li>
                </ul>
                <div class="show-nav-res js-nav-support">
                    <ul class="nav-row row js-row-support">
                        <li class="col-md-5 nav-row-item"><a href="#">Hướng dẫn mua hàng và thanh toán</a></li>
                        <li class="col-md-5 nav-row-item"><a href="{{url('/lien-he')}}">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="show-nav-res js-nav-social">
                    <ul class="nav-row row js-row-social">
                        <li class="col-md-5 nav-row-item">
                            <a href="#" title="Facebook">Facebook</a>
                        </li>
                        <li class="col-md-5 nav-row-item ">
                            <a href="#" title="Google+">Google+</a>
                        </li>
                        <li class="col-md-5 nav-row-item">
                            <a href="#" title="Twitter">Twitter</a>
                        </li>
                        <li class="col-md-5 nav-row-item">
                            <a href="#" title="Youtube">Youtube</a>
                        </li>
                        <li class="col-md-5 nav-row-item">
                            <a href="tel: 0911 939 025">0911 939 025</a>
                        </li>
                        <li class="col-md-5 nav-row-item">
                            <a href="tel: 0911 939 025">0911 939 025 (giờ hành chính)</a>
                        </li>
                        <li class="col-md-10 nav-row-item">
                            <a href="mailto: nguyenhhieu160402@gmail.com">guyenhhieu160402@gmail.com</a>
                        </li>
                    </ul>
                </div>
                <div class="show-nav-res js-nav-search">
                    <form class="nav-row js-row-search" autocomplete="off" action="{{url('/tim-kiem')}}" method="get">
                        @csrf
                        <div class="row">
                            <input type="text" name="keyword_submit" id="keywords" class=" col-md-10 form-control" placeholder="Nhập từ khóa tìm kiếm...">
                            <button type="submit" class="col-md-2 btn btn-violet"><i class="text-white fas fa-search"></i></button>
                        </div>
                        <div id="search_ajax"></div>
                    </form>
                </div>
            </div>
        </div>
        <div id="" class="show-nav-left js-modal-nav">
            <div class="nav-left js-show-nav-left">
                <div class="head-left-nav"> Menu PT Fruit
                    <div class="icon-left-nav js-icon-back"></div>
                </div>
                <ul id="menu-left">
                    <li class="nav-item">
                        <div><a class="nav-link js-hide" href="#">Giới thiệu</a></div>
                    </li>
                    <li class="nav-item dropdown subnav-item">
                        <span>
                            <a class="nav-link" href="#" onclick="return false;">Sản phẩm</a>
                            <div class="icon-add-nav"></div>
                        </span>
                        <ul class="dropdown-menu subnav">
                            @foreach($category_product as $key => $cate_pro)
                                <li class="dropdown-item">
                                    <a href="{{url('/danh-muc-san-pham/'.$cate_pro->category_id)}}">{{$cate_pro->category_name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown subnav-item">
                        <span>
                            <a class="nav-link" href="#" onclick="return false;">Quà tặng</a>
                            <div class="icon-add-nav"></div>
                        </span>
                        <ul class="dropdown-menu subnav">
                            <li class="dropdown-item">
                                <a href="#">Giỏ quà tặng</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="#">Khay quà tặng</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div><a class="nav-link js-hide" href="https://www.facebook.com/16.huuhieu">Fanpage</a></div>
                    </li>
                    <li class="nav-item dropdown subnav-item">
                        <span>
                            <a class="nav-link" href="#" onclick="return false;">Tin tức</a>
                            <div class="icon-add-nav"></div>
                        </span>
                        <ul class="dropdown-menu subnav">
                            @foreach($category_post as $key => $cate_post)
                            <li class="dropdown-item">
                                <a href="{{url('/danh-muc-bai-viet/'.$cate_post->cate_post_slug)}}">{{$cate_post->cate_post_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <div><a class="nav-link" href="{{url('/lien-he')}}">Liên hệ</a></div>
                    </li>
                    <li class="nav-item dropdown subnav-item">
                        <span>
                            <a class="nav-link" href="#" onclick="return false;">Tài khoản</a>
                            <div class="icon-add-nav"></div>
                        </span>
                        <ul class="dropdown-menu subnav">
                            @php
                                $customer_id = Session::get('customer_id');
                            @endphp
                            @if($customer_id)
                            <li class="dropdown-item">
                                <a href="">Lịch sử mua hàng</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="">Thông tin</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="{{url('/dang-xuat')}}">Đăng xuất</a>
                            </li>
                            @else
                            <li class="dropdown-item">
                                <a href="{{url('/dang-nhap')}}">Đăng nhập</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="{{url('/dang-ky')}}">Đăng ký</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Header Responsive -->
    </header>
    <!-- End Header -->
    @yield('content')
    <!-- Begin Scroll to top -->
    <div><img id="scroll-top" onclick="topFunction()" src="{{url('public/client/img/scroll-to-top.png')}}" alt="Scroll top top"></div>
    <!-- End Scroll to top -->
    <!-- Begin Footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row mx-0">
                    <div class="col-md-5">
                        <p>
                            <a href="{{url('/')}}"><img class="mb-3 logo-footer" src="{{url('public/client/img/logo-mobile.png')}}" alt="PT Fruit - Thương hiệu trái cây miền Tây số 1 Việt Nam"></a> <br>
                            <i class="mr-3 fas fa-map-marked-alt"></i>Cơ sở 1 <br>
                            <span>&emsp;&emsp;<i class="mr-3 fas fa-map-marker-alt"></i>Địa chỉ:<a class="row-bottom-2" href="https://goo.gl/maps/UaLozAdYMdhvsCrd8?coh=178571&entry=tt">295 Ngô Gia Tự, Xóm Tự, Tam Sơn, Từ Sơn, Bắc Ninh</a></span><br>
                            <span>&emsp;&emsp;<i class="mr-3 fas fa-phone-alt"></i>Điện thoại:<a class="row-bottom-2" href="tel: 0911 939 025"> 0911 939 025</a></span><br>
                            <span>&emsp;&emsp;<i class="mr-3 fas fa-envelope"></i>Email:<a class="row-bottom-2" href="mailto: ntphat.20it10@vku.udn.vn"> nguyenhhieu160402@gmail.com</a></span>
                        </p>
                        <p>
                            <i class="mr-3 fas fa-map-marked-alt"></i>Cơ sở 2 <br>
                            <span>&emsp;&emsp;<i class="mr-3 fas fa-map-marker-alt"></i>Địa chỉ:<a class="row-bottom-2" href="https://goo.gl/maps/W6jzYFesoT2iqAoK7?coh=178571&entry=tt"> Số 298 Đ. Cầu Diễn, Minh Khai, Bắc Từ Liêm, Hà Nội</a></span><br>
                            <span>&emsp;&emsp;<i class="mr-3 fas fa-phone-alt"></i>Điện thoại:<a class="row-bottom-2" href="tel: 0943 609 263"> 0943 609 263</a></span><br>
                            <span>&emsp;&emsp;<i class="mr-3 fas fa-envelope"></i>Email:<a class="row-bottom-2" href="mailto: dttai.20it10@vku.udn.vn"> nguyengiangnb100202@gmail.com</a></span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="title-footer">Quy định - chính sách</div>
                        <hr>
                        <div>
                            <p><a class="row-bottom-2" href="#"><i class="mr-1 fas fa-angle-double-right"></i>Hướng dẫn đặt hàng và thanh toán</a></p>
                            <p><a class="row-bottom-2" href="#"><i class="mr-1 fas fa-angle-double-right"></i>Chính sách giao hàng và đổi trả</a></p>
                            <p><a class="row-bottom-2" href="#"><i class="mr-1 fas fa-angle-double-right"></i>Chính sách bảo mật thông tin</a></p>
                        </div>
                        <img src="{{url('public/client/img/da-thong-bao.png')}}" alt="Đã thông báo" width="184px">
                    </div>
                    <div class="col-md-3">
                        <div class="title-footer">Fanpage Facebook</div>
                        <hr>
                        <iframe class="mt-2" src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FhethongtraicayPTFruit%2F&tabs=timeline&width=280&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                            width="280" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>

                    </div>
                </div>
                <div class="row container">
                    <div class="col-md-4 px-4 text-center social-footer">
                        <a href="https://www.facebook.com/profile.php?id=100028232147841"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.facebook.com/messages/t/100027114264176"><i class="fab fa-facebook-messenger"></i></a>
                        <a href="https://www.youtube.com/channel/UCEQjnvJMV0eWe1LoEdSrq7g"><i class="fab fa-youtube"></i></a>
                    </div>
                    <div class="col-md-6 copyright">Coppyright©2023 Nhóm 3 CCPTPM | Designed by Team 3</div>
                </div>
            </div>
        </div>
        <div class="row-bottom">
            <div class="row">
                <div class="col-md-2">
                    <span class="row-bottom-1">Mua hàng:<a class="row-bottom-2" href="tel: 0911 939 025"> 0911 939 025</a></span>
                </div>
                <div class="col-md-3">
                    <span class="row-bottom-1">Hotline:</span>
                    <a class="row-bottom-2" href="tel: 0911 939 025"> 0911 939 025</a>
                    <span> (giờ hành chính)</span>
                </div>
                <div class="col-md-3">
                    <span class="row-bottom-1">Email:</span>
                    <a class="row-bottom-2" href="mailto: ntphat.20it10@vku.udn.vn"> nguyenhhieu160402@gmail.com</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <script src="{{asset('public/client/js/js.js')}}"></script>

    

    <!-- Sweetalert -->
    <script src="{{asset('public/client/js/sweetalert.js')}}"></script>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Light Slider -->
    <script type="text/javascript" src="{{asset('public/client/js/lightgallery-all.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/client/js/lightslider.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/client/js/prettify.js')}}"></script>

    <!-- Slick carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0"nonce="O8DBI9RT"></script>
    <!-- Slick sider, slick products and slick partner -->
    <script type="text/javascript">
        // ----- Slick Slider -----
        $('.slick-slider').slick({
            dots: true,
            infinite: true,
            speed: 600,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
        });
        // ----- Slick Products -----
        $('.slick-product').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }]
        });
        // ----- Slick Partner -----
        $('.slick-partner').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            }, {
                breakpoint: 840,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }]
        });
        $('.slick-new-img').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slick-new-subimg'
        });
        $('.slick-new-subimg').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slick-new-img',
            centerMode: true,
            focusOnSelect: true,
        });
        $('.slick-product-details').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slick-subProduct-details'
        });
        $('.slick-subProduct-details').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slick-product-details',
            centerMode: true,
            focusOnSelect: true,
        });
    </script>
    <script type="text/javascript">
        $(window).scroll(function(e) {
            var $el = $('.fixedElement');
            var $wrapTop = $('.wrapper-top');
            var isPositionFixed = ($el.css('position') == 'fixed');
            if ($(this).scrollTop() > 200 && !isPositionFixed) {
                $el.css({
                    'position': 'fixed',
                    'top': '0',
                    'right': '0',
                    'left': '0',
                    'z-index': '1000',
                    'bacground-color': '#f7ffec'
                });
                $wrapTop.css({
                    'display': 'none'
                });
            }
            if ($(this).scrollTop() <
                200 && isPositionFixed) {
                $el.css({
                    'position': 'relative'
                });
                $wrapTop.css({
                    'display': 'block'
                });
            }
        });
    </script>

    <!-- Form validation -->
    <script src="{{asset('public/server/js/jquery.form-validator.min.js')}}"></script>
    <script type="text/javascript">
        $.validate({

        });
    </script>

<script type="text/javascript">
        $(document).ready(function() {
            $('.submit_mess').click(function() {
                var name_mess = $('.name_mess').val();
                var phone_mess = $('.phone_mess').val();
                var email_mess = $('.email_mess').val();
                var content_mess = $('.content_mess').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/lien-he-chung-toi')}}",
                    method: 'POST',
                    data:{
                        name_mess:name_mess,
                        phone_mess:phone_mess,
                        email_mess:email_mess,
                        content_mess:content_mess,
                        _token:_token
                    },
                    success:function(data) {
                        swal({
                            title: "Cảm ơn bạn đã liên hệ với chúng tôi!",
                            text: "Chúng tôi sẽ liên hệ với bạn sớm nhất có thể!",
                            showCancelButton: true,
                            cancelButtonText: "Oke",
                            cancelButtonClass: "btn-grape",
                            showConfirmButton: false
                        });
                        $('.name_mess').val('');
                        $('.phone_mess').val('');
                        $('.email_mess').val('');
                        $('.content_mess').val('');
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            load_comment();
            function load_comment() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/hien-thi-binh-luan')}}",
                    method: "post",
                    data:{product_id:product_id, _token:_token},
                    success:function(data) {
                        $('#comment_show').html(data);
                    }
                });
            }
            $('.send-comment').click(function() {
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/gui-binh-luan')}}",
                    method: "post",
                    data:{product_id:product_id, comment_name:comment_name, comment_content:comment_content, _token:_token},
                    success:function(data) {
                        load_comment();
                        $('.comment_name').val('');
                        $('.comment_content').val('');
                    }
                });
            });
        });
    </script>

    <!-- Auto complete search -->
    <script type="text/javascript">
        $('#keywords').keyup(function() {
            var query = $(this).val();
            if(query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/autocomplete-ajax')}}",
                    method: "post",
                    data:{query:query, _token:_token},
                    success:function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            } else {
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click', '.li_search_ajax', function() {
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 4,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }   
            });  
        });
    </script>
    <!-- Add to cart -->
    <script type="text/javascript">
        $(document).ready(function() {
            // Show cart Quantity
            show_cart_qty();
            function show_cart_qty() {
                $.ajax({
                    url: "{{url('/hien-thi-so-luong-gio-hang')}}",
                    method: "GET",
                    success:function(data) {
                        $('#show-cart-qty').html(data);
                    }
                });
            }
            $('.add-to-cart').click(function() {
                var id= $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/them-gio-hang')}}",
                    method: 'POST',
                    data:{
                        cart_product_id:cart_product_id,
                        cart_product_name:cart_product_name,
                        cart_product_image:cart_product_image,
                        cart_product_price:cart_product_price,
                        cart_product_quantity:cart_product_quantity,
                        cart_product_qty:cart_product_qty,
                        _token:_token
                        
                    },
                    success:function(data) {
                        swal({
                            title: "Đã thêm vào giỏ hàng",
                            text: "Bạn có thể tiếp tục mua sắm hoặc đi đến giỏ hàng để thanh toán",
                            showCancelButton: true,
                            cancelButtonText: "Trở lại",
                            cancelButtonClass: "btn-danger",
                            confirmButtonClass: "btn-grape",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false
                        },
                        function() {
                            window.location.href = "{{url('/gio-hang')}}";
                        });
                        show_cart_qty();
                    }
                });
            });
        });
    </script>
    <!-- Add to cart product details-->
    <script type="text/javascript">
        $(document).ready(function() {
            show_cart_qty();
            function show_cart_qty() {
                $.ajax({
                    url: "{{url('/hien-thi-so-luong-gio-hang')}}",
                    method: "GET",
                    success:function(data) {
                        $('#show-cart-qty').html(data);
                    }
                });
            }
            $('.add-to-cart').click(function() {
                var id= $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_qty = $('.cart_product_qty').val();
                var _token = $('input[name="_token"]').val(); 
                if(parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                    swal("Lỗi!", "Vui lòng đặt nhỏ hơn số lượng sẵn có!", "error");
                } else {        
                    $.ajax({
                        url: "{{url('/them-vao-gio-hang')}}",
                        method: 'POST',
                        data:{
                            cart_product_id:cart_product_id,
                            cart_product_name:cart_product_name,
                            cart_product_image:cart_product_image,
                            cart_product_price:cart_product_price,
                            cart_product_quantity:cart_product_quantity,
                            cart_product_qty:cart_product_qty,
                            _token:_token
                            
                        },
                        success:function(data) {
                            swal({
                                title: "Đã thêm vào giỏ hàng",
                                text: "Bạn có thể tiếp tục mua sắm hoặc đi đến giỏ hàng để thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Trở lại",
                                cancelButtonClass: "btn-danger",
                                confirmButtonClass: "btn-grape",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/gio-hang')}}";
                            });
                            show_cart_qty();
                        }
                    });
                }
            });
        });
    </script>

    <!-- show feeship -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change',function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if(action=='city'){
                    result = 'province';
                }else{
                    result = 'wards';
                }
                $.ajax({
                    url : "{{url('/hien-thi-phi-ship')}}",
                    method: 'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);     
                    }
                });
            });
        });
    </script>

    <!-- Calculate Feeship -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.calculate_delivery').click(function() {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Vui lòng nhập địa chỉ!');
                } else {
                    $.ajax({
                        url : "{{url('/tinh-phi-van-chuyen')}}",
                        method: 'POST',
                        data:{matp:matp, maqh:maqh, xaid:xaid, _token:_token},
                        success:function(){
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>

    <!-- Order -->
    <script type="text/javascript">
        $(document).ready(function() {

            $('.send_order').click(function() {
                swal({
                    title: "Xác nhận đơn hàng",
                    text: "Bạn có chắc chắn xác nhận đơn hàng này không?",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Trở lại",
                    cancelButtonClass: "btn-danger",
                    confirmButtonText: "Xác nhận",
                    confirmButtonClass: "btn-grape",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        var shipping_payment = $('.shipping_payment').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_email = $('.shipping_email').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{url('/xac-nhan-don-hang')}}",
                            method: 'POST',
                            data:{
                                shipping_payment:shipping_payment,
                                shipping_email:shipping_email,
                                shipping_name:shipping_name,
                                shipping_address:shipping_address,
                                shipping_phone:shipping_phone,
                                shipping_notes:shipping_notes,
                                shipping_method:shipping_method,
                                order_fee:order_fee,
                                order_coupon:order_coupon,
                                _token:_token
                                
                            },
                            success:function() {
                                swal("Đã đặt hàng!", "Đơn hàng sẽ không được hoàn trả trở lại!", "success");
                            }
                        });
                        window.setTimeout(function(){
                            location.reload();
                        }, 3000);
                    } else {
                        swal("Đã hủy!", "Vui lòng thanh toán đơn hàng của bạn!", "error");
                    }
                });
            });
        });
    </script>
</body>

</html>