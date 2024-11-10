<?php

namespace Aardvark;

class DeferredConfig
{
    /**
     * Create a new deferred config instance.
     *
     * @param  callable  $callback
     * @return void
     */
    public function __construct(public $callback)
    {
        //
    }

    /**
     * Invoke the deferred config.
     *
     * @return mixed
     */
    public function __invoke()
    {
        return call_user_func($this->callback);
    }
}
