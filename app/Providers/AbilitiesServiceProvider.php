<?php

namespace App\Providers;
use App\Abilities;

use Illuminate\Support\Facades\Gate;
use App\Models\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\ServiceProvider;

class AbilitiesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {  Gate::define('view-posts', function ($user) {
        // Logic to check if user can view posts
        return true; // Or false depending on your logic
    });

    Gate::define('edit-posts', function ($user) {
        // Logic to check if user can edit posts
        return true; // Or false depending on your logic
    });
    }
}
