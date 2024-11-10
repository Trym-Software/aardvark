<?php

use Aardvark\DeferredConfig;

test('deferred config', function () {
    $config = new DeferredConfig(fn () => 'test');

    expect($config())->toBe('test');
});
