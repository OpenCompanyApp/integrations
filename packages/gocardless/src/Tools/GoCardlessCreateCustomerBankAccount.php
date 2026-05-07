<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a customer bank account.
 *
 * Maps to the official GoCardless endpoint POST /customer_bank_accounts.
 */
class GoCardlessCreateCustomerBankAccount extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_customer_bank_account';
    protected const DESCRIPTION = 'Creates a new customer bank account object. There are three different ways to supply bank account details: - [Local details](#appendix-local-bank-details) - IBAN - [Customer Bank Account Tokens](#javascript-flow-create-a-customer-bank-account-token) For more information on the different fields required in each country, see [local bank details](#appendix-local-bank-details).

Official GoCardless endpoint: POST /customer_bank_accounts.';
    protected const PARAMETERS = [
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
    protected const PATH = '/customer_bank_accounts';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
