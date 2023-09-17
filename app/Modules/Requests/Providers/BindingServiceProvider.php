<?php

namespace App\Modules\Requests\Providers;

use App\Modules\Requests\Interfaces\RequestServiceInterface;
use App\Modules\Requests\Services\RequestService;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RequestServiceInterface::class, RequestService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
