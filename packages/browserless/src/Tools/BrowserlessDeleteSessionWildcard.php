<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /session/*.
 *
 * Maps to the official Browserless endpoint DELETE /session/*.
 */
class BrowserlessDeleteSessionWildcard extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_delete_session_wildcard';
    protected const DESCRIPTION = '/session/*

Official Browserless endpoint: DELETE /session/*.';
    protected const PARAMETERS = [
        'path_suffix' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Dynamic Browserless path suffix for this wildcard route.',
        ],
        'block_ads' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
        ],
        'force' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether to force the deletion of the session even if it has active connections. Defaults to false.',
        ],
        'launch' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Launch options, which can be either an object of puppeteer.launch options or playwright.launchServer options, depending on the API. Must be either JSON object, or a base64-encoded JSON object.',
        ],
        'profile' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Name of an authenticated profile to hydrate into the browser at launch. The profile\'s cookies, localStorage and IndexedDB are injected via CDP before your code runs. No-op in builds without a profile subsystem.',
        ],
        'timeout' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Override the system-level timeout for this request. Accepts a value in milliseconds.',
        ],
        'tracking_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Custom session identifier',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/session/{path_suffix}';
    protected const PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const QUERY_PARAMS = [
        'blockAds' => 'block_ads',
        'force' => 'force',
        'launch' => 'launch',
        'profile' => 'profile',
        'timeout' => 'timeout',
        'trackingId' => 'tracking_id',
    ];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
