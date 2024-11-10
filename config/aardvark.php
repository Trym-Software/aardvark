<?php

use Aardvark\DeferredConfig;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;

app('config')->macro('defer', function ($key, $default = null) {
    return new DeferredConfig(fn () => $this->get($key, $default));
});

app()->afterBootstrapping(LoadConfiguration::class, function () {
    $config = app('config');
    array_walk_recursive($config, fn (&$value) => $value instanceof DeferredConfig && $value = $value());
});

return [];
