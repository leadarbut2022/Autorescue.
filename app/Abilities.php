<?php

namespace App ;

use Illuminate\Support\Facades\Gate;



class Abilities
{
    public function register()
    {
        Gate::define('view-posts', function ($user) {
            return $user->hasRole('admin'); // replace with your own logic
        });
    }
}
