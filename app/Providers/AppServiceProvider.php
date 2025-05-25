<?php

namespace App\Providers;

use App\Models\Redacao;
use App\Observers\RedacaoObserver;
use Illuminate\Support\ServiceProvider;
use Anhskohbo\NoCaptcha\Rules\Captcha;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * 
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Redacao::observe(RedacaoObserver::class);
    }
}
