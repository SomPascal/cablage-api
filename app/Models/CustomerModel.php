<?php

namespace App\Models;

use App\Entities\CustomerEntity;
use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = 
    [
        "name", "surname", "subscription",
        "phoneNumber", "address", "sex",
        "picture", "statePayment", "bankAccount",
        "registrationDate", "language"
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = 'customers';
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function search(string $searchText, ?string $statePayment=null): array
    {
        $statePayment_statement = isset($statePayment) ? ['statePayment' => $statePayment] : [];

        return $this->select()
        ->like('name', $searchText)
        ->orLike('surname', $searchText)
        ->where($statePayment_statement)
        ->findAll(200);
    }

    public function getAll(int $limit=200): array
    {
        return $this->limit($limit)
        ->select()
        ->orderBy('name', 'ASC')
        ->findAll();
    }

    public function create(CustomerEntity $customer): bool
    {
        return $this->insert($customer, false);
    }
}
