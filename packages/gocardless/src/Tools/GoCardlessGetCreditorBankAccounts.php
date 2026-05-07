<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single creditor bank account.
 *
 * Maps to the official GoCardless endpoint GET /creditor_bank_accounts/{creditor_bank_account_id}.
 */
class GoCardlessGetCreditorBankAccounts extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_creditor_bank_accounts';
    protected const DESCRIPTION = 'Retrieves the details of an existing creditor bank account.

Official GoCardless endpoint: GET /creditor_bank_accounts/{creditor_bank_account_id}.';
    protected const PARAMETERS = [
        'creditor_bank_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The creditor bank account id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/creditor_bank_accounts/{creditor_bank_account_id}';
    protected const PATH_PARAMS = [
        'creditor_bank_account_id' => 'creditor_bank_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
