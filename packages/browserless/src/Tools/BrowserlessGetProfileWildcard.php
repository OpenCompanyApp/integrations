<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /profile/*.
 *
 * Maps to the official Browserless endpoint GET /profile/*.
 */
class BrowserlessGetProfileWildcard extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_profile_wildcard';
    protected const DESCRIPTION = '/profile/*

Official Browserless endpoint: GET /profile/*.';
    protected const PARAMETERS = [
        'path_suffix' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Dynamic Browserless path suffix for this wildcard route.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/profile/{path_suffix}';
    protected const PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
