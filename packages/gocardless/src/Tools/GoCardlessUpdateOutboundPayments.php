<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update an outbound payment.
 *
 * Maps to the official GoCardless endpoint PUT /outbound_payments/{outbound_payment_id}.
 */
class GoCardlessUpdateOutboundPayments extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_outbound_payments';
    protected const DESCRIPTION = 'Updates an outbound payment object. This accepts only the metadata parameter.

Official GoCardless endpoint: PUT /outbound_payments/{outbound_payment_id}.';
    protected const PARAMETERS = [
        'outbound_payment_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The outbound payment id',
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
    protected const PATH = '/outbound_payments/{outbound_payment_id}';
    protected const PATH_PARAMS = [
        'outbound_payment_id' => 'outbound_payment_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
