<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * List Function Builds.
 *
 * Maps to the official Browserbase endpoint GET /v1/functions/builds.
 */
class BrowserbaseFunctionBuildsList extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_function_builds_list';
    protected const DESCRIPTION = 'List Function Builds

Official Browserbase endpoint: GET /v1/functions/builds.';
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
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'status',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/functions/builds';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'offset' => 'offset',
        'limit' => 'limit',
        'status' => 'status',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
