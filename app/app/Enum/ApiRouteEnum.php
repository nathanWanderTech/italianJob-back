<?php

namespace App\Enum;

class ApiRouteEnum
{
    // Auth route
    const LOGIN_ROUTE = '/api/auth/login';
    const LOGOUT_ROUTE = '/api/auth/logout';
    const FORGOT_PASSWORD_ROUTE = 'api/auth/forgot-password';

    // User route
    const REGISTER_USER_ROUTE = 'api/users';
}
