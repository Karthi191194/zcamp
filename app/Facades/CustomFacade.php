<?php
/**
 * custom facades #2
 * User: karthick
 * Date: 12/26/2018
 * Time: 6:04 PM
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CustomFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'customfacade';
    }
}