<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\PaymentEntity;
use App\Models\PaymentModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

class PaymentsController extends BaseController
{
    use ResponseTrait;

    public function get(): Response
    {
        $id = $this->request->getGet('id', filter: FILTER_SANITIZE_NUMBER_INT);
        $customer_id = $this->request->getGet('customerId', filter: FILTER_SANITIZE_NUMBER_INT);

        try {
            $results = model(PaymentModel::class)->search(
                id: $id,
                customer_id: $customer_id
            );

        } catch (\Throwable $e) {
            $results = [];

            $this->logger->error(sprintf(
                'MESSAGE: %s, FILE: %s, LINE: %s',
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ));
        }
        return $this->response->setStatusCode(Response::HTTP_OK)
        ->setJSON($results);
    }

    public function save(): Response
    {
        if (! $this->validate('payments'))
        {
            return $this->response->setJSON(
                $this->validator->getErrors()
            );
        }
        $payment = new PaymentEntity($this->validator->getValidated());

        try {
            if (! model(PaymentModel::class)->create($payment))
            {
                return $this->failServerError();
            }
        } catch (\Throwable $e) {

            $this->logger->error(sprintf(
                'MESSAGE: %s, FILE: %s, LINE: %s',
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ));
        }

        return $this->respondCreated();
    }
}
