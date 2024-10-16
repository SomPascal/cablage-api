<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CustomersMigration extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
                'unique' => true,
                'null' => false
            ],

            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],

            'surname' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],

            'subscription' => [
                'type' => 'INT',
                'null' => false
            ],

            'phoneNumber' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false
            ],

            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false
            ],

            'sex' => [
                'type' => 'ENUM',
                'constraint' => ['Male', 'Female'],
                'null' => false
            ],

            'picture' => [
                'type' => 'INT',
                'null' => false
            ],

            'statePayment' => [
                'type' => 'ENUM',
                'constraint' => ['BeingPaid', 'LatePayment', 'UpToDate'],
                'null' => false
            ],

            'bankAccount' => [
                'type' => 'INT',
                'null' => false
            ],

            'registrationDate' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false
            ],

            'language' => [
                'type' => 'ENUM',
                'constraint' => ['French', 'English'],
                'null' => false
            ]
        ];

        $this->forge->addPrimaryKey(key: 'id')
        ->addField($fields)
        ->createTable('customers', true);

    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
