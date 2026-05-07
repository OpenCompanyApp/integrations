<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single redirect flow.
 *
 * Maps to the official GoCardless endpoint GET /redirect_flows/{redirect_flow_id}.
 */
class GoCardlessGetRedirectFlows extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_redirect_flows';
    protected const DESCRIPTION = 'Returns all details about a single redirect flow **Deprecated:** Redirect Flows are legacy APIs and cannot be used by new integrators. The [Billing Request flow](#billing-requests) API should be used for your payment flows.

Official GoCardless endpoint: GET /redirect_flows/{redirect_flow_id}.';
    protected const PARAMETERS = [
        'redirect_flow_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The redirect flow id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/redirect_flows/{redirect_flow_id}';
    protected const PATH_PARAMS = [
        'redirect_flow_id' => 'redirect_flow_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
