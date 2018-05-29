<?php

namespace App\Providers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('canEdit', function ($user, $post) {

            // Si el usuario es admin o editor puedo editar
            if($user->role == 'admin' || $user->role == 'editor') {
                return true;
            }

            // Si el user_id del post es el id del usuario puede editar
            if( $user->id == $post->user_id){
                return true;
            }

            // Si no, no puede editar
            return false;
        });
    }
}
