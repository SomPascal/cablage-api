<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Security as SecurityConfig;
use App\Database\Migrations\PaymentsMigration;

class DraftController extends BaseController
{
    public function token(): string
    {
        $securityConfig = new SecurityConfig();

        return password_hash(
            password: $securityConfig->authToken,
            algo: PASSWORD_BCRYPT
        );
    }
}
