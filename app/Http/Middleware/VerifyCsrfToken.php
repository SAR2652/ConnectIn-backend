<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [ "http://192.168.0.107/ConnectIn-backend/public/api/socialLogin/*",
    "http://192.168.0.107/ConnectIn-backend/public/api/createUserPack/*",
    "http://192.168.0.107/ConnectIn-backend/public/api/getUserPackDetails/*",
    "http://192.168.0.107/ConnectIn-backend/public/api/getPackTournamentDetails/*",
    "http://192.168.0.107/ConnectIn-backend/public/api/registerPackForTournament/*",
    ];
}
