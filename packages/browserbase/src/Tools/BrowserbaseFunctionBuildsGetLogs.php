<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Get Function Build Logs.
 *
 * Maps to the official Browserbase endpoint GET /v1/functions/builds/{id}/logs.
 */
class BrowserbaseFunctionBuildsGetLogs extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_function_builds_get_logs';
    protected const DESCRIPTION = 'Get Function Build Logs

Official Browserbase endpoint: GET /v1/functions/builds/{id}/logs.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/functions/builds/{id}/logs';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
