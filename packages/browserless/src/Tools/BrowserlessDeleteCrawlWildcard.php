<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /crawl/*.
 *
 * Maps to the official Browserless endpoint DELETE /crawl/*.
 */
class BrowserlessDeleteCrawlWildcard extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_delete_crawl_wildcard';
    protected const DESCRIPTION = '/crawl/*

Official Browserless endpoint: DELETE /crawl/*.';
    protected const PARAMETERS = [
        'path_suffix' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Dynamic Browserless path suffix for this wildcard route.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/crawl/{path_suffix}';
    protected const PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
