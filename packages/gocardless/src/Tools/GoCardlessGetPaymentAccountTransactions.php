<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single payment account transaction.
 *
 * Maps to the official GoCardless endpoint GET /payment_account_transactions/{payment_account_transaction_id}.
 */
class GoCardlessGetPaymentAccountTransactions extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_payment_account_transactions';
    protected const DESCRIPTION = 'Retrieves the details of an existing payment account transaction.

Official GoCardless endpoint: GET /payment_account_transactions/{payment_account_transaction_id}.';
    protected const PARAMETERS = [
        'payment_account_transaction_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payment account transaction id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payment_account_transactions/{payment_account_transaction_id}';
    protected const PATH_PARAMS = [
        'payment_account_transaction_id' => 'payment_account_transaction_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
