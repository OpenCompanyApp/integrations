<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Cancel a scheduled retry.
 *
 * Maps to the official Checkout.com endpoint POST /payments/{id}/cancellations.
 */
class CheckoutComCancelAPayment extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_cancel_a_payment';
    protected const DESCRIPTION = 'Cancels an upcoming retry, if there is one scheduled Cancellation requests are processed asynchronously. You can use [workflows](#tag/Workflows) to be notified if the cancellation is successful.

Official Checkout.com endpoint: POST /payments/{id}/cancellations.';
    protected const PARAMETERS = [
        'cko_idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'An optional idempotency key for safely retrying payment requests',
        ],
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique payment identifier.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/payments/{id}/cancellations';
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
