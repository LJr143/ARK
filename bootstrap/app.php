<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'failed.login.toast' => \App\Http\Middleware\FlashFailedLoginToast::class,
            'redirect.auth' => \App\Http\Middleware\RedirectMiddleware::class,
            'check.superadmin' =>\App\Http\Middleware\SuperAdminChecker::class,
            'admin.auth' => \App\Http\Middleware\AdminAuth::class,
            'member.auth' => \App\Http\Middleware\MemberAuth::class,
            'user.status' => \App\Http\Middleware\CheckUserStatus::class,
        ]);
        $middleware->web(append: [
            \App\Http\Middleware\FlashFailedLoginToast::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->withSchedule(function (Schedule $schedule) {
        $schedule->command('fiscal-year:check')->everyMinute();
        $schedule->command('reminders:update-statuses')->everyMinute();
    })->create();
