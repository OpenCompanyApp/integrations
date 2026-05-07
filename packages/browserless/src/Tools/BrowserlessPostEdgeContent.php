<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /edge/content.
 *
 * Maps to the official Browserless endpoint POST /edge/content.
 */
class BrowserlessPostEdgeContent extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_post_edge_content';
    protected const DESCRIPTION = '/edge/content

Official Browserless endpoint: POST /edge/content.';
    protected const PARAMETERS = [
        'block_ads' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
        ],
        'launch' => [
            'type' => 'string',
            'required' => false,
            'description' => 'launch',
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
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the Browserless OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/edge/content';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'blockAds' => 'block_ads',
        'launch' => 'launch',
        'profile' => 'profile',
        'timeout' => 'timeout',
        'trackingId' => 'tracking_id',
    ];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
