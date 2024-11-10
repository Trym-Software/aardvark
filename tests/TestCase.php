<?php

namespace Aardvark\Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'Aardvark\AardvarkServiceProvider',
        ];
    }
}
