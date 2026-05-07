<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /chrome/bql?(/*).
 *
 * Maps to the official Browserless endpoint GET /chrome/bql?(/*).
 */
class BrowserlessGetChromeBqloptionalPath extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_chrome_bqloptional_path';
    protected const DESCRIPTION = '/chrome/bql?(/*)

Official Browserless endpoint: GET /chrome/bql?(/*).';
    protected const PARAMETERS = [
        'path_suffix' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional Browserless path suffix for this route.',
        ],
        'block_ads' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
        ],
        'block_consent_modals' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'blockConsentModals',
        ],
        'external_proxy_server' => [
            'type' => 'string',
            'required' => false,
            'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
        ],
        'humanlike' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'humanlike',
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
        'proxy' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The type of proxy to use, currently just \'residential\' is supported',
        ],
        'proxy_city' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The city to use for the proxy. Available cities: https://production-sfo.browserless.io/proxy/cities?token=YOUR_TOKEN Documentation: https://docs.browserless.io/baas/features/proxies#built-in-residential-proxy',
        ],
        'proxy_country' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A two-letter country code for the proxy configuration. Supported codes: US, GB, FR, DE, etc. Full list: https://docs.browserless.io/bql-schema/types/enums/country-type',
        ],
        'proxy_locale_match' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sets the browser\'s language to match the proxy\'s geographic location. Recommended when using proxyCountry to ensure websites render content, currency, and formatting in the local language. Default is English (en-US).',
            'enum' => [
                '0',
                '1',
                'false',
                'true',
            ],
        ],
        'proxy_preset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A preset code for website-specific proxy routing. Maps to specific proxy vendors internally for optimal access to certain websites. Format: "px_<identifier>" (e.g., "px_gov01", "px_amazon01")',
        ],
        'proxy_state' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The state or province to use for the proxy, whitespace must be replaced with underscores',
        ],
        'proxy_sticky' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Whether or not to use the same IP for all requests, defaults to true',
            'enum' => [
                '0',
                '1',
                'false',
                'true',
            ],
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/chrome/bql/{path_suffix}';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'blockAds' => 'block_ads',
        'blockConsentModals' => 'block_consent_modals',
        'externalProxyServer' => 'external_proxy_server',
        'humanlike' => 'humanlike',
        'launch' => 'launch',
        'profile' => 'profile',
        'proxy' => 'proxy',
        'proxyCity' => 'proxy_city',
        'proxyCountry' => 'proxy_country',
        'proxyLocaleMatch' => 'proxy_locale_match',
        'proxyPreset' => 'proxy_preset',
        'proxyState' => 'proxy_state',
        'proxySticky' => 'proxy_sticky',
        'replay' => 'replay',
        'timeout' => 'timeout',
        'trackingId' => 'tracking_id',
    ];
    protected const OPTIONAL_PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
