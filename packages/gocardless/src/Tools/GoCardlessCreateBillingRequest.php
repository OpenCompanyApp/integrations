<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a Billing Request.
 *
 * Maps to the official GoCardless endpoint POST /billing_requests.
 */
class GoCardlessCreateBillingRequest extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_billing_request';
    protected const DESCRIPTION = '<p class="notice"><strong>Important</strong>: All properties associated with `subscription_request` and `instalment_schedule_request` are only supported for ACH and PAD schemes.</p>

Official GoCardless endpoint: POST /billing_requests.';
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
    protected const PATH = '/billing_requests';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
