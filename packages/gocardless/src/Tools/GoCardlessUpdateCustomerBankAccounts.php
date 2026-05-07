<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update a customer bank account.
 *
 * Maps to the official GoCardless endpoint PUT /customer_bank_accounts/{customer_bank_account_id}.
 */
class GoCardlessUpdateCustomerBankAccounts extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_customer_bank_accounts';
    protected const DESCRIPTION = 'Updates a customer bank account object. Only the metadata parameter is allowed.

Official GoCardless endpoint: PUT /customer_bank_accounts/{customer_bank_account_id}.';
    protected const PARAMETERS = [
        'customer_bank_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The customer bank account id',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GoCardless OpenAPI schema.',
        ],
        'idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/customer_bank_accounts/{customer_bank_account_id}';
    protected const PATH_PARAMS = [
        'customer_bank_account_id' => 'customer_bank_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
