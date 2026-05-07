<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * List Function Versions.
 *
 * Maps to the official Browserbase endpoint GET /v1/functions/{id}/versions.
 */
class BrowserbaseFunctionsListVersions extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_functions_list_versions';
    protected const DESCRIPTION = 'List Function Versions

Official Browserbase endpoint: GET /v1/functions/{id}/versions.';
    protected const PARAMETERS = [
        'offset' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'offset',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'limit',
        ],
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/functions/{id}/versions';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'offset' => 'offset',
        'limit' => 'limit',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
