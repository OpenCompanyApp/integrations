<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List payment account transactions.
 *
 * Maps to the official GoCardless endpoint GET /payment_accounts/{payment_account_transaction_id}/transactions.
 */
class GoCardlessGetTransactionsFromPaymentAccountTransaction extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_transactions_from_payment_account_transaction';
    protected const DESCRIPTION = 'List transactions for a given payment account.

Official GoCardless endpoint: GET /payment_accounts/{payment_account_transaction_id}/transactions.';
    protected const PARAMETERS = [
        'payment_account_transaction_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payment account transaction id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payment_accounts/{payment_account_transaction_id}/transactions';
    protected const PATH_PARAMS = [
        'payment_account_transaction_id' => 'payment_account_transaction_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
