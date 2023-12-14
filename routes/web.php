<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CategoriesProduct;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ---------------------------------------- Admin Controller ----------------------------------------
Route::get('/admin', [AdminController::class, 'show_dashboard']);
Route::post('/admin/loc-theo-ngay', [AdminController::class, 'filter_by_date']);


// ---------------------------------------- Auth Controller ----------------------------------------
Route::get('/admin/dang-xuat', [AuthController::class, 'logout']);
Route::get('/admin/dang-nhap', [AuthController::class, 'login_auth']);
Route::post('/admin/dang-nhap-auth', [AuthController::class, 'login']);


// ---------------------------------------- Banner Controller ----------------------------------------
Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/admin/slider', [BannerController::class, 'manage_slider']);
    Route::get('/admin/them-slider', [BannerController::class, 'add_slider']);
    Route::get('/admin/xoa-slider/{slider_id}', [BannerController::class, 'delete_slider']);
    Route::post('/admin/luu-slider', [BannerController::class, 'insert_slider']);
});
Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/admin/doi-tac', [BannerController::class, 'manage_partner']);
    Route::get('/admin/them-doi-tac', [BannerController::class, 'add_partner']);
    Route::get('/admin/xoa-doi-tac/{partner_id}', [BannerController::class, 'delete_partner']);
    Route::post('/admin/luu-doi-tac', [BannerController::class, 'insert_partner']);
});


// ---------------------------------------- Cart Controller ----------------------------------------
Route::get('/gio-hang', [CartController::class, 'show_cart']);
Route::get('/xoa-gio-hang', [CartController::class, 'del_all_pro']);
Route::get('/hien-thi-so-luong-gio-hang', [CartController::class, 'show_cart_qty']);
Route::get('/xoa-sp-gio-hang/{session_id}', [CartController::class, 'del_product']);
Route::post('/them-gio-hang', [CartController::class, 'add_to_cart']);
Route::post('/cap-nhat-gio-hang', [CartController::class, 'update_cart']);
Route::post('/them-vao-gio-hang', [CartController::class, 'add_to_cart_details']);

Route::get('/xoa-ma-giam-gia', [CartController::class, 'unset_coupon']);
Route::post('/kiem-tra-ma-giam-gia', [CartController::class, 'check_coupon']);


// ---------------------------------------- Categories Product Controller ----------------------------------------
Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/admin/them-danh-muc', [CategoriesProduct::class, 'add_category_product']);
    Route::get('/admin/danh-sach-danh-muc', [CategoriesProduct::class, 'list_categories_product']);
    Route::get('/admin/xoa-danh-muc/{category_product_id}', [CategoriesProduct::class, 'delete_category_product']);
    Route::get('/admin/chinh-sua-danh-muc/{category_product_id}', [CategoriesProduct::class, 'edit_category_product']);
    Route::get('/admin/kich-hoat-danh-muc/{category_product_id}', [CategoriesProduct::class, 'active_category_product']);
    Route::get('/admin/ngung-kich-hoat-danh-muc/{category_product_id}', [CategoriesProduct::class, 'unactive_category_product']);
    Route::post('/admin/luu-danh-muc', [CategoriesProduct::class, 'save_category_product']);
    Route::post('/admin/cap-nhat-danh-muc/{category_product_id}', [CategoriesProduct::class, 'update_category_product']);
});
Route::get('/danh-muc-san-pham/{category_id}', [CategoriesProduct::class, 'show_category_home']);


// ---------------------------------------- Checkout Controller ----------------------------------------
Route::get('/dang-ky', [CheckoutController::class, 'register']);
Route::get('/thanh-toan', [CheckoutController::class, 'checkout']);
Route::get('/dang-nhap', [CheckoutController::class, 'login_checkout']);
Route::get('/dang-xuat', [CheckoutController::class, 'logout_checkout']);
Route::get('/xoa-phi-van-chuyen', [CheckoutController::class, 'del_fee']);
Route::post('/them-khach-hang', [CheckoutController::class, 'add_customer']);
Route::post('/xac-nhan-don-hang', [CheckoutController::class, 'confirm_order']);
Route::post('/tinh-phi-van-chuyen', [CheckoutController::class, 'calculate_fee']);
Route::post('/dang-nhap-khach-hang', [CheckoutController::class, 'login_customer']);
Route::post('/hien-thi-phi-ship', [CheckoutController::class, 'select_delivery_home']);


// ---------------------------------------- Contact Controller ----------------------------------------
Route::get('/lien-he', [ContactController::class, 'contact']);
Route::get('/admin/lien-he', [ContactController::class, 'information']);


// ---------------------------------------- Coupon Controller ----------------------------------------
Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/admin/them-ma-giam-gia', [CouponController::class, 'add_coupon']);
    Route::get('/admin/danh-sach-ma-giam-gia', [CouponController::class, 'list_coupon']);
    Route::get('/admin/xoa-ma-giam-gia/{coupon_id}', [CouponController::class, 'delete_coupon']);
    Route::post('/admin/luu-ma-giam-gia', [CouponController::class, 'save_coupon']);
});


// ---------------------------------------- Delivery Controller ----------------------------------------
Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/admin/van-chuyen', [DeliveryController::class, 'delivery']);
    Route::post('/admin/them-van-chuyen', [DeliveryController::class, 'add_delivery']);
    Route::post('/admin/cap-nhat-van-chuyen', [DeliveryController::class, 'update_delivery']);
    Route::post('/admin/danh-sach-van-chuyen', [DeliveryController::class, 'select_delivery']);
    Route::post('/admin/danh-sach-phi-van-chuyen', [DeliveryController::class, 'select_feeship']);
});


// ---------------------------------------- Gallery Controller ----------------------------------------
Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/admin/thu-vien-anh/{product_id}', [GalleryController::class, 'add_gallery']);
    Route::post('/admin/xoa-hinh-anh', [GalleryController::class, 'delete_gallery']);
    Route::post('/admin/luu-anh{pro_id}', [GalleryController::class, 'insert_gallery']);
    Route::post('/admin/hien-thi-thu-vien-anh', [GalleryController::class, 'select_gallery']);
    Route::post('/admin/cap-nhat-ten-anh', [GalleryController::class, 'update_gallery_name']);
});


// ---------------------------------------- Home Controller ----------------------------------------
Route::get('/', [HomeController::class, 'index']);
Route::get('/tim-kiem', [HomeController::class, 'search']);
Route::post('/autocomplete-ajax', [HomeController::class, 'autocomplete_ajax']);


// ---------------------------------------- Mail Controller ----------------------------------------
// Route::get('/gui-mail', [MailController::class, 'send_mail']);


// ---------------------------------------- Message Controller ----------------------------------------
Route::get('/admin/chinh-sua-mail', [MessageController::class, 'edit_mail']);
Route::get('/admin/tin-nhan-lien-he', [MessageController::class, 'mess_with_us']);
Route::get('/admin/gui-mail-phan-hoi/{mess_id}', [MessageController::class, 'send_mail']);
Route::get('/admin/cap-nhat-tin-nhan/{mess_id}', [MessageController::class, 'update_message']);
Route::post('/lien-he-chung-toi', [MessageController::class, 'contact_with_us']);


// ---------------------------------------- Order Controller ----------------------------------------
Route::get('/admin/don-hang', [OrderController::class, 'manage_order']);
Route::get('/admin/in-don-hang/{checkout_code}', [OrderController::class, 'print_order']);
Route::get('/admin/don-hang/xem-don-hang/{order_code}', [OrderController::class, 'view_order']);
Route::post('/admin/don-hang/xem-don-hang/cap-nhat-so-luong-don-hang', [OrderController::class, 'update_order_qty']);
Route::post('/admin/don-hang/xem-don-hang/cap-nhat-tinh-trang-don-hang', [OrderController::class, 'update_order_status']);


// ---------------------------------------- Post Controller ----------------------------------------
Route::get('/bai-viet/{post_slug}', [PostController::class, 'show_post']);
Route::get('/danh-muc-bai-viet/{post_slug}', [PostController::class, 'show_category_post']);

Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/admin/xoa-bai-viet/{post_id}', [PostController::class, 'delete_post']);
});
Route::get('/admin/them-bai-viet', [PostController::class, 'add_post']);
Route::get('/admin/danh-sach-bai-viet', [PostController::class, 'list_post']);
Route::get('/admin/danh-muc-bai-viet', [PostController::class, 'list_category_post']);
Route::get('/admin/chinh-sua-bai-viet/{post_id}', [PostController::class, 'edit_post']);
Route::post('/admin/luu-bai-viet', [PostController::class, 'save_post']);
Route::post('/admin/cap-nhat-bai-viet/{post_id}', [PostController::class, 'update_post']);


// ---------------------------------------- Product Controller ----------------------------------------
Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/admin/them-san-pham', [ProductController::class, 'add_product']);
    Route::get('/admin/danh-sach-san-pham', [ProductController::class, 'list_product']);
    Route::get('/admin/xoa-san-pham/{product_id}', [ProductController::class, 'delete_product']);
    Route::get('/admin/chinh-sua-san-pham/{product_id}', [ProductController::class, 'edit_product']);
    Route::get('/admin/kich-hoat-san-pham/{product_id}', [ProductController::class, 'active_product']);
    Route::get('/admin/ngung-kich-hoat-san-pham/{product_id}', [ProductController::class, 'unactive_product']);
    Route::post('/admin/luu-san-pham', [ProductController::class, 'save_product']);
    Route::post('/admin/cap-nhat-san-pham/{product_id}', [ProductController::class, 'update_product']);

    Route::get('/file-browser', [ProductController::class, 'file_browser']);
    Route::post('/uploads-ckeditor', [ProductController::class, 'ckeditor_image']);

});
Route::get('/admin/binh-luan', [ProductController::class, 'list_comment']);
Route::get('/admin/an-binh-luan/{comment_id}', [ProductController::class, 'hide_comment']);
Route::get('/admin/hien-thi-binh-luan/{comment_id}', [ProductController::class, 'shows_comment']);
Route::post('/admin/tra-loi-binh-luan', [ProductController::class, 'reply_comment']);

Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'details_product']);
Route::post('/gui-binh-luan', [ProductController::class, 'send_comment']);
// Route::post('/danh-gia-sao', [ProductController::class, 'insert_rating']);
Route::post('/hien-thi-binh-luan', [ProductController::class, 'load_comment']);


// ---------------------------------------- User Controller ----------------------------------------
Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/admin/nguoi-dung', [UserController::class, 'index']);
});
Route::group(['middleware' => 'admin.roles'], function() {
    Route::get('/admin/them-nguoi-dung', [UserController::class, 'add_user']);
    Route::get('/admin/xoa-nguoi-dung/{admin_id}', [UserController::class, 'delete_user_roles']);
    Route::get('/admin/chuyen-quyen/{admin_id}', [UserController::class, 'users_transfer']);
    Route::post('/admin/phan-quyen', [UserController::class, 'assign_roles']);
    Route::post('/admin/luu-nguoi-dung', [UserController::class, 'store_users']);
});
Route::get('/admin/ngung-chuyen-quyen', [UserController::class, 'users_transfer_destroy']);


// ---------------------------------------- Videos Controller ----------------------------------------
Route::get('/admin/danh-sach-video', [VideosController::class, 'list_video']);
Route::post('/admin/them-video', [VideosController::class, 'insert_video']);
Route::post('/admin/hien-thi-video', [VideosController::class, 'select_video']);
Route::group(['middleware' => 'auth.roles'], function() {
    Route::post('/admin/xoa-video', [VideosController::class, 'delete_video']);
});

