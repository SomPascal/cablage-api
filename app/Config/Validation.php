<?php

namespace Config;

use App\Validation\CustomersValidation;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        CustomersValidation::class
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $customers = [
        'name' => 'min_length[3]|max_length[124]',
        'surname' => 'min_length[3]|max_length[124]',
        'subscription' => 'required|integer|is_natural',
        'phoneNumber' => 'required|phone_number',
        'address' => 'required|min_length[3]|max_length[124]',
        'sex' => 'required|in_list[Male,Female]',
        'picture' => 'required|integer|is_natural',
        'statePayment' => 'required|in_list[BeingPaid,LatePayment,UpToDate]',
        'bankAccount' => 'required|integer',
        'registrationDate' => 'required|valid_date[d-m-Y]',
        'language' => 'required|in_list[French,English]'
    ];

    public array $payments = [
        'customerId' => 'required|integer',
        'amount' => 'required|numeric|greater_than[0]',
        'paymentMethod' => 'required|min_length[2]|max_length[124]',
        'datePayment' => 'required|valid_date[d-M-Y]',
        'hourPayment' => 'required'
    ];
}
