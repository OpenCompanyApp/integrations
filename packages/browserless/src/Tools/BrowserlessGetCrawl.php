<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /crawl.
 *
 * Maps to the official Browserless endpoint GET /crawl.
 */
class BrowserlessGetCrawl extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_crawl';
    protected const DESCRIPTION = '/crawl

Official Browserless endpoint: GET /crawl.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Cursor for fetching the next page of results.',
        ],
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Maximum number of crawls to return per page (1–100, default 20).',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter crawls by status: in-progress, completed, failed, or cancelled.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/crawl';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'limit' => 'limit',
        'status' => 'status',
    ];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
