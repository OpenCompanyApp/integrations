<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /browser/*.
 *
 * Maps to the official Browserless endpoint DELETE /browser/*.
 */
class BrowserlessDeleteBrowserWildcard extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_delete_browser_wildcard';
    protected const DESCRIPTION = '/browser/*

Official Browserless endpoint: DELETE /browser/*.';
    protected const PARAMETERS = [
        'path_suffix' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Dynamic Browserless path suffix for this wildcard route.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/browser/{path_suffix}';
    protected const PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
