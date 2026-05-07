<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a bank account holder verification..
 *
 * Maps to the official GoCardless endpoint POST /bank_account_holder_verifications.
 */
class GoCardlessCreateBankAccountHolderVerification extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_bank_account_holder_verification';
    protected const DESCRIPTION = 'Verify the account holder of the bank account. A complete verification can be attached when creating an outbound payment. This endpoint allows partner merchants to create Confirmation of Payee checks on customer bank accounts before sending outbound payments.

Official GoCardless endpoint: POST /bank_account_holder_verifications.';
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
    protected const PATH = '/bank_account_holder_verifications';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
