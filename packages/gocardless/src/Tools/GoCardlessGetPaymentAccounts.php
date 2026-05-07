<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single payment account details.
 *
 * Maps to the official GoCardless endpoint GET /payment_accounts/{payment_account_id}.
 */
class GoCardlessGetPaymentAccounts extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_payment_accounts';
    protected const DESCRIPTION = 'Retrieves the details of an existing payment account.

Official GoCardless endpoint: GET /payment_accounts/{payment_account_id}.';
    protected const PARAMETERS = [
        'payment_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payment account id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payment_accounts/{payment_account_id}';
    protected const PATH_PARAMS = [
        'payment_account_id' => 'payment_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
