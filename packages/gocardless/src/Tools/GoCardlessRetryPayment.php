<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Retry a payment.
 *
 * Maps to the official GoCardless endpoint POST /payments/{payment_id}/actions/retry.
 */
class GoCardlessRetryPayment extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_retry_payment';
    protected const DESCRIPTION = 'Retry a payment

Official GoCardless endpoint: POST /payments/{payment_id}/actions/retry.';
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
    protected const PATH = '/payments/{payment_id}/actions/retry';
    protected const PATH_PARAMS = [
        'payment_id' => 'payment_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
