<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\UploadPolicy;
use App\Models\Upload;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    // protected $policies = [
    //     //把PostPolicy这个策略类注册到Post模型
    //     'App\Post' => 'App\Policies\PostPolicy'
    // ];

    /**
     * Bootstrap any application services.
     */

    
    public function boot()
    {
    
        Gate::policy(Upload::class, UploadPolicy::class);
    }
    
}
