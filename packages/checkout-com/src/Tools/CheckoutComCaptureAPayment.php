<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Capture a payment.
 *
 * Maps to the official Checkout.com endpoint POST /payments/{id}/captures.
 */
class CheckoutComCaptureAPayment extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_capture_a_payment';
    protected const DESCRIPTION = 'Captures a payment if supported by the payment method. For card payments, capture requests are processed asynchronously. You can use [workflows](#tag/Workflows) to be notified if the capture is successful.

Official Checkout.com endpoint: POST /payments/{id}/captures.';
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
    protected const PATH = '/payments/{id}/captures';
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
