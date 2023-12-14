<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Admin PT Fruit - Thương hiệu trái cây miền Tây số 1 Việt Nam</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{url('public/client/img/ico-logo.ico')}}">
    <link href="{{asset('public/server/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('public/server/css/admin.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/server/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/admin')}}">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                <div class="sidebar-brand-text mx-3">
                @php
                    use Illuminate\Support\Facades\Auth;
                    $name = Auth::user()->admin_name;
                    if ($name) {
                        echo $name;
                    } else {
                        echo 'Đăng nhập';
                    }
                @endphp
                </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/admin')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Thống kê</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Quản lý chung</div>
            @hasrole(['admin', 'author'])
			<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWeb" aria-expanded="true" aria-controls="collapseWeb">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Quản lý Website</span>
                </a>
                <div id="collapseWeb" class="collapse" aria-labelledby="headingWeb" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('/admin/doi-tac')}}">Đối tác</a>
                        <a class="collapse-item" href="{{url('/admin/slider')}}">Quản lý Slider</a>
                    </div>
                </div>
            </li>
            @endhasrole
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMember" aria-expanded="true" aria-controls="collapseMember">
                    <i class="fas fa-users"></i>
                    <span>Người dùng</span>
                </a>
                <div id="collapseMember" class="collapse" aria-labelledby="headingMember" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @hasrole(['admin', 'author'])
                        @hasrole('admin')
                        <a class="collapse-item" href="{{url('/admin/them-nguoi-dung')}}">Thêm người dùng</a>
                        @endhasrole
                        <a class="collapse-item" href="{{url('/admin/nguoi-dung')}}">Danh sách người dùng</a>
                        @endhasrole
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Đơn hàng</span>
                </a>
                <div id="collapseOrder" class="collapse" aria-labelledby="headingOrder" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('/admin/don-hang')}}">Danh sách đơn hàng</a>
                    </div>
                </div>
            </li>
            @hasrole(['admin', 'author'])
			<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
                    <i class="far fa-folder-open"></i>
                    <span>Danh mục sản phẩm</span>
                </a>
                <div id="collapseCategories" class="collapse" aria-labelledby="headingCategories" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('/admin/them-danh-muc')}}">Thêm danh mục</a>
                        <a class="collapse-item" href="{{url('/admin/danh-sach-danh-muc')}}">Danh sách danh mục</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
                    <i class="fab fa-product-hunt"></i>
                    <span>Sản phẩm</span>
                </a>
                <div id="collapseProduct" class="collapse" aria-labelledby="headingProduct" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('/admin/them-san-pham')}}">Thêm sản phẩm</a>
                        <a class="collapse-item" href="{{url('/admin/danh-sach-san-pham')}}">Danh sách sản phẩm</a>
                    </div>
                </div>
            </li>
            @endhasrole
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCatePost" aria-expanded="true" aria-controls="collapseCatePost">
                    <i class="fas fa-newspaper"></i>
                    <span>Bài viết</span>
                </a>
                <div id="collapseCatePost" class="collapse" aria-labelledby="headingCatePost" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('/admin/danh-muc-bai-viet')}}">Danh mục bài viết</a>
						<a class="collapse-item" href="{{url('/admin/them-bai-viet')}}">Thêm bài viết</a>
						<a class="collapse-item" href="{{url('/admin/danh-sach-bai-viet')}}">Danh sách bài viết</a>
                    </div>
                </div>
            </li>
            @hasrole(['admin', 'author'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCoupon" aria-expanded="true" aria-controls="collapseCoupon">
                    <i class="fas fa-percent"></i>
                    <span>Mã giảm giá</span>
                </a>
                <div id="collapseCoupon" class="collapse" aria-labelledby="headingCoupon" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('/admin/them-ma-giam-gia')}}">Thêm mã giảm giá</a>
                        <a class="collapse-item" href="{{url('/admin/danh-sach-ma-giam-gia')}}">Danh sách mã giảm giá</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/admin/van-chuyen')}}">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Phí vận chuyển</span>
                </a>
            </li>
            @endhasrole
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Cài đặt</div>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-user"></i>
                    <span>Thông tin cá nhân</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-shield-alt"></i>
                    <span>Mật khẩu và bảo mật</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Đăng xuất</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Nhập từ khóa tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-grape" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-grape" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{URL('public/server/img/undraw_profile_1.svg')}}" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{URL('public/server/img/undraw_profile_2.svg')}}" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{URL('public/server/img/undraw_profile_3.svg')}}" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div> -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                @php
                                    $name = Auth::user()->admin_name;
                                    if ($name) {
                                        echo $name;
                                    } else {
                                        echo 'Đăng nhập';
                                    }
                                @endphp
                                </span>
                                <img class="img-profile rounded-circle" src="{{url('public/server/img/undraw_profile.svg')}}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Hồ sơ
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Đăng xuất
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    @yield('admin_content')
                    
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Coppyright©2021 PT Fruit All Rights Reserved | Designed by PT Team</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn đăng xuất không?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn muốn kết thúc phiên hiện đăng nhập của mình!</div>
                <div class="modal-footer">
                    <a class="btn btn-grape" href="{{url('/admin/dang-xuat')}}">Đăng xuất</a>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Trở lại</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('public/server/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/server/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('public/server/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('public/server/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('public/server/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('public/server/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('public/server/js/demo/chart-pie-demo.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('public/server/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/server/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('public/server/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('public/server/js/demo/datatables-demo.js')}}"></script>

    <!-- Re Captcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <!-- Sweetalert -->
    <script src="{{asset('public/server/js/sweetalert.js')}}"></script>

    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            Morris.Donut({
            element: 'donut',
            resize: true,
            colors: [
                '#f28aef',
                '#bf50bc',
                '#8c2e8a',
                '#61185f',
                '#40083e'
            ],
            data: [
                {label: "San pham", value: <?php echo $product_count ?>},
                {label: "Bai viet", value: <?php echo $post_count ?>},
                {label: "Video", value: <?php echo $video_count ?>},
                {label: "Don hang", value: <?php echo $order_count ?>},
                {label: "Doi tac", value: <?php echo $partner_count ?>}
            ]
            });
        });
    </script>
    
    <!-- ckeditor -->
    <script src="{{asset('public/server/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('product_desc', {
            filebrowserImageUploadUrl: "{{url('uploads-ckeditor?_token='.csrf_token())}}",
            filebrowserBrowseUrl: "{{url('file-browser?_token='.csrf_token())}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('product_content', {
            filebrowserImageUploadUrl: "{{url('uploads-ckeditor?_token='.csrf_token())}}",
            filebrowserBrowseUrl: "{{url('file-browser?_token='.csrf_token())}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('post_content', {
            filebrowserImageUploadUrl: "{{url('uploads-ckeditor?_token='.csrf_token())}}",
            filebrowserBrowseUrl: "{{url('file-browser?_token='.csrf_token())}}",
            filebrowserUploadMethod: 'form'
        });
    </script>

    <script type="text/javascript">
        $('.btn-reply-comment').click(function() {
            var comment_id = $(this).data('comment_id');
            var comment = $('.reply-comment-'+comment_id).val();
            var comment_product_id = $(this).data('product_id');
            $.ajax({
                url: "{{url('/admin/tra-loi-binh-luan')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                data:{comment:comment, comment_id:comment_id, comment_product_id:comment_product_id},
                success: function(data) {
                    $('.reply-comment-'+comment_id).val('');
                    $('#notify-comment').html('<span>Đã trả lời bình luận!</span>');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            load_video();
            function load_video() {
                $.ajax({
                    url: "{{url('/admin/hien-thi-video')}}",
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#video_load').html(data);
                    }
                });
            }
            $(document).on('click', '.add_video', function() {
                var video_title = $('.video_title').val();
                var video_slug = $('.video_slug').val();
                var video_link = $('.video_link').val();

                var form_data = new FormData();
                form_data.append("file", document.getElementById("file_img_video").files[0]);
                form_data.append("video_title", video_title);
                form_data.append("video_slug", video_slug);
                form_data.append("video_link", video_link);
                $.ajax({
                    url: "{{url('/admin/them-video')}}",
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data) {
                        load_video();
                        $('#success_video').html('<strong class="text-danger">Thêm video thành công!</strong>'); 
                    }
                });
            });
            $(document).on('click', '.delete_video', function() {
                var video_id = $(this).data('video_id');
                var _token = $('input[name="_token"]').val();
                if(confirm('Bạn có chắc chắn xóa video này!')) {
                    $.ajax({
                        url: "{{url('/admin/xoa-video')}}",
                        method: 'post',
                        headers:{
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        },
                        data:{video_id:video_id, _token:_token},
                        success: function(data) {
                            load_video();
                            $('#success_video').html('<strong class="text-danger">Xóa video thành công!</strong>'); 
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            load_gallery();
            function load_gallery() {
                var pro_id = $('.pro_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin/hien-thi-thu-vien-anh')}}",
                    method: 'post',
                    data:{pro_id:pro_id, _token:_token},
                    success: function(data) {
                        $('#gallery_load').html(data);
                    }
                });
            }
            $('#file').change(function() {
                var error = '';
                var files = $('#file')[0].files;
                if(files.length > 5) {
                    error+='<p>Bạn chỉ được chọn tối đa 5 ảnh!</p>';
                } else if(files.lenth == '') {
                    error+='<p>Bạn chưa chọn ảnh!</p>';
                } else if(files.size > 2000000) {
                    error+='<p>Kích thước ảnh không được quá 2MB!</p>';
                }
                if(error == '') {

                } else {
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                    return false;
                }
            });
            $(document).on('blur', '.edit_gal_name', function() {
                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin/cap-nhat-ten-anh')}}",
                    method: 'post',
                    data:{gal_id:gal_id, gal_text:gal_text, _token:_token},
                    success: function(data) {
                        load_gallery();
                        $('#success_update').html('<strong class="text-danger">Cập nhật tên hình ảnh thành công!</strong>'); 
                    }
                });
            });
            $(document).on('click', '.delete_gallery', function() {
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if(confirm('Bạn có chắc chắn xóa hình ảnh này!')) {
                    $.ajax({
                        url: "{{url('/admin/xoa-hinh-anh')}}",
                        method: 'post',
                        data:{gal_id:gal_id, _token:_token},
                        success: function(data) {
                            load_gallery();
                            $('#success_update').html('<strong class="text-danger">Xóa hình ảnh thành công!</strong>'); 
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        function ChangeToSlug() {
            var slug;
      
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
             slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
             slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
             slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
             slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
             slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
             slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
             slug = slug.replace(/đ/gi, 'd');
             //Xóa các ký tự đặt biệt
             slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
             //Đổi khoảng trắng thành ký tự gạch ngang
             slug = slug.replace(/ /gi, "-");
             //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
             //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
             slug = slug.replace(/\-\-\-\-\-/gi, '-');
             slug = slug.replace(/\-\-\-\-/gi, '-');
             slug = slug.replace(/\-\-\-/gi, '-');
             slug = slug.replace(/\-\-/gi, '-');
             //Xóa các ký tự gạch ngang ở đầu và cuối
             slug = '@' + slug + '@';
             slug = slug.replace(/\@\-|\-\@|\@/gi, '');
             //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>

    <!-- Form validator -->
    <script src="{{asset('public/server/js/jquery.form-validator.min.js')}}"></script>
    <script type="text/javascript">
        $.validate({
            
        });
    </script>
    <script type="text/javascript">
        $('.update_quantity_order').click(function() {
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_'+order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : "{{url('/admin/don-hang/xem-don-hang/cap-nhat-so-luong-don-hang')}}",
                method: 'POST',
                data:{_token:_token, order_product_id:order_product_id, order_qty:order_qty, order_code:order_code},
                success:function(data) {
                    alert('Cập nhật số lượng thành công!');
                    location.reload();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('.order_details').change(function() {
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();
            quantity = [];
            $("input[name='product_sales_quantity']").each(function() {
                quantity.push($(this).val());
            });
            order_product_id = [];
            $("input[name='order_product_id']").each(function() {
                order_product_id.push($(this).val());
            });
            j = 0;
            for(i = 0; i < order_product_id.length; i++) {
                var order_qty = $('.order_qty_' + order_product_id[i]).val(); //Số lượng khách đặt
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val(); //Số lượng tồn kho
                if(parseInt(order_qty) > parseInt(order_qty_storage)) {
                    j = j + 1;
                    if(j = 1) {
                        alert('số lượng kho không đủ!');
                    }
                    $('.color_qty_'+order_product_id[i]).css('color', '#e74a3b');
                }
            }
            if(j == 0) {
                $.ajax({
                    url : "{{url('/admin/don-hang/xem-don-hang/cap-nhat-tinh-trang-don-hang')}}",
                    method: 'POST',
                    data:{_token:_token, order_status:order_status, order_id:order_id, quantity:quantity, order_product_id:order_product_id},
                    success:function(data) {
                        alert('Cập nhật đơn hàng thành công!');
                        location.reload();
                    }
                });
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            fetch_delivery();

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url : "{{url('/admin/danh-sach-phi-van-chuyen')}}",
                    method: 'POST',
                    data:{_token:_token},
                    success:function(data) {
                    $('#load_delivery').html(data);
                    }
                });
            }

            $(document).on('blur', '.fee_feeship_edit', function() {
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url : "{{url('/admin/cap-nhat-van-chuyen')}}",
                    method: 'POST',
                    data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                    success:function(data){
                        fetch_delivery();
                    }
                });
            });

            $('.add_delivery').click(function() {

                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();
                
                $.ajax({
                    url : "{{url('/admin/them-van-chuyen')}}",
                    method: 'POST',
                    data:{city:city, province:province, _token:_token, wards:wards, fee_ship:fee_ship},
                    success:function(data){
                        fetch_delivery();
                    }
                });
            });
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
                    url : "{{url('/admin/danh-sach-van-chuyen')}}",
                    method: 'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);     
                    }
                });
            }); 
        })
    </script>
</body>

</html>