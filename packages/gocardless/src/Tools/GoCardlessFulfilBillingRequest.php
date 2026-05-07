<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Fulfil a Billing Request.
 *
 * Maps to the official GoCardless endpoint POST /billing_requests/{billing_request_id}/actions/fulfil.
 */
class GoCardlessFulfilBillingRequest extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_fulfil_billing_request';
    protected const DESCRIPTION = 'If a billing request is ready to be fulfilled, call this endpoint to cause it to fulfil, executing the payment.

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/fulfil.';
    protected const PARAMETERS = [
        'billing_request_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The billing request id',
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
    protected const PATH = '/billing_requests/{billing_request_id}/actions/fulfil';
    protected const PATH_PARAMS = [
        'billing_request_id' => 'billing_request_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
