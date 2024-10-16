<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $helpers = 'text';

    public function index(): string
    {
        return random_string(len: 64);
    }
}
