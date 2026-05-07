<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /profile/*.
 *
 * Maps to the official Browserless endpoint PUT /profile/*.
 */
class BrowserlessPutProfileWildcard extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_put_profile_wildcard';
    protected const DESCRIPTION = '/profile/*

Official Browserless endpoint: PUT /profile/*.';
    protected const PARAMETERS = [
        'path_suffix' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Dynamic Browserless path suffix for this wildcard route.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the Browserless OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/profile/{path_suffix}';
    protected const PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
