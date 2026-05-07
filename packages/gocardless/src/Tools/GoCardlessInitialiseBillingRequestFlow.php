<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Initialise a Billing Request Flow.
 *
 * Maps to the official GoCardless endpoint POST /billing_request_flows/{billing_request_flow_id}/actions/initialise.
 */
class GoCardlessInitialiseBillingRequestFlow extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_initialise_billing_request_flow';
    protected const DESCRIPTION = 'Returns the flow having generated a fresh session token which can be used to power integrations that manipulate the flow.

Official GoCardless endpoint: POST /billing_request_flows/{billing_request_flow_id}/actions/initialise.';
    protected const PARAMETERS = [
        'billing_request_flow_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The billing request flow id',
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
    protected const PATH = '/billing_request_flows/{billing_request_flow_id}/actions/initialise';
    protected const PATH_PARAMS = [
        'billing_request_flow_id' => 'billing_request_flow_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
