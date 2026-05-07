<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /live/*.
 *
 * Maps to the official Browserless endpoint GET /live/*.
 */
class BrowserlessGetLiveWildcard extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_live_wildcard';
    protected const DESCRIPTION = '/live/*

Official Browserless endpoint: GET /live/*.';
    protected const PARAMETERS = [
        'path_suffix' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Dynamic Browserless path suffix for this wildcard route.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/live/{path_suffix}';
    protected const PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
