<?php

namespace Warcott\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Warcott\Client
 */
class WarcottClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'warcottApi';
    }
}
