<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * List Functions.
 *
 * Maps to the official Browserbase endpoint GET /v1/functions.
 */
class BrowserbaseFunctionsList extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_functions_list';
    protected const DESCRIPTION = 'List Functions

Official Browserbase endpoint: GET /v1/functions.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/functions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'offset' => 'offset',
        'limit' => 'limit',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
