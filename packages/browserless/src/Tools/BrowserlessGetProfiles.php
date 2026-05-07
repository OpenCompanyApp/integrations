<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /profiles.
 *
 * Maps to the official Browserless endpoint GET /profiles.
 */
class BrowserlessGetProfiles extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_profiles';
    protected const DESCRIPTION = '/profiles

Official Browserless endpoint: GET /profiles.';
    protected const PARAMETERS = [
        'block_ads' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
        ],
        'launch' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Launch options, which can be either an object of puppeteer.launch options or playwright.launchServer options, depending on the API. Must be either JSON object, or a base64-encoded JSON object.',
        ],
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Maximum number of profiles to return (1–1000). Defaults to 100.',
        ],
        'offset' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of profiles to skip for pagination. Defaults to 0.',
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
    protected const METHOD = 'GET';
    protected const PATH = '/profiles';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'blockAds' => 'block_ads',
        'launch' => 'launch',
        'limit' => 'limit',
        'offset' => 'offset',
        'profile' => 'profile',
        'timeout' => 'timeout',
        'trackingId' => 'tracking_id',
    ];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
