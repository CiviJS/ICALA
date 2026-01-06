<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use App\Observers\EventosObserver;
use App\Models\Evento;
class AppServiceProvider extends ServiceProvider
{


=======

class AppServiceProvider extends ServiceProvider
{
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
    /**
     * Register any application services.
     */H
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD


        Evento::observe(EventosObserver::class);

        Validator::extend('alpha_spaces', function ($attribute, $value, $parameters, $validator) {
        return preg_match('/^[\pL\s]+$/u', $value);});
        RateLimiter::for('login', function (Request $request) {
        return Limit::perMinute(5,10)->by($request->ip())->response(function (Request $request, array $headers) {
        return back()->withErrors([
            'throttle' => 'Demasiados intentos. Por favor, intente mas tarde.'
        ])->withInput();
    });
        });
=======
       Validator::extend('alpha_spaces', function ($attribute, $value, $parameters, $validator) {
        return preg_match('/^[\pL\s]+$/u', $value);
    });
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
    if (config('app.env') === 'production') {
        URL::forceScheme('https');
    }
    }
}
