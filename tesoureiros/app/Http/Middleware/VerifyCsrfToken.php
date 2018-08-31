<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */

    protected $except = [
        'http://notifygrace.herokuapp.com/public/*',
        'https://notifygrace.herokuapp.com/public/*',
        'http://notifygrace.herokuapp.com/*',
        'https://notifygrace.herokuapp.com/*',
        'http://localhost:8000/*',
    ];
}
