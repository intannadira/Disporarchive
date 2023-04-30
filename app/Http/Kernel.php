<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'role.admin' => \App\Http\Middleware\RoleAdmin::class,
        'role.supir' => \App\Http\Middleware\RoleSopir::class,
        'role.superadmin' => \App\Http\Middleware\RoleSuperAdmin::class,
        'role.admin1' => \App\Http\Middleware\RoleAdmin1::class,
        'role.admin2' => \App\Http\Middleware\RoleAdmin2::class,
        'role.admin3' => \App\Http\Middleware\RoleAdmin3::class,
        'role.user1'  => \App\Http\Middleware\RoleUser1::class,
        'role.user2'  => \App\Http\Middleware\RoleUser2::class,
        'role.user3'  => \App\Http\Middleware\RoleUser3::class,
        'role.user4'  => \App\Http\Middleware\RoleUser4::class,
        'role.user5'  => \App\Http\Middleware\RoleUser5::class,
        'role.user6'  => \App\Http\Middleware\RoleUser6::class,
        'role.user7'  => \App\Http\Middleware\RoleUser7::class,
        'role.user8'  => \App\Http\Middleware\RoleUser8::class,
        'role.user9'  => \App\Http\Middleware\RoleUser9::class,
        'role.user10' => \App\Http\Middleware\RoleUser10::class,
        'role.user11' => \App\Http\Middleware\RoleUser11::class,
        'role.user12' => \App\Http\Middleware\RoleUser12::class,
    ];
}
