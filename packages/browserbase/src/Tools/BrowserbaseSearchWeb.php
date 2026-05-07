<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Web Search.
 *
 * Maps to the official Browserbase endpoint POST /v1/search.
 */
class BrowserbaseSearchWeb extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_search_web';
    protected const DESCRIPTION = 'Web Search

Official Browserbase endpoint: POST /v1/search.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Browserbase OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/search';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
