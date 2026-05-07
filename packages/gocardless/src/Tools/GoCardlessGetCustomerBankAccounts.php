<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single customer bank account.
 *
 * Maps to the official GoCardless endpoint GET /customer_bank_accounts/{customer_bank_account_id}.
 */
class GoCardlessGetCustomerBankAccounts extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_customer_bank_accounts';
    protected const DESCRIPTION = 'Retrieves the details of an existing bank account.

Official GoCardless endpoint: GET /customer_bank_accounts/{customer_bank_account_id}.';
    protected const PARAMETERS = [
        'customer_bank_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The customer bank account id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/customer_bank_accounts/{customer_bank_account_id}';
    protected const PATH_PARAMS = [
        'customer_bank_account_id' => 'customer_bank_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
