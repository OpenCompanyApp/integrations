<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /profile/*.
 *
 * Maps to the official Browserless endpoint DELETE /profile/*.
 */
class BrowserlessDeleteProfileWildcard extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_delete_profile_wildcard';
    protected const DESCRIPTION = '/profile/*

Official Browserless endpoint: DELETE /profile/*.';
    protected const PARAMETERS = [
        'path_suffix' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Dynamic Browserless path suffix for this wildcard route.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/profile/{path_suffix}';
    protected const PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
