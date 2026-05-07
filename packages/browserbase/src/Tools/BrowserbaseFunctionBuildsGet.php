<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Get a Function Build.
 *
 * Maps to the official Browserbase endpoint GET /v1/functions/builds/{id}.
 */
class BrowserbaseFunctionBuildsGet extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_function_builds_get';
    protected const DESCRIPTION = 'Get a Function Build

Official Browserbase endpoint: GET /v1/functions/builds/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/functions/builds/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
