<?php

namespace App\Providers;
use App\Models\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\ServiceProvider;
use App\Abilities;
use Illuminate\Support\Facades\Gate;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        // Sanctum::defineAbility(Abilities::class);


        $this->app->singleton(Abilities::class, function () {
            return new Abilities();
        });
    
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null; // replace with your own logic
        });
    
        // $this->app->register(Abilities::class);

    }
}
