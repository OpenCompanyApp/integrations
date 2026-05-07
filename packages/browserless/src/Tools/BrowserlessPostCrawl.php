<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /crawl.
 *
 * Maps to the official Browserless endpoint POST /crawl.
 */
class BrowserlessPostCrawl extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_post_crawl';
    protected const DESCRIPTION = '/crawl

Official Browserless endpoint: POST /crawl.';
    protected const PARAMETERS = [
        'profile' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional name of an authentication profile to hydrate into the browser before each page is scraped. The profile\'s cookies, localStorage, and IndexedDB entries are loaded into the session before navigation. Forces the browser strategy for every page.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the Browserless OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/crawl';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'profile' => 'profile',
    ];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
