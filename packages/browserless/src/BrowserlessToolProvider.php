<?php

namespace OpenCompany\Integrations\Browserless;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromeContent;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromeDownload;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromeFunction;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPutJsonNew;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetJsonProtocol;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetJsonVersion;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromePdf;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromePerformance;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromeScrape;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromeScreenshot;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromiumContent;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromiumDownload;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromiumFunction;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromiumPerformance;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromiumScrape;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostEdgeContent;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostEdgeDownload;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostEdgeFunction;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostEdgePdf;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostEdgePerformance;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostEdgeScrape;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostEdgeScreenshot;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetActive;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetKillId;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetMeta;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetRoot;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetDevtoolsBrowserWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetChrome;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetFunctionConnectWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetDevtoolsPageWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetChromePlaywright;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetChromium;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetChromiumPlaywright;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetEdge;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetEdgePlaywright;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetFirefoxPlaywright;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetWebkitPlaywright;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessDeleteBrowserWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromeExport;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromeUnblock;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromiumExport;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostUnblock;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetProxyCities;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostMap;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostPdf;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostScreenshot;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostSearch;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostSession;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessDeleteSessionWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostSmartScrape;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostStealthBqloptionalPath;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetStealthBqloptionalPath;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromeBqloptionalPath;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetChromeBqloptionalPath;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromiumBqloptionalPath;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetChromiumBqloptionalPath;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostSessionBqlWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessDeleteCrawlWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetCrawlWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetCrawl;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostCrawl;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostProfile;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessDeleteProfileWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetProfileWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPutProfileWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetProfiles;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetStealth;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetChromeLiveWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetChromeStealth;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetLiveWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetChromiumStealth;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetReconnectWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetSessionConnectWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetChromiumAgent;

/**
 * Tool catalog and configuration metadata for Browserless.
 *
 * Exposes the official Browserless OpenAPI operation set as endpoint-specific
 * tools and resolves account-specific API tokens for multi-account hosts.
 */
class BrowserlessToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'api_key','legacy_auth_type'=>'api_key','credential_mode'=>'secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>[],'notes'=>['Browserless sends the API token as the token query parameter.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'browserless'; }
    public function appMeta(): array { return ['label'=>'Browserless','description'=>'Browser automation, screenshots, PDFs, scraping, BrowserQL, sessions, and management','icon'=>'ph:browser','logo'=>'ph:browser']; }
    public function integrationMeta(): array { return ['name'=>'Browserless','description'=>'Run Browserless REST, browser WebSocket, BrowserQL, session, crawl, scrape, screenshot, PDF, and management APIs.','icon'=>'ph:browser','logo'=>'ph:browser','category'=>'rendering','badge'=>'verified','docs_url'=>'https://docs.browserless.io/open-api']; }
    public function configSchema(): array { return [['key'=>'api_key','type'=>'secret','label'=>'API Token','placeholder'=>'Browserless API token','hint'=>'Sent as the token query parameter.','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://production-sfo.browserless.io','hint'=>'Use a regional Browserless endpoint or self-hosted URL.','default'=>'https://production-sfo.browserless.io']]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array { $key=(string)($config['api_key']??''); $url=rtrim((string)($config['url']??'https://production-sfo.browserless.io'),'/'); if($key==='') return ['success'=>false,'error'=>'Browserless API token is required.']; try { $response=Http::acceptJson()->timeout(10)->get($url.'/json/version',['token'=>$key]); if(!$response->successful()) return ['success'=>false,'error'=>'Browserless API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to Browserless at '.$url.'.']; } catch(\Throwable $e) { return ['success'=>false,'error'=>$e->getMessage()]; } }
    public function validationRules(): array { return ['api_key'=>'nullable|string','url'=>'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            'browserless_post_chrome_content' => [
                'class' => BrowserlessPostChromeContent::class,
                'name' => 'Post Chrome Content',
                'description' => '/chrome/content

Official Browserless endpoint: POST /chrome/content.',
                'parameters' => [
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
                ],
            ],
            'browserless_post_chrome_download' => [
                'class' => BrowserlessPostChromeDownload::class,
                'name' => 'Post Chrome Download',
                'description' => '/chrome/download

Official Browserless endpoint: POST /chrome/download.',
                'parameters' => [
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
                    'code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'JavaScript source body sent as application/javascript.',
                    ],
                ],
            ],
            'browserless_post_chrome_function' => [
                'class' => BrowserlessPostChromeFunction::class,
                'name' => 'Post Chrome Function',
                'description' => '/chrome/function

Official Browserless endpoint: POST /chrome/function.',
                'parameters' => [
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
                    'code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'JavaScript source body sent as application/javascript.',
                    ],
                ],
            ],
            'browserless_put_json_new' => [
                'class' => BrowserlessPutJsonNew::class,
                'name' => 'Put Json New',
                'description' => '/json/new

Official Browserless endpoint: PUT /json/new.',
                'parameters' => [],
            ],
            'browserless_get_json_protocol' => [
                'class' => BrowserlessGetJsonProtocol::class,
                'name' => 'Get Json Protocol',
                'description' => '/json/protocol

Official Browserless endpoint: GET /json/protocol.',
                'parameters' => [],
            ],
            'browserless_get_json_version' => [
                'class' => BrowserlessGetJsonVersion::class,
                'name' => 'Get Json Version',
                'description' => '/json/version

Official Browserless endpoint: GET /json/version.',
                'parameters' => [],
            ],
            'browserless_post_chrome_pdf' => [
                'class' => BrowserlessPostChromePdf::class,
                'name' => 'Post Chrome Pdf',
                'description' => '/chrome/pdf

Official Browserless endpoint: POST /chrome/pdf.',
                'parameters' => [
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
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_post_chrome_performance' => [
                'class' => BrowserlessPostChromePerformance::class,
                'name' => 'Post Chrome Performance',
                'description' => '/chrome/performance

Official Browserless endpoint: POST /chrome/performance.',
                'parameters' => [
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
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_post_chrome_scrape' => [
                'class' => BrowserlessPostChromeScrape::class,
                'name' => 'Post Chrome Scrape',
                'description' => '/chrome/scrape

Official Browserless endpoint: POST /chrome/scrape.',
                'parameters' => [
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
                ],
            ],
            'browserless_post_chrome_screenshot' => [
                'class' => BrowserlessPostChromeScreenshot::class,
                'name' => 'Post Chrome Screenshot',
                'description' => '/chrome/screenshot

Official Browserless endpoint: POST /chrome/screenshot.',
                'parameters' => [
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
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_post_chromium_content' => [
                'class' => BrowserlessPostChromiumContent::class,
                'name' => 'Post Chromium Content',
                'description' => '/chromium/content

Official Browserless endpoint: POST /chromium/content.',
                'parameters' => [
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
                ],
            ],
            'browserless_post_chromium_download' => [
                'class' => BrowserlessPostChromiumDownload::class,
                'name' => 'Post Chromium Download',
                'description' => '/chromium/download

Official Browserless endpoint: POST /chromium/download.',
                'parameters' => [
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
                    'code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'JavaScript source body sent as application/javascript.',
                    ],
                ],
            ],
            'browserless_post_chromium_function' => [
                'class' => BrowserlessPostChromiumFunction::class,
                'name' => 'Post Chromium Function',
                'description' => '/chromium/function

Official Browserless endpoint: POST /chromium/function.',
                'parameters' => [
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
                    'code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'JavaScript source body sent as application/javascript.',
                    ],
                ],
            ],
            'browserless_post_chromium_performance' => [
                'class' => BrowserlessPostChromiumPerformance::class,
                'name' => 'Post Chromium Performance',
                'description' => '/chromium/performance

Official Browserless endpoint: POST /chromium/performance.',
                'parameters' => [
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
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_post_chromium_scrape' => [
                'class' => BrowserlessPostChromiumScrape::class,
                'name' => 'Post Chromium Scrape',
                'description' => '/chromium/scrape

Official Browserless endpoint: POST /chromium/scrape.',
                'parameters' => [
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
                ],
            ],
            'browserless_post_edge_content' => [
                'class' => BrowserlessPostEdgeContent::class,
                'name' => 'Post Edge Content',
                'description' => '/edge/content

Official Browserless endpoint: POST /edge/content.',
                'parameters' => [
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
                ],
            ],
            'browserless_post_edge_download' => [
                'class' => BrowserlessPostEdgeDownload::class,
                'name' => 'Post Edge Download',
                'description' => '/edge/download

Official Browserless endpoint: POST /edge/download.',
                'parameters' => [
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
                    'code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'JavaScript source body sent as application/javascript.',
                    ],
                ],
            ],
            'browserless_post_edge_function' => [
                'class' => BrowserlessPostEdgeFunction::class,
                'name' => 'Post Edge Function',
                'description' => '/edge/function

Official Browserless endpoint: POST /edge/function.',
                'parameters' => [
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
                    'code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'JavaScript source body sent as application/javascript.',
                    ],
                ],
            ],
            'browserless_post_edge_pdf' => [
                'class' => BrowserlessPostEdgePdf::class,
                'name' => 'Post Edge Pdf',
                'description' => '/edge/pdf

Official Browserless endpoint: POST /edge/pdf.',
                'parameters' => [
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
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_post_edge_performance' => [
                'class' => BrowserlessPostEdgePerformance::class,
                'name' => 'Post Edge Performance',
                'description' => '/edge/performance

Official Browserless endpoint: POST /edge/performance.',
                'parameters' => [
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
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_post_edge_scrape' => [
                'class' => BrowserlessPostEdgeScrape::class,
                'name' => 'Post Edge Scrape',
                'description' => '/edge/scrape

Official Browserless endpoint: POST /edge/scrape.',
                'parameters' => [
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
                ],
            ],
            'browserless_post_edge_screenshot' => [
                'class' => BrowserlessPostEdgeScreenshot::class,
                'name' => 'Post Edge Screenshot',
                'description' => '/edge/screenshot

Official Browserless endpoint: POST /edge/screenshot.',
                'parameters' => [
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
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_get_active' => [
                'class' => BrowserlessGetActive::class,
                'name' => 'Get Active',
                'description' => '/active

Official Browserless endpoint: GET /active.',
                'parameters' => [],
            ],
            'browserless_get_kill_id' => [
                'class' => BrowserlessGetKillId::class,
                'name' => 'Get Kill Id',
                'description' => '/kill/+([0-9a-zA-Z-_])

Official Browserless endpoint: GET /kill/+([0-9a-zA-Z-_]).',
                'parameters' => [
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
                    'browser_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'browserId',
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
                ],
            ],
            'browserless_get_meta' => [
                'class' => BrowserlessGetMeta::class,
                'name' => 'Get Meta',
                'description' => '/meta

Official Browserless endpoint: GET /meta.',
                'parameters' => [],
            ],
            'browserless_get_root' => [
                'class' => BrowserlessGetRoot::class,
                'name' => 'Get Root',
                'description' => '/

Official Browserless endpoint: GET /.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'integrations' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'integrations',
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
                    'record' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'record',
                    ],
                    'replay' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'replay',
                    ],
                    'solve_captchas' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'solveCaptchas',
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
                ],
            ],
            'browserless_get_devtools_browser_wildcard' => [
                'class' => BrowserlessGetDevtoolsBrowserWildcard::class,
                'name' => 'Get Devtools Browser Wildcard',
                'description' => '/devtools/browser/*

Official Browserless endpoint: GET /devtools/browser/*.',
                'parameters' => [
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
                ],
            ],
            'browserless_get_chrome' => [
                'class' => BrowserlessGetChrome::class,
                'name' => 'Get Chrome',
                'description' => '/chrome

Official Browserless endpoint: GET /chrome.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'integrations' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'integrations',
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
                    'record' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'record',
                    ],
                    'replay' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'replay',
                    ],
                    'solve_captchas' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'solveCaptchas',
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
                ],
            ],
            'browserless_get_function_connect_wildcard' => [
                'class' => BrowserlessGetFunctionConnectWildcard::class,
                'name' => 'Get Function Connect Wildcard',
                'description' => '/function/connect/*

Official Browserless endpoint: GET /function/connect/*.',
                'parameters' => [
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
                ],
            ],
            'browserless_get_devtools_page_wildcard' => [
                'class' => BrowserlessGetDevtoolsPageWildcard::class,
                'name' => 'Get Devtools Page Wildcard',
                'description' => '/devtools/page/*

Official Browserless endpoint: GET /devtools/page/*.',
                'parameters' => [
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
                ],
            ],
            'browserless_get_chrome_playwright' => [
                'class' => BrowserlessGetChromePlaywright::class,
                'name' => 'Get Chrome Playwright',
                'description' => '/chrome/playwright

Official Browserless endpoint: GET /chrome/playwright.',
                'parameters' => [
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
                ],
            ],
            'browserless_get_chromium' => [
                'class' => BrowserlessGetChromium::class,
                'name' => 'Get Chromium',
                'description' => '/chromium

Official Browserless endpoint: GET /chromium.',
                'parameters' => [
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
                ],
            ],
            'browserless_get_chromium_playwright' => [
                'class' => BrowserlessGetChromiumPlaywright::class,
                'name' => 'Get Chromium Playwright',
                'description' => '/chromium/playwright

Official Browserless endpoint: GET /chromium/playwright.',
                'parameters' => [
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
                ],
            ],
            'browserless_get_edge' => [
                'class' => BrowserlessGetEdge::class,
                'name' => 'Get Edge',
                'description' => '/edge

Official Browserless endpoint: GET /edge.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'integrations' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'integrations',
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
                    'record' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'record',
                    ],
                    'replay' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'replay',
                    ],
                    'solve_captchas' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'solveCaptchas',
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
                ],
            ],
            'browserless_get_edge_playwright' => [
                'class' => BrowserlessGetEdgePlaywright::class,
                'name' => 'Get Edge Playwright',
                'description' => '/edge/playwright

Official Browserless endpoint: GET /edge/playwright.',
                'parameters' => [
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
                ],
            ],
            'browserless_get_firefox_playwright' => [
                'class' => BrowserlessGetFirefoxPlaywright::class,
                'name' => 'Get Firefox Playwright',
                'description' => '/firefox/playwright

Official Browserless endpoint: GET /firefox/playwright.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'launch' => [
                        'type' => 'object',
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
                ],
            ],
            'browserless_get_webkit_playwright' => [
                'class' => BrowserlessGetWebkitPlaywright::class,
                'name' => 'Get Webkit Playwright',
                'description' => '/webkit/playwright

Official Browserless endpoint: GET /webkit/playwright.',
                'parameters' => [
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
                ],
            ],
            'browserless_delete_browser_wildcard' => [
                'class' => BrowserlessDeleteBrowserWildcard::class,
                'name' => 'Delete Browser Wildcard',
                'description' => '/browser/*

Official Browserless endpoint: DELETE /browser/*.',
                'parameters' => [
                    'path_suffix' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Dynamic Browserless path suffix for this wildcard route.',
                    ],
                ],
            ],
            'browserless_post_chrome_export' => [
                'class' => BrowserlessPostChromeExport::class,
                'name' => 'Post Chrome Export',
                'description' => '/chrome/export

Official Browserless endpoint: POST /chrome/export.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'launch' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Launch options for the browser, either as a JSON object or a JSON string. Includes options like `headless`, `args`, `defaultViewport`, etc.',
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
                ],
            ],
            'browserless_post_chrome_unblock' => [
                'class' => BrowserlessPostChromeUnblock::class,
                'name' => 'Post Chrome Unblock',
                'description' => '/chrome/unblock

Official Browserless endpoint: POST /chrome/unblock.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'launch' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Launch options for the browser, either as a JSON object or a JSON string. Includes options like `headless`, `args`, `defaultViewport`, etc.',
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
                ],
            ],
            'browserless_post_chromium_export' => [
                'class' => BrowserlessPostChromiumExport::class,
                'name' => 'Post Chromium Export',
                'description' => '/chromium/export

Official Browserless endpoint: POST /chromium/export.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'launch' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Launch options for the browser, either as a JSON object or a JSON string. Includes options like `headless`, `args`, `defaultViewport`, etc.',
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
                ],
            ],
            'browserless_post_unblock' => [
                'class' => BrowserlessPostUnblock::class,
                'name' => 'Post Unblock',
                'description' => '/unblock

Official Browserless endpoint: POST /unblock.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'launch' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Launch options for the browser, either as a JSON object or a JSON string. Includes options like `headless`, `args`, `defaultViewport`, etc.',
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
                ],
            ],
            'browserless_get_proxy_cities' => [
                'class' => BrowserlessGetProxyCities::class,
                'name' => 'Get Proxy Cities',
                'description' => '/proxy/cities

Official Browserless endpoint: GET /proxy/cities.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'country' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional two-letter country code to filter cities by country (e.g., \'US\', \'GB\', \'DE\').',
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
                ],
            ],
            'browserless_post_map' => [
                'class' => BrowserlessPostMap::class,
                'name' => 'Post Map',
                'description' => '/map

Official Browserless endpoint: POST /map.',
                'parameters' => [
                    'timeout' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Request timeout in milliseconds',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_post_pdf' => [
                'class' => BrowserlessPostPdf::class,
                'name' => 'Post Pdf',
                'description' => '/pdf

Official Browserless endpoint: POST /pdf.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'launch' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Launch options for the browser, either as a JSON object or a JSON string. Includes options like `headless`, `args`, `defaultViewport`, etc.',
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
                ],
            ],
            'browserless_post_screenshot' => [
                'class' => BrowserlessPostScreenshot::class,
                'name' => 'Post Screenshot',
                'description' => '/screenshot

Official Browserless endpoint: POST /screenshot.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'launch' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Launch options for the browser, either as a JSON object or a JSON string. Includes options like `headless`, `args`, `defaultViewport`, etc.',
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
                ],
            ],
            'browserless_post_search' => [
                'class' => BrowserlessPostSearch::class,
                'name' => 'Post Search',
                'description' => '/search

Official Browserless endpoint: POST /search.',
                'parameters' => [
                    'timeout' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The timeout for the search operation in milliseconds.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_post_session' => [
                'class' => BrowserlessPostSession::class,
                'name' => 'Post Session',
                'description' => '/session

Official Browserless endpoint: POST /session.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_delete_session_wildcard' => [
                'class' => BrowserlessDeleteSessionWildcard::class,
                'name' => 'Delete Session Wildcard',
                'description' => '/session/*

Official Browserless endpoint: DELETE /session/*.',
                'parameters' => [
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
                ],
            ],
            'browserless_post_smart_scrape' => [
                'class' => BrowserlessPostSmartScrape::class,
                'name' => 'Post Smart Scrape',
                'description' => '/smart-scrape

Official Browserless endpoint: POST /smart-scrape.',
                'parameters' => [
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
                ],
            ],
            'browserless_post_stealth_bqloptional_path' => [
                'class' => BrowserlessPostStealthBqloptionalPath::class,
                'name' => 'Post Stealth Bqloptional Path',
                'description' => '/stealth/bql?(/*)

Official Browserless endpoint: POST /stealth/bql?(/*).',
                'parameters' => [
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
                        'description' => 'Whether to automatically block cookie consent modals and popups.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'humanlike' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to enable human-like behavior for interactions. When true, actions like typing and clicking will have randomized delays.',
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
                        'description' => 'Whether to enable session recording for replay. When true, the session will be recorded and can be replayed later.',
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
                ],
            ],
            'browserless_get_stealth_bqloptional_path' => [
                'class' => BrowserlessGetStealthBqloptionalPath::class,
                'name' => 'Get Stealth Bqloptional Path',
                'description' => '/stealth/bql?(/*)

Official Browserless endpoint: GET /stealth/bql?(/*).',
                'parameters' => [
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
                ],
            ],
            'browserless_post_chrome_bqloptional_path' => [
                'class' => BrowserlessPostChromeBqloptionalPath::class,
                'name' => 'Post Chrome Bqloptional Path',
                'description' => '/chrome/bql?(/*)

Official Browserless endpoint: POST /chrome/bql?(/*).',
                'parameters' => [
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
                        'description' => 'Whether to automatically block cookie consent modals and popups.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'humanlike' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to enable human-like behavior for interactions. When true, actions like typing and clicking will have randomized delays.',
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
                        'description' => 'Whether to enable session recording for replay. When true, the session will be recorded and can be replayed later.',
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
                ],
            ],
            'browserless_get_chrome_bqloptional_path' => [
                'class' => BrowserlessGetChromeBqloptionalPath::class,
                'name' => 'Get Chrome Bqloptional Path',
                'description' => '/chrome/bql?(/*)

Official Browserless endpoint: GET /chrome/bql?(/*).',
                'parameters' => [
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
                ],
            ],
            'browserless_post_chromium_bqloptional_path' => [
                'class' => BrowserlessPostChromiumBqloptionalPath::class,
                'name' => 'Post Chromium Bqloptional Path',
                'description' => '/chromium/bql?(/*)

Official Browserless endpoint: POST /chromium/bql?(/*).',
                'parameters' => [
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
                        'description' => 'Whether to automatically block cookie consent modals and popups.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'humanlike' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to enable human-like behavior for interactions. When true, actions like typing and clicking will have randomized delays.',
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
                        'description' => 'Whether to enable session recording for replay. When true, the session will be recorded and can be replayed later.',
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
                ],
            ],
            'browserless_get_chromium_bqloptional_path' => [
                'class' => BrowserlessGetChromiumBqloptionalPath::class,
                'name' => 'Get Chromium Bqloptional Path',
                'description' => '/chromium/bql?(/*)

Official Browserless endpoint: GET /chromium/bql?(/*).',
                'parameters' => [
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
                ],
            ],
            'browserless_post_session_bql_wildcard' => [
                'class' => BrowserlessPostSessionBqlWildcard::class,
                'name' => 'Post Session Bql Wildcard',
                'description' => '/session/bql/*

Official Browserless endpoint: POST /session/bql/*.',
                'parameters' => [
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
                ],
            ],
            'browserless_delete_crawl_wildcard' => [
                'class' => BrowserlessDeleteCrawlWildcard::class,
                'name' => 'Delete Crawl Wildcard',
                'description' => '/crawl/*

Official Browserless endpoint: DELETE /crawl/*.',
                'parameters' => [
                    'path_suffix' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Dynamic Browserless path suffix for this wildcard route.',
                    ],
                ],
            ],
            'browserless_get_crawl_wildcard' => [
                'class' => BrowserlessGetCrawlWildcard::class,
                'name' => 'Get Crawl Wildcard',
                'description' => '/crawl/*

Official Browserless endpoint: GET /crawl/*.',
                'parameters' => [
                    'path_suffix' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Dynamic Browserless path suffix for this wildcard route.',
                    ],
                    'skip' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The number of pages to skip for pagination.',
                    ],
                ],
            ],
            'browserless_get_crawl' => [
                'class' => BrowserlessGetCrawl::class,
                'name' => 'Get Crawl',
                'description' => '/crawl

Official Browserless endpoint: GET /crawl.',
                'parameters' => [
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
                ],
            ],
            'browserless_post_crawl' => [
                'class' => BrowserlessPostCrawl::class,
                'name' => 'Post Crawl',
                'description' => '/crawl

Official Browserless endpoint: POST /crawl.',
                'parameters' => [
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
                ],
            ],
            'browserless_post_profile' => [
                'class' => BrowserlessPostProfile::class,
                'name' => 'Post Profile',
                'description' => '/profile

Official Browserless endpoint: POST /profile.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_delete_profile_wildcard' => [
                'class' => BrowserlessDeleteProfileWildcard::class,
                'name' => 'Delete Profile Wildcard',
                'description' => '/profile/*

Official Browserless endpoint: DELETE /profile/*.',
                'parameters' => [
                    'path_suffix' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Dynamic Browserless path suffix for this wildcard route.',
                    ],
                ],
            ],
            'browserless_get_profile_wildcard' => [
                'class' => BrowserlessGetProfileWildcard::class,
                'name' => 'Get Profile Wildcard',
                'description' => '/profile/*

Official Browserless endpoint: GET /profile/*.',
                'parameters' => [
                    'path_suffix' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Dynamic Browserless path suffix for this wildcard route.',
                    ],
                ],
            ],
            'browserless_put_profile_wildcard' => [
                'class' => BrowserlessPutProfileWildcard::class,
                'name' => 'Put Profile Wildcard',
                'description' => '/profile/*

Official Browserless endpoint: PUT /profile/*.',
                'parameters' => [
                    'path_suffix' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Dynamic Browserless path suffix for this wildcard route.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the Browserless OpenAPI schema.',
                    ],
                ],
            ],
            'browserless_get_profiles' => [
                'class' => BrowserlessGetProfiles::class,
                'name' => 'Get Profiles',
                'description' => '/profiles

Official Browserless endpoint: GET /profiles.',
                'parameters' => [
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
                ],
            ],
            'browserless_get_stealth' => [
                'class' => BrowserlessGetStealth::class,
                'name' => 'Get Stealth',
                'description' => '/stealth

Official Browserless endpoint: GET /stealth.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'integrations' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'integrations',
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
                    'record' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'record',
                    ],
                    'replay' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'replay',
                    ],
                    'solve_captchas' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'solveCaptchas',
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
                ],
            ],
            'browserless_get_chrome_live_wildcard' => [
                'class' => BrowserlessGetChromeLiveWildcard::class,
                'name' => 'Get Chrome Live Wildcard',
                'description' => '/chrome/live/*

Official Browserless endpoint: GET /chrome/live/*.',
                'parameters' => [
                    'path_suffix' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Dynamic Browserless path suffix for this wildcard route.',
                    ],
                ],
            ],
            'browserless_get_chrome_stealth' => [
                'class' => BrowserlessGetChromeStealth::class,
                'name' => 'Get Chrome Stealth',
                'description' => '/chrome/stealth

Official Browserless endpoint: GET /chrome/stealth.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'integrations' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'integrations',
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
                    'record' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'record',
                    ],
                    'replay' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'replay',
                    ],
                    'solve_captchas' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'solveCaptchas',
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
                ],
            ],
            'browserless_get_live_wildcard' => [
                'class' => BrowserlessGetLiveWildcard::class,
                'name' => 'Get Live Wildcard',
                'description' => '/live/*

Official Browserless endpoint: GET /live/*.',
                'parameters' => [
                    'path_suffix' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Dynamic Browserless path suffix for this wildcard route.',
                    ],
                ],
            ],
            'browserless_get_chromium_stealth' => [
                'class' => BrowserlessGetChromiumStealth::class,
                'name' => 'Get Chromium Stealth',
                'description' => '/chromium/stealth

Official Browserless endpoint: GET /chromium/stealth.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'integrations' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'integrations',
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
                    'record' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'record',
                    ],
                    'replay' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'replay',
                    ],
                    'solve_captchas' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'solveCaptchas',
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
                ],
            ],
            'browserless_get_reconnect_wildcard' => [
                'class' => BrowserlessGetReconnectWildcard::class,
                'name' => 'Get Reconnect Wildcard',
                'description' => '/reconnect/*

Official Browserless endpoint: GET /reconnect/*.',
                'parameters' => [
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
                    'integrations' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'integrations',
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
                    'replay' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'replay',
                    ],
                    'solve_captchas' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'solveCaptchas',
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
                ],
            ],
            'browserless_get_session_connect_wildcard' => [
                'class' => BrowserlessGetSessionConnectWildcard::class,
                'name' => 'Get Session Connect Wildcard',
                'description' => '/session/connect/*

Official Browserless endpoint: GET /session/connect/*.',
                'parameters' => [
                    'path_suffix' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Dynamic Browserless path suffix for this wildcard route.',
                    ],
                    'launch' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'launch',
                    ],
                    'replay' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'replay',
                    ],
                    'timeout' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'timeout',
                    ],
                ],
            ],
            'browserless_get_chromium_agent' => [
                'class' => BrowserlessGetChromiumAgent::class,
                'name' => 'Get Chromium Agent',
                'description' => '/chromium/agent

Official Browserless endpoint: GET /chromium/agent.',
                'parameters' => [
                    'block_ads' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether or nor to load ad-blocking extensions for the session. This currently uses uBlock-Lite and may cause certain sites to not load properly.',
                    ],
                    'block_consent_modals' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to automatically block cookie consent modals and popups.',
                    ],
                    'external_proxy_server' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'External proxy server URL for user-provided proxies. Format: http(s)://[username:password@]host:port When set, routes requests through this proxy instead of built-in residential proxies.',
                    ],
                    'humanlike' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to enable human-like behavior for interactions. When true, actions like typing and clicking will have randomized delays.',
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
                        'description' => 'Whether to enable session recording for replay. When true, the session will be recorded and can be replayed later.',
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
                ],
            ],
        ]; }
    /** @param  array<string, mixed>  $context  Runtime account context. */ public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Runtime account context. */ private function resolveService(array $context=[]): BrowserlessService { $account=$context['account']??null; if($account!==null) { $creds=app(CredentialResolver::class); return new BrowserlessService(apiKey:$creds->get('browserless','api_key','',$account), baseUrl:$creds->get('browserless','url','https://production-sfo.browserless.io',$account)); } return app(BrowserlessService::class); }
    public function luaDocsPath(): ?string { return __DIR__.'/../lua-docs/browserless.md'; }
    public function isIntegration(): bool { return true; }
}
