<?php

namespace Aardvark;

use Illuminate\Support\ServiceProvider;

class AardvarkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/aadvark.php' => config_path('aadvark.php'),
        ]);
    }
}
