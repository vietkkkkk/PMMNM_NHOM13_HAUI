<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\PartnerModel;
use App\Models\ProductModel;
use App\Models\StatisticModel;
use App\Models\VideosModel;
use App\Models\VisitorsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use FontLib\Table\Type\post;

class AdminController extends Controller {
    
    public function AuthLogin() { //Kiểm tra đăng nhập Admin

        $admin_id = Auth::id();
        if($admin_id) {
            return redirect('/admin');
        } else {
            return redirect('/admin/dang-nhap')->send();
        }
    }
    
    public function show_dashboard(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $user_ip_address = $request->ip();

        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $one_year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $visitor_of_last_month = VisitorsModel::whereBetween('date_visitor', [$early_last_month, $end_of_last_month])->get();
        $visitor_last_month_count = $visitor_of_last_month->count();

        $visitor_of_this_month = VisitorsModel::whereBetween('date_visitor', [$early_this_month, $now])->get();
        $visitor_this_month_count = $visitor_of_this_month->count();

        $visitor_of_year = VisitorsModel::whereBetween('date_visitor', [$one_year, $now])->get();
        $visitor_year_count = $visitor_of_year->count();

        $visitors = VisitorsModel::all();
        $visitor_total = $visitors->count();

        $visitors_current = VisitorsModel::where('ip_address', $user_ip_address)->where('date_visitor', $now)->get();
        $visitor_count = $visitors_current->count();
        if($visitor_count < 1) {
            $visitor = new VisitorsModel();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
            return redirect('/admin');
        }

        $total_income = OrderModel::where('order_status', 2)->sum('total_payment');
        $product_count = ProductModel::all()->count();
        $post_count = PostModel::all()->count();
        $order_count = OrderModel::all()->count();
        $video_count = VideosModel::all()->count();
        $partner_count = PartnerModel::all()->count();
        $customer_count = CustomerModel::count();
        return view('admin.dashboard')->with(compact('visitor_count', 'visitor_last_month_count',
        'visitor_this_month_count', 'visitor_year_count', 'visitor_total', 'total_income',
        'product_count', 'post_count', 'order_count', 'video_count', 'partner_count', 'customer_count'));
    }
}
