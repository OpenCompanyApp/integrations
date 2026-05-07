<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Initiate a transfer of funds.
 *
 * Maps to the official Checkout.com endpoint POST /transfers.
 */
class CheckoutComCreateTransfer extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_transfer';
    protected const DESCRIPTION = 'Initiate a transfer of funds from source entity to destination entity.

Official Checkout.com endpoint: POST /transfers.';
    protected const PARAMETERS = [
        'cko_idempotency_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'An idempotency key for safely retrying transfer requests',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/transfers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Cko-Idempotency-Key' => 'cko_idempotency_key',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
