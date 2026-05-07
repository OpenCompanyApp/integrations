<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * List Invocations for a Function Version.
 *
 * Maps to the official Browserbase endpoint GET /v1/functions/versions/{id}/invocations.
 */
class BrowserbaseFunctionVersionsListInvocations extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_function_versions_list_invocations';
    protected const DESCRIPTION = 'List Invocations for a Function Version

Official Browserbase endpoint: GET /v1/functions/versions/{id}/invocations.';
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
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/functions/versions/{id}/invocations';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
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
