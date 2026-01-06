<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAuth;
<<<<<<< HEAD
use Illuminate\Http\Exceptions\ThrottleRequestsException;
=======
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(['check.auth'=> CheckAuth::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
<<<<<<< HEAD
        $exceptions->render(function (ThrottleRequestsException $e, $request) {
        return back()->withErrors([
            'throttle' => 'Has intentado ingresar demasiadas veces. Por seguridad, espera un momento.'
        ])->withInput();
    });
    })->create();
    
=======
   
    })->create();
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
