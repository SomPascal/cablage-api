<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\CustomerEntity;
use App\Models\CustomerModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Validation\Exceptions\ValidationException;
use Config\Security as SecurityConfig;
use Config\Services;

class CustomerController extends BaseController
{
    use ResponseTrait;

    public function search(): Response
    {
        $searchText = $this->request->getGet('searchText');
        $statePayment = $this->request->getGet('statePayment');

        if (empty($searchText))
        {
            $customers = [];
        }
        else
        {
            try {
                $customers = model(CustomerModel::class)->search(
                    searchText: $searchText,
                    statePayment: $statePayment
                );

            } catch (\Throwable $e) {
                $customers = [];
    
                $this->logger->error(sprintf(
                    'MESSAGE: %s, FILE: %s, LINE: %s',
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine()
                ));
            }
        }

        return $this->response->setStatusCode(Response::HTTP_OK)
        ->setJSON($customers);
    }

    public function get(): Response
    {
        $id = $this->request->getGet('id', filter: FILTER_SANITIZE_NUMBER_INT);
        $statePayment = $this->request->getGet('statePayment');

        if (isset($id))
            $id_statement = ['id' => $id];
        else $id_statement = [];

        if (isset($statePayment))
            $statePayment_statement = ['statePayment' => $statePayment];
        else $statePayment_statement = [];

        $statement = array_merge(
            $id_statement, 
            $statePayment_statement
        );

        $customerModel = model(CustomerModel::class);
        $customers = [];

        try {
            if (empty($statement)) {
                $customers = $customerModel->getAll();
            }
            else {
                $customers = $customerModel->where($statement)
                ->orderBy('name', 'ASC')
                ->findAll(limit: 200);
            }
        } catch (\Throwable $e) {

            $this->logger->error(sprintf(
                'MESSAGE: %s, FILE: %s, LINE: %s',
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ));

            return $this->failServerError();
        }

        return $this->response->setStatusCode(Response::HTTP_OK)
        ->setJSON($customers);

    }

    public function create(): Response
    {
        try {
            if (! $this->validate('customers'))
            {
                return $this->failValidationErrors(
                    errors: $this->validator->getErrors(),
                    message: 'Bad from of data'
                );
            }
        } catch (ValidationException $ve) {

            $this->logger->error(message: sprintf('MESSAGE: %s, FILE: %s, LINE: %s',
                $ve->getMessage(),
                $ve->getFile(),
                $ve->getLine()
            ));

            return $this->failServerError();
        }
        catch (\Throwable $e) {

            $this->logger->critical(message: sprintf('MESSAGE: %s, FILE: %s, LINE: %s',
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ));

            return $this->failServerError();
        }

        $customer = new CustomerEntity($this->validator->getValidated());

        try {
            if (! model(CustomerModel::class)?->create($customer))
            {
                return "hey";
                return $this->failServerError();
            }
        } catch (\Throwable $e) {

            $this->logger->error(sprintf(
                'MESSAGE: %s, FILE: %s, LINE: %s',
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ));

            return $this->failServerError();
        }

        return $this->respondCreated(['Customer Created']);
    }

    public function delete(): Response
    {
        $ids = $this->request->getJsonVar();

        foreach ($ids as $k => $id) 
        {
            if (! preg_match(pattern: '/^[0-9]{1,}$/', subject: $id))
            {
                return $this->failValidationErrors(
                    errors: [$id => 'Id should be integers']
                );
            }
        }
        
        try {
            if (! model(CustomerModel::class)->delete($ids))
            {
                return $this->failServerError();
            }
        } catch (\Throwable $e) {

            $this->logger->error(message: sprintf('MESSAGE: %s, FILE: %s, LINE: %s',
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ));

            return $this->failServerError();
        }

        return $this->respondDeleted(['Successfully Deleted']);
    }

}
