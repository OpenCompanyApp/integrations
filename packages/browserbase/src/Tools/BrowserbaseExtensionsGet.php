<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Get an Extension.
 *
 * Maps to the official Browserbase endpoint GET /v1/extensions/{id}.
 */
class BrowserbaseExtensionsGet extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_extensions_get';
    protected const DESCRIPTION = 'Get an Extension

Official Browserbase endpoint: GET /v1/extensions/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/extensions/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
