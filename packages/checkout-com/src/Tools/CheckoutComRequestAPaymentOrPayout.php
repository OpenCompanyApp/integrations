<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Request a payment or payout.
 *
 * Maps to the official Checkout.com endpoint POST /payments.
 */
class CheckoutComRequestAPaymentOrPayout extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_request_a_payment_or_payout';
    protected const DESCRIPTION = 'Send a payment or payout.Note: successful payout requests will always return a 202 response.

Official Checkout.com endpoint: POST /payments.';
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
    protected const PATH = '/payments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Cko-Idempotency-Key' => 'cko_idempotency_key',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
