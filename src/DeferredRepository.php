<?php

namespace Aardvark;

use Illuminate\Config\Repository;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;

class DeferredRepository extends Repository
{
    protected array $deferred = [];

    protected bool $resolved = false;

    public function __construct(array $items = [])
    {
        app()->afterBootstrapping(LoadConfiguration::class, fn () => $this->resolve());

        parent::__construct($items);
    }

    /**
     * Set a given configuration value.
     *
     * @param  array|string  $key
     * @param  mixed  $value
     * @return void
     */
    public function set($key, $value = null)
    {
        if ($value instanceof DeferredConfig) {
            $deferred[] = $key;
        }

        parent::set($key, $value);
    }

    /**
     * Get the specified configuration value.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (! $this->resolved) {
            return new DeferredConfig(fn () => parent::get($key, $default));
        }

        return parent::get($key, $default);
    }

    /**
     * Resolve the deferred configurations.
     */
    public function resolve()
    {
        foreach ($this->deferred as $key) {
            $this->set($key, $this->get($key)());
        }

        $this->resolved = true;
    }
}
