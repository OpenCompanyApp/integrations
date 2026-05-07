<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Cancel a payment.
 *
 * Maps to the official GoCardless endpoint POST /payments/{payment_id}/actions/cancel.
 */
class GoCardlessCancelPayment extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_cancel_payment';
    protected const DESCRIPTION = 'Cancels the payment if it has not already been submitted to the banks. Any metadata supplied to this endpoint will be stored on the payment cancellation event it causes. This will fail with a `cancellation_failed` error unless the payment\'s status is `pending_submission`.

Official GoCardless endpoint: POST /payments/{payment_id}/actions/cancel.';
    protected const PARAMETERS = [
        'payment_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payment id',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GoCardless OpenAPI schema.',
        ],
        'idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/payments/{payment_id}/actions/cancel';
    protected const PATH_PARAMS = [
        'payment_id' => 'payment_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
