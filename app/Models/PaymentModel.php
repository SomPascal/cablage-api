<?php

namespace App\Models;

use App\Entities\PaymentEntity;
use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table            = 'payments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = 
    [
        'customerId', 'amount', 'paymentMethod',
        'datePayment', 'hourPayment'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = 'payments';
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

    public function create(PaymentEntity $payment): bool
    {
        return $this->insert($payment, false);   
    }

    public function search(?int $id=null, ?int $customer_id=null): array
    {
        $id_statement = isset($id) ? ['id' => $id] : [];
        $customer_id_statement = isset($customer_id) ? ['customerId' => $customer_id] : [];

        $statement = array_merge($id_statement, $customer_id_statement);
        $limit = isset($id) ? 1 : 200;

        return $this->select()
        ->limit(1)
        ->where($statement)
        ->findAll(limit: $limit);
    }
}
