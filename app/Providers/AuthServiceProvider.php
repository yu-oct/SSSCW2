<?php

namespace App\Providers;
use App\Policies\AdminUserPolicy;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\AuthPolicy;
use App\Policies\UploadPolicy;
use App\Models\Upload; // 确保引入 Upload 模型
use Illuminate\Support\Facades\Gate; // 引入 Gate
use App\Models\Feedback;
use App\Policies\FeedbackPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => AdminUserPolicy::class,
        Upload::class => UploadPolicy::class,
        Feedback::class => FeedbackPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function (User $user) {
            return $user->isAdmin(); // An isAdmin Gate is defined using Gate::define to check if a user is an administrator.
        });
    }
}
