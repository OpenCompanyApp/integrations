<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /search.
 *
 * Maps to the official Browserless endpoint POST /search.
 */
class BrowserlessPostSearch extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_post_search';
    protected const DESCRIPTION = '/search

Official Browserless endpoint: POST /search.';
    protected const PARAMETERS = [
        'timeout' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The timeout for the search operation in milliseconds.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the Browserless OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/search';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'timeout' => 'timeout',
    ];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
