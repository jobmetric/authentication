<?php

namespace JobMetric\Authentication\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @see \JobMetric\Authentication\AuthenticationService
 */
class AuthenticationService extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor()
    {
        return 'AuthenticationService';
    }
}
