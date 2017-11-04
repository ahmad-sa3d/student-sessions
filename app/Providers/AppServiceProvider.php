<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Validation rule for future day
       Validator::extend('future_day', function($attribute, $value, $parameters, $validator)
        {
            $now = Carbon::now();
            return !$now->tomorrow()->startOfDay()->gte( Carbon::createFromFormat( 'd-m-Y', $value )->startOfDay() );
        });

       Validator::replacer('future_day', function($message, $attribute, $rule, $parameters){
            if( $message && $parameters )
                return $message;
            else
                return 'date must be day in the future';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
