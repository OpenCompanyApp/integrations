<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Increment authorization.
 *
 * Maps to the official Checkout.com endpoint POST /payments/{id}/authorizations.
 */
class CheckoutComIncrementPaymentAuthorization extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_increment_payment_authorization';
    protected const DESCRIPTION = 'Request an incremental authorization to increase the authorization amount or extend the authorization\'s validity period.

Official Checkout.com endpoint: POST /payments/{id}/authorizations.';
    protected const PARAMETERS = [
        'cko_idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'An optional idempotency key for safely retrying payment requests',
        ],
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payment identifier',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/payments/{id}/authorizations';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Cko-Idempotency-Key' => 'cko_idempotency_key',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
