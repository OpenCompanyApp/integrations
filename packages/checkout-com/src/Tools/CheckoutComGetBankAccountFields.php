<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get bank account field formatting.
 *
 * Maps to the official Checkout.com endpoint GET /validation/bank-accounts/{country}/{currency}.
 */
class CheckoutComGetBankAccountFields extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_bank_account_fields';
    protected const DESCRIPTION = 'Returns the bank account field formatting required to create bank account instruments or perform payouts for the specified country and currency.

Official Checkout.com endpoint: GET /validation/bank-accounts/{country}/{currency}.';
    protected const PARAMETERS = [
        'country' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The two-letter <a href="https://www.checkout.com/docs/resources/codes/country-codes" target="_blank">ISO country code</a>',
        ],
        'currency' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The three-letter <a href="https://www.checkout.com/docs/resources/codes/currency-codes" target="_blank">ISO currency code</a>',
        ],
        'account_holder_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The type of account holder that will be used to filter the fields returned',
            'enum' => ['individual', 'corporate', 'government'],
        ],
        'payment_network' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The banking network that will be used to filter the fields returned',
            'enum' => ['local', 'sepa', 'fps', 'ach', 'fedwire', 'swift'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/validation/bank-accounts/{country}/{currency}';
    protected const PATH_PARAMS = [
        'country' => 'country',
        'currency' => 'currency',
    ];
    protected const QUERY_PARAMS = [
        'account-holder-type' => 'account_holder_type',
        'payment-network' => 'payment_network',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
