<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create an outbound payment.
 *
 * Maps to the official GoCardless endpoint POST /outbound_payments.
 */
class GoCardlessCreateOutboundPayment extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_outbound_payment';
    protected const DESCRIPTION = 'Create an outbound payment

Official GoCardless endpoint: POST /outbound_payments.';
    protected const PARAMETERS = [
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
    protected const PATH = '/outbound_payments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
