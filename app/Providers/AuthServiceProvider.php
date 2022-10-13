<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 
        Gate::define('admin',function(User $user){
            $user_roles = $user->roles;
            $roles = [];
            foreach ($user_roles as $role) {
                array_push($roles, $role->id);
            }

            return in_array(1, $roles) 
                ? Response::allow() 
                : Response::deny('You are not authorized');
        });
    }
}
