<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Complete a redirect flow.
 *
 * Maps to the official GoCardless endpoint POST /redirect_flows/{redirect_flow_id}/actions/complete.
 */
class GoCardlessCompleteRedirectFlow extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_complete_redirect_flow';
    protected const DESCRIPTION = 'Complete a redirect flow

Official GoCardless endpoint: POST /redirect_flows/{redirect_flow_id}/actions/complete.';
    protected const PARAMETERS = [
        'redirect_flow_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The redirect flow id',
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
    protected const PATH = '/redirect_flows/{redirect_flow_id}/actions/complete';
    protected const PATH_PARAMS = [
        'redirect_flow_id' => 'redirect_flow_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
