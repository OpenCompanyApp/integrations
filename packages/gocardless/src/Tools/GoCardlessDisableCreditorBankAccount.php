<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Disable a creditor bank account.
 *
 * Maps to the official GoCardless endpoint POST /creditor_bank_accounts/{creditor_bank_account_id}/actions/disable.
 */
class GoCardlessDisableCreditorBankAccount extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_disable_creditor_bank_account';
    protected const DESCRIPTION = 'Immediately disables the bank account, no money can be paid out to a disabled account. This will return a `disable_failed` error if the bank account has already been disabled. A disabled bank account can be re-enabled by creating a new bank account resource with the same details.

Official GoCardless endpoint: POST /creditor_bank_accounts/{creditor_bank_account_id}/actions/disable.';
    protected const PARAMETERS = [
        'creditor_bank_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The creditor bank account id',
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
    protected const PATH = '/creditor_bank_accounts/{creditor_bank_account_id}/actions/disable';
    protected const PATH_PARAMS = [
        'creditor_bank_account_id' => 'creditor_bank_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
