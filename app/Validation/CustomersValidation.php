<?php

namespace App\Validation;

class CustomersValidation
{
    public function phone_number($value): bool
    {
        return (bool) preg_match(
            pattern: '/^((6)?[2456789][0-9]{7})$/',
            subject: $value
        );
    }
}
