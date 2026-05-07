<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /crawl/*.
 *
 * Maps to the official Browserless endpoint GET /crawl/*.
 */
class BrowserlessGetCrawlWildcard extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_crawl_wildcard';
    protected const DESCRIPTION = '/crawl/*

Official Browserless endpoint: GET /crawl/*.';
    protected const PARAMETERS = [
        'path_suffix' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Dynamic Browserless path suffix for this wildcard route.',
        ],
        'skip' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The number of pages to skip for pagination.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/crawl/{path_suffix}';
    protected const PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const QUERY_PARAMS = [
        'skip' => 'skip',
    ];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
