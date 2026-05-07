<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get a single transaction.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/transactions/{transactionId}.
 */
class CheckoutComGetTransactionById extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_transaction_by_id';
    protected const DESCRIPTION = 'Beta Get the details of a transaction using its ID.

Official Checkout.com endpoint: GET /issuing/transactions/{transactionId}.';
    protected const PARAMETERS = [
        'transaction_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'transactionId',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/transactions/{transactionId}';
    protected const PATH_PARAMS = [
        'transactionId' => 'transaction_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
