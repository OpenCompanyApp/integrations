<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Refund a payment.
 *
 * Maps to the official Checkout.com endpoint POST /payments/{id}/refunds.
 */
class CheckoutComRefundAPayment extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_refund_a_payment';
    protected const DESCRIPTION = 'Refunds a payment if supported by the payment method. For card payments, refund requests are processed asynchronously. You can use [workflows](#tag/Workflows) to be notified if the refund is successful.

Official Checkout.com endpoint: POST /payments/{id}/refunds.';
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
    protected const PATH = '/payments/{id}/refunds';
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
