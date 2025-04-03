<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\EmailStorageService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(EmailStorageService::class, function () {
            return new EmailStorageService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
