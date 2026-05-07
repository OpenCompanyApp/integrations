<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a redirect flow.
 *
 * Maps to the official GoCardless endpoint POST /redirect_flows.
 */
class GoCardlessCreateRedirectFlow extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_redirect_flow';
    protected const DESCRIPTION = 'Creates a redirect flow object which can then be used to redirect your customer to the GoCardless hosted payment pages. **Deprecated:** Redirect Flows are legacy APIs and cannot be used by new integrators. The [Billing Request flow](#billing-requests) API should be used for your payment flows.

Official GoCardless endpoint: POST /redirect_flows.';
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
    protected const PATH = '/redirect_flows';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
