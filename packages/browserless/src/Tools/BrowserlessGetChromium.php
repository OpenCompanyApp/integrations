<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /chromium.
 *
 * Maps to the official Browserless endpoint GET /chromium.
 */
class BrowserlessGetChromium extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_chromium';
    protected const DESCRIPTION = '/chromium

Official Browserless endpoint: GET /chromium.';
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
    protected const PATH = '/chromium';
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
