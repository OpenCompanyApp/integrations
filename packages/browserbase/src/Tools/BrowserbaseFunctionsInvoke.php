<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Invoke a Function.
 *
 * Maps to the official Browserbase endpoint POST /v1/functions/{id}/invoke.
 */
class BrowserbaseFunctionsInvoke extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_functions_invoke';
    protected const DESCRIPTION = 'Invoke a Function

Official Browserbase endpoint: POST /v1/functions/{id}/invoke.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official Browserbase OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/functions/{id}/invoke';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
