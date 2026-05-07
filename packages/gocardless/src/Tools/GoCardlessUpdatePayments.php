<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update a payment.
 *
 * Maps to the official GoCardless endpoint PUT /payments/{payment_id}.
 */
class GoCardlessUpdatePayments extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_payments';
    protected const DESCRIPTION = 'Updates a payment object. This accepts only the metadata parameter.

Official GoCardless endpoint: PUT /payments/{payment_id}.';
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
    protected const METHOD = 'PUT';
    protected const PATH = '/payments/{payment_id}';
    protected const PATH_PARAMS = [
        'payment_id' => 'payment_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
