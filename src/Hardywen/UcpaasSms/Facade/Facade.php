<?php namespace Hardywen\UcpaasSms\Facade;

use Illuminate\Support\Facades\Facade;

class UcpaasSms extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ucpaas-sms';
    }

}