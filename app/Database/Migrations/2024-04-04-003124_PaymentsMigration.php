<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaymentsMigration extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
                'null' => false,
                'unique' => true
            ],

            'customerId' => [
                'type' => 'INT',
                'null' => false,
            ],

            'amount' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false
            ],

            'paymentMethod' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false
            ],

            'datePayment' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false
            ],

            'hourPayment' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false
            ]
        ];

        $this->forge->addField($fields)
        ->addPrimaryKey(key: 'id')

        ->addForeignKey(
            fieldName: 'customerId', 
            tableName: 'customers',
            tableField: 'id'
        )
        ->createTable('payments', true);
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}
