<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single Billing Request.
 *
 * Maps to the official GoCardless endpoint GET /billing_requests/{billing_request_id}.
 */
class GoCardlessGetBillingRequests extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_billing_requests';
    protected const DESCRIPTION = 'Fetches a billing request

Official GoCardless endpoint: GET /billing_requests/{billing_request_id}.';
    protected const PARAMETERS = [
        'billing_request_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The billing request id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/billing_requests/{billing_request_id}';
    protected const PATH_PARAMS = [
        'billing_request_id' => 'billing_request_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
