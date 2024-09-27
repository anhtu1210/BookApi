<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     // Tắt bao quanh data mặc định của resource (cho dữ liệu trả về gọn hơn)
    //     Resource::withoutWrapping();
    // }
    public function register()
    {
        //
    }
}
