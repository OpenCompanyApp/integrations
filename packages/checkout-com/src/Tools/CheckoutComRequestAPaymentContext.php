<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Request a Payment Context.
 *
 * Maps to the official Checkout.com endpoint POST /payment-contexts.
 */
class CheckoutComRequestAPaymentContext extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_request_a_payment_context';
    protected const DESCRIPTION = 'Send a Payment Context request.Note: Successful Payment Context requests will always return a 201 response.

Official Checkout.com endpoint: POST /payment-contexts.';
    protected const PARAMETERS = [
        'cko_idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'An optional idempotency key for safely retrying payment requests',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/payment-contexts';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Cko-Idempotency-Key' => 'cko_idempotency_key',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
