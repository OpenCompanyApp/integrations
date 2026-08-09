<?php

namespace OpenCompany\Integrations\Urlscan;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanSubmitScan;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanSearchDatasource;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetResult;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetScreenshot;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetDom;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetResponse;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanUpdateResultVisibility;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanDeleteResultVisibility;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetAvailableCountries;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetUserAgents;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetQuotas;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetAvailableBrands;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetBrandSummary;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetPhishfeed;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetLivescanScanners;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanCreateLivescanTask;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanCreateLivescanScan;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetLivescanResource;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanStoreLivescanResult;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanDiscardLivescanResult;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetHostnameHistory;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetProUsername;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetSimilarResults;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanListSavedSearches;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanCreateSavedSearch;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanUpdateSavedSearch;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanDeleteSavedSearch;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetSavedSearchResults;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanListSubscriptions;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanCreateSubscription;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanUpdateSubscription;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanDeleteSubscription;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetSubscriptionResults;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanListChannels;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanCreateChannel;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetChannel;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanUpdateChannel;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanCreateIncident;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetIncident;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanUpdateIncident;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanCloseIncident;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanRestartIncident;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanCopyIncident;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanForkIncident;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetWatchableAttributes;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetIncidentStates;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanListDatadumps;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetDatadumpLink;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanDownloadFile;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanLookupMaliciousObservable;

/**
 * Tool catalog and configuration metadata for urlscan.io.
 *
 * Exposes the official urlscan.io OpenAPI operation set as endpoint-specific
 * tools and resolves account-specific API keys for multi-account hosts.
 */
class UrlscanToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => [], 'notes' => ['urlscan.io uses the api-key request header.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'urlscan'; }
    public function appMeta(): array { return ['label' => 'urlscan.io', 'description' => 'URL sandbox scanning, search, live scanning, incidents, saved searches, subscriptions, and data dumps', 'icon' => 'ph:shield-check', 'logo' => 'ph:shield-check']; }
    public function integrationMeta(): array { return ['name' => 'urlscan.io', 'description' => 'Scan URLs, search urlscan.io results, inspect artifacts, manage Pro live scanning, incidents, channels, subscriptions, saved searches, and data dumps.', 'icon' => 'ph:shield-check', 'logo' => 'ph:shield-check', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://docs.urlscan.io/apis/urlscan-openapi']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'urlscan.io API key', 'hint' => 'Sent as the api-key request header.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://urlscan.io', 'hint' => 'Use https://urlscan.io unless urlscan.io provides a dedicated endpoint.', 'default' => 'https://urlscan.io']]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://urlscan.io'), '/');
        if ($apiKey === '') { return ['success' => false, 'error' => 'urlscan.io API key is required.']; }

        try {
            $response = Http::withHeaders(['api-key' => $apiKey, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/api/v1/quotas');
            if (!$response->successful()) { return ['success' => false, 'error' => 'urlscan.io API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to urlscan.io at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['api_key' => 'nullable|string', 'url' => 'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            'urlscan_submit_scan' => [
                'class' => UrlscanSubmitScan::class,
                'name' => 'Submit Scan',
                'description' => 'Scan

Official urlscan.io endpoint: POST /api/v1/scan.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_search_datasource' => [
                'class' => UrlscanSearchDatasource::class,
                'name' => 'Search Datasource',
                'description' => 'Search

Official urlscan.io endpoint: GET /api/v1/search.',
                'parameters' => [
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search Query (Elasticsearch Query String)',
                    ],
                    'size' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of results to return',
                    ],
                    'search_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'For retrieving the next batch of results, send the value of the `sort` attribute of the last (oldest) result you received (comma-separated) from the previous call.',
                    ],
                    'datasource' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Datasources to search: scans (urlscan.io), hostnames, incidents, notifications, certificates (urlscan Pro)',
                        'enum' => ['scans', 'hostnames', 'incidents', 'notifications', 'certificates'],
                    ],
                    'collapse' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Field to collapse results on. Only works on current page of results.',
                    ],
                ],
            ],
            'urlscan_get_result' => [
                'class' => UrlscanGetResult::class,
                'name' => 'Get Result',
                'description' => 'Result

Official urlscan.io endpoint: GET /api/v1/result/{scanId}/.',
                'parameters' => [
                    'scan_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'UUID of scan result',
                    ],
                ],
            ],
            'urlscan_get_screenshot' => [
                'class' => UrlscanGetScreenshot::class,
                'name' => 'Get Screenshot',
                'description' => 'Screenshot

Official urlscan.io endpoint: GET /screenshots/{scanId}.png.',
                'parameters' => [
                    'scan_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'UUID of scan result',
                    ],
                ],
            ],
            'urlscan_get_dom' => [
                'class' => UrlscanGetDom::class,
                'name' => 'Get DOM',
                'description' => 'DOM

Official urlscan.io endpoint: GET /dom/{scanId}/.',
                'parameters' => [
                    'scan_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'UUID of scan result',
                    ],
                ],
            ],
            'urlscan_get_response' => [
                'class' => UrlscanGetResponse::class,
                'name' => 'Get Response',
                'description' => 'Response

Official urlscan.io endpoint: GET /responses/{fileHash}/.',
                'parameters' => [
                    'file_hash' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'SHA256 hash of response',
                    ],
                ],
            ],
            'urlscan_update_result_visibility' => [
                'class' => UrlscanUpdateResultVisibility::class,
                'name' => 'Update Result Visibility',
                'description' => 'Update Result Visibility

Official urlscan.io endpoint: PUT /api/v1/result/{scanId}/visibility/.',
                'parameters' => [
                    'scan_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'UUID of scan result',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_delete_result_visibility' => [
                'class' => UrlscanDeleteResultVisibility::class,
                'name' => 'Delete Result Visibility',
                'description' => 'Reset to original visibility

Official urlscan.io endpoint: DELETE /api/v1/result/{scanId}/visibility/.',
                'parameters' => [
                    'scan_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'UUID of scan result',
                    ],
                ],
            ],
            'urlscan_get_available_countries' => [
                'class' => UrlscanGetAvailableCountries::class,
                'name' => 'Get Available Countries',
                'description' => 'Available Countries

Official urlscan.io endpoint: GET /api/v1/availableCountries.',
                'parameters' => [],
            ],
            'urlscan_get_user_agents' => [
                'class' => UrlscanGetUserAgents::class,
                'name' => 'Get User Agents',
                'description' => 'Available User Agents

Official urlscan.io endpoint: GET /api/v1/userAgents.',
                'parameters' => [],
            ],
            'urlscan_get_quotas' => [
                'class' => UrlscanGetQuotas::class,
                'name' => 'Get Quotas',
                'description' => 'API Quotas

Official urlscan.io endpoint: GET /api/v1/quotas.',
                'parameters' => [],
            ],
            'urlscan_get_available_brands' => [
                'class' => UrlscanGetAvailableBrands::class,
                'name' => 'Get Available Brands',
                'description' => 'Available Brands

Official urlscan.io endpoint: GET /api/v1/pro/availableBrands.',
                'parameters' => [],
            ],
            'urlscan_get_brand_summary' => [
                'class' => UrlscanGetBrandSummary::class,
                'name' => 'Get Brand Summary',
                'description' => 'Brands

Official urlscan.io endpoint: GET /api/v1/pro/brands.',
                'parameters' => [],
            ],
            'urlscan_get_phishfeed' => [
                'class' => UrlscanGetPhishfeed::class,
                'name' => 'Get Phishfeed',
                'description' => 'Phishfeed

Official urlscan.io endpoint: GET /api/v1/pro/phishfeed.',
                'parameters' => [
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'q',
                    ],
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'How many results to return',
                    ],
                    'format' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Can be one of csv, tsv, or json',
                        'enum' => ['csv', 'tsv', 'json'],
                    ],
                ],
            ],
            'urlscan_get_livescan_scanners' => [
                'class' => UrlscanGetLivescanScanners::class,
                'name' => 'Get Livescan Scanners',
                'description' => 'Live Scanners

Official urlscan.io endpoint: GET /api/v1/livescan/scanners/.',
                'parameters' => [],
            ],
            'urlscan_create_livescan_task' => [
                'class' => UrlscanCreateLivescanTask::class,
                'name' => 'Create Livescan Task',
                'description' => 'Non-Blocking Trigger Live Scan

Official urlscan.io endpoint: POST /api/v1/livescan/{scannerId}/task/.',
                'parameters' => [
                    'scanner_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'scannerId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_create_livescan_scan' => [
                'class' => UrlscanCreateLivescanScan::class,
                'name' => 'Create Livescan Scan',
                'description' => 'Trigger Live Scan

Official urlscan.io endpoint: POST /api/v1/livescan/{scannerId}/scan/.',
                'parameters' => [
                    'scanner_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'scannerId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_get_livescan_resource' => [
                'class' => UrlscanGetLivescanResource::class,
                'name' => 'Get Livescan Resource',
                'description' => 'Live Scan Get Resource

Official urlscan.io endpoint: GET /api/v1/livescan/{scannerId}/{resourceType}/{resourceId}.',
                'parameters' => [
                    'scanner_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'scannerId',
                    ],
                    'resource_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'resourceType',
                        'enum' => ['result', 'screenshot', 'dom', 'response', 'download'],
                    ],
                    'resource_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => '* For result, screenshot, dom: UUID of the scan * For response, download: The SHA256 of the resource',
                    ],
                ],
            ],
            'urlscan_store_livescan_result' => [
                'class' => UrlscanStoreLivescanResult::class,
                'name' => 'Store Livescan Result',
                'description' => 'Store Live Scan Result

Official urlscan.io endpoint: PUT /api/v1/livescan/{scannerId}/{scanId}/.',
                'parameters' => [
                    'scanner_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'scannerId',
                    ],
                    'scan_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'scanId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_discard_livescan_result' => [
                'class' => UrlscanDiscardLivescanResult::class,
                'name' => 'Discard Livescan Result',
                'description' => 'Purge Live Scan Result

Official urlscan.io endpoint: DELETE /api/v1/livescan/{scannerId}/{scanId}/.',
                'parameters' => [
                    'scanner_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'scannerId',
                    ],
                    'scan_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'scanId',
                    ],
                ],
            ],
            'urlscan_get_hostname_history' => [
                'class' => UrlscanGetHostnameHistory::class,
                'name' => 'Get Hostname History',
                'description' => 'Hostname History

Official urlscan.io endpoint: GET /api/v1/hostname/{hostname}.',
                'parameters' => [
                    'hostname' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The hostname to query',
                    ],
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Return at most this many results. Minimum 10 Maximum 10000 Default 1000',
                    ],
                    'page_state' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Returns additional results starting from this page state from the previous API call.',
                    ],
                ],
            ],
            'urlscan_get_pro_username' => [
                'class' => UrlscanGetProUsername::class,
                'name' => 'Get Pro Username',
                'description' => 'User Information

Official urlscan.io endpoint: GET /api/v1/pro/username.',
                'parameters' => [],
            ],
            'urlscan_get_similar_results' => [
                'class' => UrlscanGetSimilarResults::class,
                'name' => 'Get Similar Results',
                'description' => 'Structure Search

Official urlscan.io endpoint: GET /api/v1/pro/result/{scanId}/similar/.',
                'parameters' => [
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Additional query filter',
                    ],
                    'size' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Maximum results per call',
                    ],
                    'search_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Parameter to iterate over older results',
                    ],
                    'scan_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The original scan to compare to',
                    ],
                ],
            ],
            'urlscan_list_saved_searches' => [
                'class' => UrlscanListSavedSearches::class,
                'name' => 'List Saved Searches',
                'description' => 'Saved Searches

Official urlscan.io endpoint: GET /api/v1/user/searches/.',
                'parameters' => [],
            ],
            'urlscan_create_saved_search' => [
                'class' => UrlscanCreateSavedSearch::class,
                'name' => 'Create Saved Search',
                'description' => 'Create Saved Search

Official urlscan.io endpoint: POST /api/v1/user/searches/.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_update_saved_search' => [
                'class' => UrlscanUpdateSavedSearch::class,
                'name' => 'Update Saved Search',
                'description' => 'Update Saved Search

Official urlscan.io endpoint: PUT /api/v1/user/searches/{searchId}/.',
                'parameters' => [
                    'search_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'searchId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_delete_saved_search' => [
                'class' => UrlscanDeleteSavedSearch::class,
                'name' => 'Delete Saved Search',
                'description' => 'Delete Saved Search

Official urlscan.io endpoint: DELETE /api/v1/user/searches/{searchId}/.',
                'parameters' => [
                    'search_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'searchId',
                    ],
                ],
            ],
            'urlscan_get_saved_search_results' => [
                'class' => UrlscanGetSavedSearchResults::class,
                'name' => 'Get Saved Search Results',
                'description' => 'Saved Search Search Results

Official urlscan.io endpoint: GET /api/v1/user/searches/{searchId}/results/.',
                'parameters' => [
                    'search_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'searchId',
                    ],
                ],
            ],
            'urlscan_list_subscriptions' => [
                'class' => UrlscanListSubscriptions::class,
                'name' => 'List Subscriptions',
                'description' => 'Subscriptions

Official urlscan.io endpoint: GET /api/v1/user/subscriptions/.',
                'parameters' => [],
            ],
            'urlscan_create_subscription' => [
                'class' => UrlscanCreateSubscription::class,
                'name' => 'Create Subscription',
                'description' => 'Create Subscription

Official urlscan.io endpoint: POST /api/v1/user/subscriptions/.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_update_subscription' => [
                'class' => UrlscanUpdateSubscription::class,
                'name' => 'Update Subscription',
                'description' => 'Update Subscription

Official urlscan.io endpoint: PUT /api/v1/user/subscriptions/{subscriptionId}/.',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'subscriptionId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_delete_subscription' => [
                'class' => UrlscanDeleteSubscription::class,
                'name' => 'Delete Subscription',
                'description' => 'Delete Subscription

Official urlscan.io endpoint: DELETE /api/v1/user/subscriptions/{subscriptionId}/.',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'subscriptionId',
                    ],
                ],
            ],
            'urlscan_get_subscription_results' => [
                'class' => UrlscanGetSubscriptionResults::class,
                'name' => 'Get Subscription Results',
                'description' => 'Subscription Search Results

Official urlscan.io endpoint: GET /api/v1/user/subscriptions/{subscriptionId}/results/{datasource}/.',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'subscriptionId',
                    ],
                    'datasource' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'datasource',
                    ],
                ],
            ],
            'urlscan_list_channels' => [
                'class' => UrlscanListChannels::class,
                'name' => 'List Channels',
                'description' => 'Channels

Official urlscan.io endpoint: GET /api/v1/user/channels/.',
                'parameters' => [],
            ],
            'urlscan_create_channel' => [
                'class' => UrlscanCreateChannel::class,
                'name' => 'Create Channel',
                'description' => 'Create Channel

Official urlscan.io endpoint: POST /api/v1/user/channels/.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_get_channel' => [
                'class' => UrlscanGetChannel::class,
                'name' => 'Get Channel',
                'description' => 'Channel Search Results

Official urlscan.io endpoint: GET /api/v1/user/channels/{channelId}.',
                'parameters' => [
                    'channel_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'channelId',
                    ],
                ],
            ],
            'urlscan_update_channel' => [
                'class' => UrlscanUpdateChannel::class,
                'name' => 'Update Channel',
                'description' => 'Update Channel

Official urlscan.io endpoint: PUT /api/v1/user/channels/{channelId}.',
                'parameters' => [
                    'channel_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'channelId',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_create_incident' => [
                'class' => UrlscanCreateIncident::class,
                'name' => 'Create Incident',
                'description' => 'Create Incident

Official urlscan.io endpoint: POST /api/v1/user/incidents.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_get_incident' => [
                'class' => UrlscanGetIncident::class,
                'name' => 'Get Incident',
                'description' => 'Get Incident

Official urlscan.io endpoint: GET /api/v1/user/incidents/{incidentId}.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of incident',
                    ],
                ],
            ],
            'urlscan_update_incident' => [
                'class' => UrlscanUpdateIncident::class,
                'name' => 'Update Incident',
                'description' => 'Update Incident options

Official urlscan.io endpoint: PUT /api/v1/user/incidents/{incidentId}.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of incident',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_close_incident' => [
                'class' => UrlscanCloseIncident::class,
                'name' => 'Close Incident',
                'description' => 'Close Incident

Official urlscan.io endpoint: PUT /api/v1/user/incidents/{incidentId}/close.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of incident',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_restart_incident' => [
                'class' => UrlscanRestartIncident::class,
                'name' => 'Restart Incident',
                'description' => 'Restart Incident

Official urlscan.io endpoint: PUT /api/v1/user/incidents/{incidentId}/restart.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of incident',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_copy_incident' => [
                'class' => UrlscanCopyIncident::class,
                'name' => 'Copy Incident',
                'description' => 'Copy Incident

Official urlscan.io endpoint: POST /api/v1/user/incidents/{incidentId}/copy.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of incident',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_fork_incident' => [
                'class' => UrlscanForkIncident::class,
                'name' => 'Fork Incident',
                'description' => 'Fork Incident

Official urlscan.io endpoint: POST /api/v1/user/incidents/{incidentId}/fork.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of incident',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
                    ],
                ],
            ],
            'urlscan_get_watchable_attributes' => [
                'class' => UrlscanGetWatchableAttributes::class,
                'name' => 'Get Watchable Attributes',
                'description' => 'Get Watchable Attributes

Official urlscan.io endpoint: GET /api/v1/user/watchableAttributes.',
                'parameters' => [],
            ],
            'urlscan_get_incident_states' => [
                'class' => UrlscanGetIncidentStates::class,
                'name' => 'Get Incident States',
                'description' => 'Get Incident States

Official urlscan.io endpoint: GET /api/v1/user/incidentstates/{incidentId}/.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of incident',
                    ],
                ],
            ],
            'urlscan_list_datadumps' => [
                'class' => UrlscanListDatadumps::class,
                'name' => 'List Datadumps',
                'description' => 'List Data Dump Files

Official urlscan.io endpoint: GET /api/v1/datadump/list/{timeWindow}/{fileType}/{date}.',
                'parameters' => [
                    'time_window' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Time window of the data dump',
                        'enum' => ['days', 'hours', 'minutes'],
                    ],
                    'file_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Type of data dump file',
                        'enum' => ['api', 'search', 'screenshot', 'dom'],
                    ],
                    'date' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Date of the data dump in YYYYMMDD format',
                    ],
                ],
            ],
            'urlscan_get_datadump_link' => [
                'class' => UrlscanGetDatadumpLink::class,
                'name' => 'Get Datadump Link',
                'description' => 'Get Data Dump Download Link

Official urlscan.io endpoint: GET /api/v1/datadump/link/{path}.',
                'parameters' => [
                    'path' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Path of the data dump file',
                    ],
                ],
            ],
            'urlscan_download_file' => [
                'class' => UrlscanDownloadFile::class,
                'name' => 'Download File',
                'description' => 'Download a file

Official urlscan.io endpoint: GET /downloads/{fileHash}.',
                'parameters' => [
                    'file_hash' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'SHA256 hash of file',
                    ],
                    'password' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The password to use to encrypt the ZIP file. Using a password is mandatory, the default password is urlscan!',
                    ],
                    'filename' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Specify the name of the ZIP file that should be downloaded. This does not change the name of files within the ZIP archive. The default filename is $fileHash.zip',
                    ],
                ],
            ],
            'urlscan_lookup_malicious_observable' => [
                'class' => UrlscanLookupMaliciousObservable::class,
                'name' => 'Lookup Malicious Observable',
                'description' => 'Malicious observable lookup

Official urlscan.io endpoint: GET /api/v1/malicious/{type}/{value}.',
                'parameters' => [
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The type of observable to look up.',
                        'enum' => ['ip', 'hostname', 'domain', 'url'],
                    ],
                    'value' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The observable value. Format depends on `type`: - `ip`: an IP address (e.g. `192.0.2.1`) - `hostname`: a fully qualified hostname (e.g. `www.example.com`) - `domain`: an apex/registered domain (e.g. `example.com`) - `url`: a URL-encoded URL (e.g. `https%3A%2F%',
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): UrlscanService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new UrlscanService(apiKey: $creds->get('urlscan', 'api_key', '', $account), baseUrl: $creds->get('urlscan', 'url', 'https://urlscan.io', $account));
        }

        return app(UrlscanService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/urlscan.md'; }
    public function isIntegration(): bool { return true; }
}
