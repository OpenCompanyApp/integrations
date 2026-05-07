<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Disable a customer bank account.
 *
 * Maps to the official GoCardless endpoint POST /customer_bank_accounts/{customer_bank_account_id}/actions/disable.
 */
class GoCardlessDisableCustomerBankAccount extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_disable_customer_bank_account';
    protected const DESCRIPTION = 'Immediately cancels all associated mandates and cancellable payments. This will return a `disable_failed` error if the bank account has already been disabled. A disabled bank account can be re-enabled by creating a new bank account resource with the same details.

Official GoCardless endpoint: POST /customer_bank_accounts/{customer_bank_account_id}/actions/disable.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/customer_bank_accounts/{customer_bank_account_id}/actions/disable';
    protected const PATH_PARAMS = [
        'customer_bank_account_id' => 'customer_bank_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
