<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Get a Context.
 *
 * Maps to the official Browserbase endpoint GET /v1/contexts/{id}.
 */
class BrowserbaseContextsGet extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_contexts_get';
    protected const DESCRIPTION = 'Get a Context

Official Browserbase endpoint: GET /v1/contexts/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/contexts/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
