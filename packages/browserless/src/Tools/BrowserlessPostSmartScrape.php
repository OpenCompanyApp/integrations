<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /smart-scrape.
 *
 * Maps to the official Browserless endpoint POST /smart-scrape.
 */
class BrowserlessPostSmartScrape extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_post_smart_scrape';
    protected const DESCRIPTION = '/smart-scrape

Official Browserless endpoint: POST /smart-scrape.';
    protected const PARAMETERS = [
        'profile' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional name of an authentication profile to hydrate into the browser before scraping. The profile\'s cookies, localStorage, and IndexedDB entries are loaded into the session before navigation. Forces the browser strategy.',
        ],
        'timeout' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The timeout for the scrape operation in milliseconds',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the Browserless OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/smart-scrape';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'profile' => 'profile',
        'timeout' => 'timeout',
    ];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
