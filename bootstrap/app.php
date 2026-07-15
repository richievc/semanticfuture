<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuthenticate::class,
        ]);

        // PayPal's IPN postback is a server-to-server form POST with no
        // Laravel session/CSRF token attached, so it must be excluded from
        // CSRF verification. It's still authenticated in its own way — see
        // App\Services\PayPalIpnVerifier, which re-verifies every postback
        // directly with PayPal before anything in it is trusted.
        $middleware->validateCsrfTokens(except: [
            'webhooks/paypal',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
