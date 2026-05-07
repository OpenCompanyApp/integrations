<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /chrome/live/*.
 *
 * Maps to the official Browserless endpoint GET /chrome/live/*.
 */
class BrowserlessGetChromeLiveWildcard extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_chrome_live_wildcard';
    protected const DESCRIPTION = '/chrome/live/*

Official Browserless endpoint: GET /chrome/live/*.';
    protected const PARAMETERS = [
        'path_suffix' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Dynamic Browserless path suffix for this wildcard route.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/chrome/live/{path_suffix}';
    protected const PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
