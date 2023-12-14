<?php

namespace App\Providers;

use App\Models\PostModel;
use App\Models\OrderModel;
use App\Models\VideosModel;
use App\Models\ProductModel;
use App\Models\PartnerModel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        view()->composer('*', function($view) {
        
            $post_count = PostModel::all()->count();
            $order_count = OrderModel::all()->count();
            $video_count = VideosModel::all()->count();
            $partner_count = PartnerModel::all()->count();
            $product_count = ProductModel::all()->count();

            $view->with(compact('post_count', 'order_count', 'video_count', 'partner_count', 'product_count'));
        });
    }
}
