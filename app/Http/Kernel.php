<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;


class Kernel extends HttpKernel{


/**
 * The application's global HTTP middleware stack.
 *
 * @var array
 */
protected $middleware = [
    \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \App\Http\Middleware\EncryptCookies::class,
    \App\Http\Middleware\ClearViewCache::class,
    \App\Http\Middleware\VerifyCsrfToken::class,
    \App\Http\Middleware\MaintenanceMode::class,
    \Spatie\Pjax\Middleware\FilterIfPjax::class,
];

/**
 * The application's route middleware.
 *
 * @var array
 */
protected $routeMiddleware = [
    'Admin' => \App\Http\Middleware\Admin::class,
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
];

}