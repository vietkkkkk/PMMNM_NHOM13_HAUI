<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use App\Models\VideosModel;
use App\Models\SliderModel;
use App\Models\ProductModel;
use App\Models\PartnerModel;
use App\Models\MessageModel;
use App\Models\CatePostModel;
use App\Models\CategoriesModel;
session_start();

class HomeController extends Controller
{
    public function index(Request $request) {

        // SEO
        $meta_keywords = "trai cay mien tay, trái cây miền tây, trái cây";
        $meta_title = "PT Fruit - Thương hiệu trái cây miền Tây số 1 Việt Nam";
        $meta_desc = "Đơn vị chuyên phân phối sỉ và lẻ trái cây miền Tây với chất lượng và giá cả tốt nhất thị trường";
        $url_canonical = $request->url();
        // END SEO
        
        $video = VideosModel::orderby('video_id', 'desc')->get();
        $slider = SliderModel::orderby('slider_id', 'desc')->get();
        $partner = PartnerModel::orderby('partner_id', 'desc')->get();
        $post = PostModel::with('cate_post')->where('post_status', 0)->get();
        $category_post = CatePostModel::orderby('cate_post_id', 'desc')->get();
        $category_product = CategoriesModel::where('category_status', 1)->orderBy('category_name', 'asc')->get();
        $list_product = ProductModel::where('product_status', 1)->orderBy('product_id', 'desc')->get();
        $product_viet = ProductModel::where('product_status', 1)->where('category_id', 30)->orderBy('product_id', 'desc')->get();
        $product_minhphuong = ProductModel::where('product_status', 1)->where('category_id', 27)->orderBy('product_id', 'desc')->get();
        $product_gio = ProductModel::where('product_status', 1)->where('category_id', 23)->orderBy('product_id', 'desc')->get();
        $product_hop = ProductModel::where('product_status', 1)->where('category_id', 24)->orderBy('product_id', 'desc')->get();

        return view('pages.home')->with(compact('meta_keywords', 'meta_title', 'meta_desc', 'url_canonical', 'video',
        'slider', 'partner', 'post', 'category_post', 'list_product', 'category_product', 'product_viet', 'product_minhphuong', 'product_gio', 'product_hop'));
    }

    public function search(Request $request) {
        
        $keywords = $request->keyword_submit;
        // SEO
        $meta_title = "Kết quả tìm kiếm";
        $meta_keywords = "trai cay mien tay, trái cây miền tây, trái cây";
        $meta_desc = "Đơn vị chuyên phân phối sỉ và lẻ trái cây miền Tây với chất lượng và giá cả tốt nhất thị trường";
        $url_canonical = $request->url();
        // END SEO

        $category_post = CatePostModel::orderby('cate_post_id', 'desc')->get();
        $category_product = CategoriesModel::where('category_status', '1')->orderBy('category_name', 'asc')->get();
        $search_product = ProductModel::where('product_status', 1)->where('product_name', 'like', '%'.$keywords.'%')->get();

        return view('pages.product.search')->with(compact('category_product', 'search_product',
        'meta_desc', 'category_post', 'meta_keywords', 'meta_title', 'url_canonical'));
    }

    public function autocomplete_ajax(Request $request) {
        $data = $request->all();
        if($data['query']) {
            $product = ProductModel::where('product_status', 1)->where('product_name', 'LIKE', '%'.$data['query'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display: block; position: relative;">';
            foreach($product as $key => $val) {
                $output.='<li class="li_search_ajax"><a class="text-grape" href="#">'.$val->product_name.'</a></li>';
            }
            $output.='</ul>';
            echo $output;
        }
    }
}
