<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use Config\Services;

class ErrorController extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->response = Services::response();
    }

    public function notFound(): Response
    {
        return $this->failNotFound();
    }
}
