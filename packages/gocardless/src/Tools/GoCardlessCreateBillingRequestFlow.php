<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a Billing Request Flow.
 *
 * Maps to the official GoCardless endpoint POST /billing_request_flows.
 */
class GoCardlessCreateBillingRequestFlow extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_billing_request_flow';
    protected const DESCRIPTION = 'Creates a new billing request flow.

Official GoCardless endpoint: POST /billing_request_flows.';
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
    protected const PATH = '/billing_request_flows';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
