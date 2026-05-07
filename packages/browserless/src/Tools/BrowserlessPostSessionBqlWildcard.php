<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /session/bql/*.
 *
 * Maps to the official Browserless endpoint POST /session/bql/*.
 */
class BrowserlessPostSessionBqlWildcard extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_post_session_bql_wildcard';
    protected const DESCRIPTION = '/session/bql/*

Official Browserless endpoint: POST /session/bql/*.';
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
        'launch' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Launch options for the browser, either as a JSON object or a JSON string. Includes options like `headless`, `args`, `defaultViewport`, etc. Must be either JSON object, or a base64-encoded JSON object.',
        ],
        'profile' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Name of an authenticated profile to hydrate into the browser at launch. The profile\'s cookies, localStorage and IndexedDB are injected via CDP before your code runs. No-op in builds without a profile subsystem.',
        ],
        'replay' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'replay',
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
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the Browserless OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/session/bql/{path_suffix}';
    protected const PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const QUERY_PARAMS = [
        'blockAds' => 'block_ads',
        'launch' => 'launch',
        'profile' => 'profile',
        'replay' => 'replay',
        'timeout' => 'timeout',
        'trackingId' => 'tracking_id',
    ];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
