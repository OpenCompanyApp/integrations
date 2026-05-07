<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get a list of transactions.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/transactions.
 */
class CheckoutComGetTransactions extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_transactions';
    protected const DESCRIPTION = 'Beta Returns a list of transactions based on the matching input parameters in reverse chronological order, with the most recent transactions shown first.

Official Checkout.com endpoint: GET /issuing/transactions.';
    protected const PARAMETERS = [
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The maximum number of transactions returned (between 10-100). The default is 10.',
        ],
        'skip' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The number of transactions to skip. The default is 0.',
        ],
        'cardholder_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'cardholder_id',
        ],
        'card_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'card_id',
        ],
        'entity_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'entity_id',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'An optional filter for the transaction lifecycle status.',
            'enum' => ['authorized', 'declined', 'canceled', 'cleared', 'refunded', 'disputed'],
        ],
        'from' => [
            'type' => 'string',
            'required' => false,
            'description' => 'An optional start date filter for transactions, in ISO 8601 format.',
        ],
        'to' => [
            'type' => 'string',
            'required' => false,
            'description' => 'An optional end date filter for transactions, in ISO 8601 format.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/transactions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'skip' => 'skip',
        'cardholder_id' => 'cardholder_id',
        'card_id' => 'card_id',
        'entity_id' => 'entity_id',
        'status' => 'status',
        'from' => 'from',
        'to' => 'to',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
