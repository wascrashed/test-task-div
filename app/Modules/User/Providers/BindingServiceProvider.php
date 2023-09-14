<?php

namespace App\Modules\User\Providers;

use App\Modules\User\Interfaces\AuthServiceInterface;
use App\Modules\User\Services\AuthService;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
