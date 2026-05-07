<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /map.
 *
 * Maps to the official Browserless endpoint POST /map.
 */
class BrowserlessPostMap extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_post_map';
    protected const DESCRIPTION = '/map

Official Browserless endpoint: POST /map.';
    protected const PARAMETERS = [
        'timeout' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Request timeout in milliseconds',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the Browserless OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/map';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'timeout' => 'timeout',
    ];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
