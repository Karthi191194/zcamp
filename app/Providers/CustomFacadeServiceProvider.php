<?php
/**
 * custom facades #3
 * User: karthick
 * Date: 12/26/2018
 * Time: 6:30 PM
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\CustomFacade;

class CustomFacadeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('customfacade', function () {
            return new CustomFacade;
        });
    }
}

// the first argument in bind is normal class not facade class (ie. abstract)