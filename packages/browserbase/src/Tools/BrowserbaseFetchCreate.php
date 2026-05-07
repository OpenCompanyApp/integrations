<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Fetch a Page.
 *
 * Maps to the official Browserbase endpoint POST /v1/fetch.
 */
class BrowserbaseFetchCreate extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_fetch_create';
    protected const DESCRIPTION = 'Fetch a Page

Official Browserbase endpoint: POST /v1/fetch.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Browserbase OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fetch';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
