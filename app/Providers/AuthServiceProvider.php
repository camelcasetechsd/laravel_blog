<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        /**
         *  no need for callbac functions , cause Gate automatically checks if user == null or 
         *  user object does not have forUser method
         */
        $gate->define('access_create_post', function () {
            $user = Auth::user();
            echo '<pre>';var_dump($user);exit;
        });
//        $gate->define('create_post', 'Articles\ArticlesController@store');
    }

}
