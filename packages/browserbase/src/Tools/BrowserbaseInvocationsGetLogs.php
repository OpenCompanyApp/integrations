<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Get Invocation Logs.
 *
 * Maps to the official Browserbase endpoint GET /v1/functions/invocations/{id}/logs.
 */
class BrowserbaseInvocationsGetLogs extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_invocations_get_logs';
    protected const DESCRIPTION = 'Get Invocation Logs

Official Browserbase endpoint: GET /v1/functions/invocations/{id}/logs.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/functions/invocations/{id}/logs';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
