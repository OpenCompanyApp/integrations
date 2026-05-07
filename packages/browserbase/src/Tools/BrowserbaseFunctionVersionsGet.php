<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Get a Function Version.
 *
 * Maps to the official Browserbase endpoint GET /v1/functions/versions/{id}.
 */
class BrowserbaseFunctionVersionsGet extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_function_versions_get';
    protected const DESCRIPTION = 'Get a Function Version

Official Browserbase endpoint: GET /v1/functions/versions/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/functions/versions/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
