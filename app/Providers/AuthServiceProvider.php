<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    //variable utk permission author
    public static $permission = [
       'dashboard'=>[ 'superadmin','admin'],
       'user-index'=> ['admin']
    ];

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach(self::$permission as $feature => $roles){
            Gate::define($feature, function(User $user) use($roles) {
            if (in_array($user->role , $roles)){
                return true;
            }
        });
        }


    }
}
