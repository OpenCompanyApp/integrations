<?php

namespace OpenCompany\Integrations­s;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides generated X Ads API tools.
 *
 * Tool metadata is generated from the official X Developer Platform Postman
 * collection for the Ads API.
 */
class XAdsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    public function appName(): string
    {
        return 'x_ads';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'X Ads',
            'description' => 'X advertising API',
            'icon' => 'simple-icons:x',
            'logo' => 'simple-icons:x',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'X Ads',
            'description' => 'Generated coverage of the X Ads API for ad accounts, campaigns, line items, creatives, targeting, audiences, analytics, and funding instruments.',
            'icon' => 'simple-icons:x',
            'logo' => 'simple-icons:x',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://docs.x.com/x-ads-api',
        ];
    }

    /**
     * Describe X Ads auth and host capability metadata.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'oauth1a_user_context',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token', 'pin_oauth1'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key', 'api_secret', 'access_token', 'access_token_secret'],
                'source' => [
                    'type' => 'postman_collection',
                    'url' => 'https://github.com/xdevplatform/postman-twitter-ads-api',
                    'operation_count' => 190,
                ],
                'notes' => [
                    'X Ads API access requires approval from X.',
                    'All requests are signed with OAuth 1.0a user-context credentials.',
                    'CLI setup works with manually stored tokens or PIN-based OAuth 1.0a.',
                ],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token_or_oauth1',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token_or_pin_oauth1',
                    'runtime_mode' => 'normal',
                ],
                'mcp_gateway' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'kosmokrator_gateway',
                    'runtime_mode' => 'request_response_tools',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
                'mcp_gateway_supported' => true,
                'lua_supported' => true,
            ],
            'seo' => [
                'aliases' => ['twitter ads', 'x ads api', 'ads-api.x.com', 'campaign management'],
            ],
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Validate X Ads credentials with a lightweight account listing request.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $service = new XAdsService(
            apiKey: (string) ($config['api_key'] ?? ''),
            apiSecret: (string) ($config['api_secret'] ?? ''),
            accessToken: (string) ($config['access_token'] ?? ''),
            accessTokenSecret: (string) ($config['access_token_secret'] ?? ''),
            accountId: (string) ($config['account_id'] ?? ''),
            apiVersion: (string) ($config['api_version'] ?? '11'),
            baseUrl: (string) ($config['base_url'] ?? 'https://ads-api.x.com'),
        );

        return $service->testConnection();
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'api_secret' => 'required|string',
            'access_token' => 'required|string',
            'access_token_secret' => 'required|string',
            'account_id' => 'nullable|string',
            'api_version' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'x_ads_get_stats_accounts_account_id_active_entities' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetStatsAccountsAccountIdActiveEntities',
                'type' => 'read',
                'name' => 'Get Stats Accounts Account ID Active Entities',
                'description' => 'X Ads API operation: Analytics / Active Entities stats/accounts/:account_id/active_entities.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'entity' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'campaign_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'funding_instrument_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'line_item_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_stats_accounts_account_id_active_entities',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/stats/accounts/{account_id}/active_entities',
                    'tags' => [
                        'Analytics',
                        'Active Entities',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_stats_jobs_accounts_account_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetStatsJobsAccountsAccountId',
                'type' => 'read',
                'name' => 'Get Stats Jobs Accounts Account ID',
                'description' => 'X Ads API operation: Analytics / Asynchronous Analytics stats/jobs/accounts/:account_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'job_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_stats_jobs_accounts_account_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/stats/jobs/accounts/{account_id}',
                    'tags' => [
                        'Analytics',
                        'Asynchronous Analytics',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'async_job',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_stats_jobs_accounts_account_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostStatsJobsAccountsAccountId',
                'type' => 'write',
                'name' => 'Post Stats Jobs Accounts Account ID',
                'description' => 'X Ads API operation: Analytics / Asynchronous Analytics stats/jobs/accounts/:account_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'entity' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'entity_ids' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'granularity' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'metric_groups' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'placement' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'country' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'platform' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'segmentation_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_stats_jobs_accounts_account_id',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/stats/jobs/accounts/{account_id}',
                    'tags' => [
                        'Analytics',
                        'Asynchronous Analytics',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'async_job',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_stats_jobs_accounts_account_id_job_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteStatsJobsAccountsAccountIdJobId',
                'type' => 'write',
                'name' => 'Delete Stats Jobs Accounts Account ID Job ID',
                'description' => 'X Ads API operation: Analytics / Asynchronous Analytics stats/jobs/accounts/:account_id/:job_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body or form fields for this X Ads API operation.',
                    ],
                ],
                'operation_id' => 'delete_stats_jobs_accounts_account_id_job_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/stats/jobs/accounts/{account_id}/:job_id',
                    'tags' => [
                        'Analytics',
                        'Asynchronous Analytics',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'async_job',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_auction_insights' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdAuctionInsights',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Auction Insights',
                'description' => 'X Ads API operation: Analytics / Auction Insights accounts/:account_id/auction_insights.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'granularity' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'line_item_ids' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'placement' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_auction_insights',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/auction_insights',
                    'tags' => [
                        'Analytics',
                        'Auction Insights',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_stats_accounts_account_id_reach_campaigns' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetStatsAccountsAccountIdReachCampaigns',
                'type' => 'read',
                'name' => 'Get Stats Accounts Account ID Reach Campaigns',
                'description' => 'X Ads API operation: Analytics / Reach and Average Frequency stats/accounts/:account_id/reach/campaigns.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'campaign_ids' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'get_stats_accounts_account_id_reach_campaigns',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/stats/accounts/{account_id}/reach/campaigns',
                    'tags' => [
                        'Analytics',
                        'Reach and Average Frequency',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_stats_accounts_account_id_reach_funding_instruments' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetStatsAccountsAccountIdReachFundingInstruments',
                'type' => 'read',
                'name' => 'Get Stats Accounts Account ID Reach Funding Instruments',
                'description' => 'X Ads API operation: Analytics / Reach and Average Frequency stats/accounts/:account_id/reach/funding_instruments.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'funding_instrument_ids' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'get_stats_accounts_account_id_reach_funding_instruments',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/stats/accounts/{account_id}/reach/funding_instruments',
                    'tags' => [
                        'Analytics',
                        'Reach and Average Frequency',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_stats_accounts_account_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetStatsAccountsAccountId',
                'type' => 'read',
                'name' => 'Get Stats Accounts Account ID',
                'description' => 'X Ads API operation: Analytics / Synchronous Analytics stats/accounts/:account_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'entity' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'entity_ids' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'granularity' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'metric_groups' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'placement' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'get_stats_accounts_account_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/stats/accounts/{account_id}',
                    'tags' => [
                        'Analytics',
                        'Synchronous Analytics',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_insights_accounts_account_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetInsightsAccountsAccountId',
                'type' => 'read',
                'name' => 'Get Insights Accounts Account ID',
                'description' => 'X Ads API operation: Audience / Insights insights/accounts/:account_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'audience_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'audience_value' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'interaction_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                ],
                'operation_id' => 'get_insights_accounts_account_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/insights/accounts/{account_id}',
                    'tags' => [
                        'Audience',
                        'Insights',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_insights_accounts_account_id_available_audiences' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetInsightsAccountsAccountIdAvailableAudiences',
                'type' => 'read',
                'name' => 'Get Insights Accounts Account ID Available Audiences',
                'description' => 'X Ads API operation: Audience / Insights insights/accounts/:account_id/available_audiences.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'get_insights_accounts_account_id_available_audiences',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/insights/accounts/{account_id}/available_audiences',
                    'tags' => [
                        'Audience',
                        'Insights',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_insights_keywords_search' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetInsightsKeywordsSearch',
                'type' => 'read',
                'name' => 'Get Insights Keywords Search',
                'description' => 'X Ads API operation: Audience / Keyword Insights insights/keywords/search.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'granularity' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'keywords' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'location' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'negative_keywords' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_insights_keywords_search',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/insights/keywords/search',
                    'tags' => [
                        'Audience',
                        'Keyword Insights',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_tailored_audiences_tailored_audience_id_permissions' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdTailoredAudiencesTailoredAudienceIdPermissions',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Tailored Audiences Tailored Audience ID Permissions',
                'description' => 'X Ads API operation: Audience / Tailored Audience Permissions accounts/:account_id/tailored_audiences/:tailored_audience_id/permissions.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'granted_account_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'tailored_audience_permission_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_tailored_audiences_tailored_audience_id_permissions',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/tailored_audiences/:tailored_audience_id/permissions',
                    'tags' => [
                        'Audience',
                        'Tailored Audience Permissions',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_tailored_audiences_tailored_audience_id_permissions' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdTailoredAudiencesTailoredAudienceIdPermissions',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Tailored Audiences Tailored Audience ID Permissions',
                'description' => 'X Ads API operation: Audience / Tailored Audience Permissions accounts/:account_id/tailored_audiences/:tailored_audience_id/permissions.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'granted_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'permission_level' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_tailored_audiences_tailored_audience_id_permissions',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/tailored_audiences/:tailored_audience_id/permissions',
                    'tags' => [
                        'Audience',
                        'Tailored Audience Permissions',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_tailored_audiences_tailored_audience_id_permissions_tailored_audience_permission_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdTailoredAudiencesTailoredAudienceIdPermissionsTailoredAudiencePermissionId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Tailored Audiences Tailored Audience ID Permissions Tailored Audience Permission ID',
                'description' => 'X Ads API operation: Audience / Tailored Audience Permissions accounts/:account_id/tailored_audiences/:tailored_audience_id/permissions/:tailored_audience_permission_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'tailored_audience_permission_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body or form fields for this X Ads API operation.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_tailored_audiences_tailored_audience_id_permissions_tailored_audience_permission_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/tailored_audiences/:tailored_audience_id/permissions/:tailored_audience_permission_id',
                    'tags' => [
                        'Audience',
                        'Tailored Audience Permissions',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_tailored_audiences' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdTailoredAudiences',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Tailored Audiences',
                'description' => 'X Ads API operation: Audience / Tailored Audiences accounts/:account_id/tailored_audiences.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'permission_scope' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'tailored_audience_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_tailored_audiences',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/tailored_audiences',
                    'tags' => [
                        'Audience',
                        'Tailored Audiences',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_tailored_audiences_tailored_audience_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdTailoredAudiencesTailoredAudienceId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Tailored Audiences Tailored Audience ID',
                'description' => 'X Ads API operation: Audience / Tailored Audiences accounts/:account_id/tailored_audiences/:tailored_audience_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_tailored_audiences_tailored_audience_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/tailored_audiences/:tailored_audience_id',
                    'tags' => [
                        'Audience',
                        'Tailored Audiences',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_tailored_audiences' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdTailoredAudiences',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Tailored Audiences',
                'description' => 'X Ads API operation: Audience / Tailored Audiences accounts/:account_id/tailored_audiences.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_tailored_audiences',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/tailored_audiences',
                    'tags' => [
                        'Audience',
                        'Tailored Audiences',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_batch_accounts_account_id_tailored_audiences' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostBatchAccountsAccountIdTailoredAudiences',
                'type' => 'write',
                'name' => 'Post Batch Accounts Account ID Tailored Audiences',
                'description' => 'X Ads API operation: Audience / Tailored Audiences batch/accounts/:account_id/tailored_audiences.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'audience_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'child_segments' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'operation_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'params' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'boolean_operator' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'lookback_window' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'segments' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'tailored_audience_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'frequency' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'frequency_comparator' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'negate' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_batch_accounts_account_id_tailored_audiences',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/batch/accounts/{account_id}/tailored_audiences',
                    'tags' => [
                        'Audience',
                        'Tailored Audiences',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_tailored_audiences_tailored_audience_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdTailoredAudiencesTailoredAudienceId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Tailored Audiences Tailored Audience ID',
                'description' => 'X Ads API operation: Audience / Tailored Audiences accounts/:account_id/tailored_audiences/:tailored_audience_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body or form fields for this X Ads API operation.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_tailored_audiences_tailored_audience_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/tailored_audiences/:tailored_audience_id',
                    'tags' => [
                        'Audience',
                        'Tailored Audiences',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_tailored_audiences_tailored_audience_id_users' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdTailoredAudiencesTailoredAudienceIdUsers',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Tailored Audiences Tailored Audience ID Users',
                'description' => 'X Ads API operation: Audience / Tailored Audiences Users accounts/:account_id/tailored_audiences/:tailored_audience_id/users.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'operation_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'params' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'users' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'effective_at' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'expires_at' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_tailored_audiences_tailored_audience_id_users',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/tailored_audiences/:tailored_audience_id/users',
                    'tags' => [
                        'Audience',
                        'Tailored Audiences Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccounts',
                'type' => 'read',
                'name' => 'Get Accounts',
                'description' => 'X Ads API operation: Campaign Management / Accounts accounts.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts',
                    'tags' => [
                        'Campaign Management',
                        'Accounts',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID',
                'description' => 'X Ads API operation: Campaign Management / Accounts accounts/:account_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}',
                    'tags' => [
                        'Campaign Management',
                        'Accounts',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccounts',
                'type' => 'write',
                'name' => 'Post Accounts',
                'description' => 'X Ads API operation: Campaign Management / Accounts accounts.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                ],
                'operation_id' => 'post_accounts',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts',
                    'tags' => [
                        'Campaign Management',
                        'Accounts',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID',
                'description' => 'X Ads API operation: Campaign Management / Accounts accounts/:account_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'industry_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}',
                    'tags' => [
                        'Campaign Management',
                        'Accounts',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID',
                'description' => 'X Ads API operation: Campaign Management / Accounts accounts/:account_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}',
                    'tags' => [
                        'Campaign Management',
                        'Accounts',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_authenticated_user_access' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdAuthenticatedUserAccess',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Authenticated User Access',
                'description' => 'X Ads API operation: Campaign Management / Authenticated User Access accounts/:account_id/authenticated_user_access.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_authenticated_user_access',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/authenticated_user_access',
                    'tags' => [
                        'Campaign Management',
                        'Authenticated User Access',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_bidding_rules' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetBiddingRules',
                'type' => 'read',
                'name' => 'Get Bidding Rules',
                'description' => 'X Ads API operation: Campaign Management / Bidding Rules bidding_rules.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'currency' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_bidding_rules',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/bidding_rules',
                    'tags' => [
                        'Campaign Management',
                        'Bidding Rules',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_campaigns' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCampaigns',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Campaigns',
                'description' => 'X Ads API operation: Campaign Management / Campaigns accounts/:account_id/campaigns.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'campaign_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'funding_instrument_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_draft' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_campaigns',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/campaigns',
                    'tags' => [
                        'Campaign Management',
                        'Campaigns',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_campaigns_campaign_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCampaignsCampaignId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Campaigns Campaign ID',
                'description' => 'X Ads API operation: Campaign Management / Campaigns accounts/:account_id/campaigns/:campaign_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_campaigns_campaign_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/campaigns/:campaign_id',
                    'tags' => [
                        'Campaign Management',
                        'Campaigns',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_campaigns' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdCampaigns',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Campaigns',
                'description' => 'X Ads API operation: Campaign Management / Campaigns accounts/:account_id/campaigns.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'funding_instrument_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'daily_budget_amount_local_micro' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'duration_in_days' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'entity_status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'frequency_cap' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'standard_delivery' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'total_budget_amount_local_micro' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_campaigns',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/campaigns',
                    'tags' => [
                        'Campaign Management',
                        'Campaigns',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_batch_accounts_account_id_campaigns' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostBatchAccountsAccountIdCampaigns',
                'type' => 'write',
                'name' => 'Post Batch Accounts Account ID Campaigns',
                'description' => 'X Ads API operation: Campaign Management / Campaigns batch/accounts/:account_id/campaigns.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'operation_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'params' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_batch_accounts_account_id_campaigns',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/batch/accounts/{account_id}/campaigns',
                    'tags' => [
                        'Campaign Management',
                        'Campaigns',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_campaigns_campaign_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdCampaignsCampaignId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Campaigns Campaign ID',
                'description' => 'X Ads API operation: Campaign Management / Campaigns accounts/:account_id/campaigns/:campaign_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'daily_budget_amount_local_micro' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'entity_status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'duration_in_days' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'frequency_cap' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'standard_delivery' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'total_budget_amount_local_micro' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_campaigns_campaign_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/campaigns/:campaign_id',
                    'tags' => [
                        'Campaign Management',
                        'Campaigns',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_campaigns_campaign_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdCampaignsCampaignId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Campaigns Campaign ID',
                'description' => 'X Ads API operation: Campaign Management / Campaigns accounts/:account_id/campaigns/:campaign_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_campaigns_campaign_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/campaigns/:campaign_id',
                    'tags' => [
                        'Campaign Management',
                        'Campaigns',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_content_categories' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetContentCategories',
                'type' => 'read',
                'name' => 'Get Content Categories',
                'description' => 'X Ads API operation: Campaign Management / Content Categories content_categories.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                ],
                'operation_id' => 'get_content_categories',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/content_categories',
                    'tags' => [
                        'Campaign Management',
                        'Content Categories',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_features' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdFeatures',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Features',
                'description' => 'X Ads API operation: Campaign Management / Features accounts/:account_id/features.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'feature_keys' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_features',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/features',
                    'tags' => [
                        'Campaign Management',
                        'Features',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_features' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdFeatures',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Features',
                'description' => 'X Ads API operation: Campaign Management / Features accounts/:account_id/features.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'feature_keys' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_features',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/features',
                    'tags' => [
                        'Campaign Management',
                        'Features',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_features' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdFeatures',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Features',
                'description' => 'X Ads API operation: Campaign Management / Features accounts/:account_id/features.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'feature_keys' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_features',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/features',
                    'tags' => [
                        'Campaign Management',
                        'Features',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_funding_instruments' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdFundingInstruments',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Funding Instruments',
                'description' => 'X Ads API operation: Campaign Management / Funding Instruments accounts/:account_id/funding_instruments.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'funding_instrument_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_funding_instruments',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/funding_instruments',
                    'tags' => [
                        'Campaign Management',
                        'Funding Instruments',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_funding_instruments_funding_instrument_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdFundingInstrumentsFundingInstrumentId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Funding Instruments Funding Instrument ID',
                'description' => 'X Ads API operation: Campaign Management / Funding Instruments accounts/:account_id/funding_instruments/:funding_instrument_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'funding_instrument_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_funding_instruments_funding_instrument_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/funding_instruments/:funding_instrument_id',
                    'tags' => [
                        'Campaign Management',
                        'Funding Instruments',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_funding_instruments' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdFundingInstruments',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Funding Instruments',
                'description' => 'X Ads API operation: Campaign Management / Funding Instruments accounts/:account_id/funding_instruments.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'currency' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'credit_limit_local_micro' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'funded_amount_local_micro' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_funding_instruments',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/funding_instruments',
                    'tags' => [
                        'Campaign Management',
                        'Funding Instruments',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_funding_instruments_funding_instrument_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdFundingInstrumentsFundingInstrumentId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Funding Instruments Funding Instrument ID',
                'description' => 'X Ads API operation: Campaign Management / Funding Instruments accounts/:account_id/funding_instruments/:funding_instrument_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'funding_instrument_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'funded_amount_local_micro' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'paused' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_funding_instruments_funding_instrument_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/funding_instruments/:funding_instrument_id',
                    'tags' => [
                        'Campaign Management',
                        'Funding Instruments',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_funding_instruments_funding_instrument_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdFundingInstrumentsFundingInstrumentId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Funding Instruments Funding Instrument ID',
                'description' => 'X Ads API operation: Campaign Management / Funding Instruments accounts/:account_id/funding_instruments/:funding_instrument_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'funding_instrument_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_funding_instruments_funding_instrument_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/funding_instruments/:funding_instrument_id',
                    'tags' => [
                        'Campaign Management',
                        'Funding Instruments',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_iab_categories' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetIabCategories',
                'type' => 'read',
                'name' => 'Get Iab Categories',
                'description' => 'X Ads API operation: Campaign Management / IAB Categories iab_categories.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_iab_categories',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/iab_categories',
                    'tags' => [
                        'Campaign Management',
                        'IAB Categories',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_line_items' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdLineItems',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Line Items',
                'description' => 'X Ads API operation: Campaign Management / Line Items accounts/:account_id/line_items.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'campaign_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'funding_instrument_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'line_item_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_draft' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_line_items',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/line_items',
                    'tags' => [
                        'Campaign Management',
                        'Line Items',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_line_items_line_item_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdLineItemsLineItemId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Line Items Line Item ID',
                'description' => 'X Ads API operation: Campaign Management / Line Items accounts/:account_id/line_items/:line_item_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_line_items_line_item_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/line_items/:line_item_id',
                    'tags' => [
                        'Campaign Management',
                        'Line Items',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_line_items' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdLineItems',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Line Items',
                'description' => 'X Ads API operation: Campaign Management / Line Items accounts/:account_id/line_items.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'campaign_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'objective' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'placements' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'product_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'advertiser_domain' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'bid_amount_local_micro' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'categories' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'primary_web_event_tag' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'advertiser_user_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'automatically_select_bid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'bid_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'bid_unit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'charge_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'entity_status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'include_sentiment' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'audience_expansion' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'optimization' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'total_budget_amount_local_micro' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'tracking_tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_line_items',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/line_items',
                    'tags' => [
                        'Campaign Management',
                        'Line Items',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_batch_accounts_account_id_line_items' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostBatchAccountsAccountIdLineItems',
                'type' => 'write',
                'name' => 'Post Batch Accounts Account ID Line Items',
                'description' => 'X Ads API operation: Campaign Management / Line Items batch/accounts/:account_id/line_items.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'operation_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'params' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_batch_accounts_account_id_line_items',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/batch/accounts/{account_id}/line_items',
                    'tags' => [
                        'Campaign Management',
                        'Line Items',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_line_items_line_item_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdLineItemsLineItemId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Line Items Line Item ID',
                'description' => 'X Ads API operation: Campaign Management / Line Items accounts/:account_id/line_items/:line_item_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'advertiser_domain' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'advertiser_user_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'automatically_select_bid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'bid_amount_local_micro' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'bid_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'categories' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'entity_status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'include_sentiment' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'audience_expansion' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'optimization' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'total_budget_amount_local_micro' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'tracking_tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_line_items_line_item_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/line_items/:line_item_id',
                    'tags' => [
                        'Campaign Management',
                        'Line Items',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_line_items_line_item_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdLineItemsLineItemId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Line Items Line Item ID',
                'description' => 'X Ads API operation: Campaign Management / Line Items accounts/:account_id/line_items/:line_item_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_line_items_line_item_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/line_items/:line_item_id',
                    'tags' => [
                        'Campaign Management',
                        'Line Items',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_line_item_apps' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdLineItemApps',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Line Item Apps',
                'description' => 'X Ads API operation: Campaign Management / Line Item Apps accounts/:account_id/line_item_apps.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'line_item_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'line_item_app_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_line_item_apps',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/line_item_apps',
                    'tags' => [
                        'Campaign Management',
                        'Line Item Apps',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_line_item_apps_line_item_app_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdLineItemAppsLineItemAppId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Line Item Apps Line Item App ID',
                'description' => 'X Ads API operation: Campaign Management / Line Item Apps accounts/:account_id/line_item_apps/:line_item_app_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_line_item_apps_line_item_app_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/line_item_apps/:line_item_app_id',
                    'tags' => [
                        'Campaign Management',
                        'Line Item Apps',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_line_item_apps' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdLineItemApps',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Line Item Apps',
                'description' => 'X Ads API operation: Campaign Management / Line Item Apps accounts/:account_id/line_item_apps.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'app_store_identifier' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'line_item_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'os_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_line_item_apps',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/line_item_apps',
                    'tags' => [
                        'Campaign Management',
                        'Line Item Apps',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_line_item_apps_line_item_app_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdLineItemAppsLineItemAppId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Line Item Apps Line Item App ID',
                'description' => 'X Ads API operation: Campaign Management / Line Item Apps accounts/:account_id/line_item_apps/:line_item_app_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_line_item_apps_line_item_app_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/line_item_apps/:line_item_app_id',
                    'tags' => [
                        'Campaign Management',
                        'Line Item Apps',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_line_items_placements' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetLineItemsPlacements',
                'type' => 'read',
                'name' => 'Get Line Items Placements',
                'description' => 'X Ads API operation: Campaign Management / Line Item Placements line_items/placements.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'product_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_line_items_placements',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/line_items/placements',
                    'tags' => [
                        'Campaign Management',
                        'Line Item Placements',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_media_creatives' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdMediaCreatives',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Media Creatives',
                'description' => 'X Ads API operation: Campaign Management / Media Creatives accounts/:account_id/media_creatives.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'campaign_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'line_item_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_creative_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_media_creatives',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/media_creatives',
                    'tags' => [
                        'Campaign Management',
                        'Media Creatives',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_media_creatives_media_creative_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdMediaCreativesMediaCreativeId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Media Creatives Media Creative ID',
                'description' => 'X Ads API operation: Campaign Management / Media Creatives accounts/:account_id/media_creatives/:media_creative_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_media_creatives_media_creative_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/media_creatives/:media_creative_id',
                    'tags' => [
                        'Campaign Management',
                        'Media Creatives',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_media_creatives' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdMediaCreatives',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Media Creatives',
                'description' => 'X Ads API operation: Campaign Management / Media Creatives accounts/:account_id/media_creatives.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'account_media_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'line_item_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'landing_url' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_media_creatives',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/media_creatives',
                    'tags' => [
                        'Campaign Management',
                        'Media Creatives',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_media_creatives_media_creative_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdMediaCreativesMediaCreativeId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Media Creatives Media Creative ID',
                'description' => 'X Ads API operation: Campaign Management / Media Creatives accounts/:account_id/media_creatives/:media_creative_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_media_creatives_media_creative_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/media_creatives/:media_creative_id',
                    'tags' => [
                        'Campaign Management',
                        'Media Creatives',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_promoted_accounts' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdPromotedAccounts',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Promoted Accounts',
                'description' => 'X Ads API operation: Campaign Management / Promoted Accounts accounts/:account_id/promoted_accounts.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'line_item_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'promoted_account_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_promoted_accounts',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/promoted_accounts',
                    'tags' => [
                        'Campaign Management',
                        'Promoted Accounts',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_promoted_accounts_promoted_account_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdPromotedAccountsPromotedAccountId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Promoted Accounts Promoted Account ID',
                'description' => 'X Ads API operation: Campaign Management / Promoted Accounts accounts/:account_id/promoted_accounts/:promoted_account_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_promoted_accounts_promoted_account_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/promoted_accounts/:promoted_account_id',
                    'tags' => [
                        'Campaign Management',
                        'Promoted Accounts',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_promoted_accounts' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdPromotedAccounts',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Promoted Accounts',
                'description' => 'X Ads API operation: Campaign Management / Promoted Accounts accounts/:account_id/promoted_accounts.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'line_item_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_promoted_accounts',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/promoted_accounts',
                    'tags' => [
                        'Campaign Management',
                        'Promoted Accounts',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_promoted_accounts_promoted_account_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdPromotedAccountsPromotedAccountId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Promoted Accounts Promoted Account ID',
                'description' => 'X Ads API operation: Campaign Management / Promoted Accounts accounts/:account_id/promoted_accounts/:promoted_account_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_promoted_accounts_promoted_account_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/promoted_accounts/:promoted_account_id',
                    'tags' => [
                        'Campaign Management',
                        'Promoted Accounts',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_promoted_tweets' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdPromotedTweets',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Promoted Tweets',
                'description' => 'X Ads API operation: Campaign Management / Promoted Tweets accounts/:account_id/promoted_tweets.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'line_item_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'promoted_tweet_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_promoted_tweets',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/promoted_tweets',
                    'tags' => [
                        'Campaign Management',
                        'Promoted Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_promoted_tweets_promoted_tweet_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdPromotedTweetsPromotedTweetId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Promoted Tweets Promoted Tweet ID',
                'description' => 'X Ads API operation: Campaign Management / Promoted Tweets accounts/:account_id/promoted_tweets/:promoted_tweet_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_promoted_tweets_promoted_tweet_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/promoted_tweets/:promoted_tweet_id',
                    'tags' => [
                        'Campaign Management',
                        'Promoted Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_promoted_tweets' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdPromotedTweets',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Promoted Tweets',
                'description' => 'X Ads API operation: Campaign Management / Promoted Tweets accounts/:account_id/promoted_tweets.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'line_item_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'tweet_ids' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_promoted_tweets',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/promoted_tweets',
                    'tags' => [
                        'Campaign Management',
                        'Promoted Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_promoted_tweets_promoted_tweet_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdPromotedTweetsPromotedTweetId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Promoted Tweets Promoted Tweet ID',
                'description' => 'X Ads API operation: Campaign Management / Promoted Tweets accounts/:account_id/promoted_tweets/:promoted_tweet_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_promoted_tweets_promoted_tweet_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/promoted_tweets/:promoted_tweet_id',
                    'tags' => [
                        'Campaign Management',
                        'Promoted Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_promotable_users' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdPromotableUsers',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Promotable Users',
                'description' => 'X Ads API operation: Campaign Management / Promotable Users accounts/:account_id/promotable_users.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'promotable_user_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_promotable_users',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/promotable_users',
                    'tags' => [
                        'Campaign Management',
                        'Promotable Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_promotable_users_promotable_user_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdPromotableUsersPromotableUserId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Promotable Users Promotable User ID',
                'description' => 'X Ads API operation: Campaign Management / Promotable Users accounts/:account_id/promotable_users/:promotable_user_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'promotable_user_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_promotable_users_promotable_user_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/promotable_users/:promotable_user_id',
                    'tags' => [
                        'Campaign Management',
                        'Promotable Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_scheduled_promoted_tweets' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdScheduledPromotedTweets',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Scheduled Promoted Tweets',
                'description' => 'X Ads API operation: Campaign Management / Scheduled Promoted Tweets accounts/:account_id/scheduled_promoted_tweets.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'line_item_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'scheduled_promoted_tweet_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_scheduled_promoted_tweets',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/scheduled_promoted_tweets',
                    'tags' => [
                        'Campaign Management',
                        'Scheduled Promoted Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_scheduled_promoted_tweets_scheduled_promoted_tweet_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdScheduledPromotedTweetsScheduledPromotedTweetId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Scheduled Promoted Tweets Scheduled Promoted Tweet ID',
                'description' => 'X Ads API operation: Campaign Management / Scheduled Promoted Tweets accounts/:account_id/scheduled_promoted_tweets/:scheduled_promoted_tweet_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'scheduled_promoted_tweet_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_scheduled_promoted_tweets_scheduled_promoted_tweet_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/scheduled_promoted_tweets/:scheduled_promoted_tweet_id',
                    'tags' => [
                        'Campaign Management',
                        'Scheduled Promoted Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_scheduled_promoted_tweets' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdScheduledPromotedTweets',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Scheduled Promoted Tweets',
                'description' => 'X Ads API operation: Campaign Management / Scheduled Promoted Tweets accounts/:account_id/scheduled_promoted_tweets.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'line_item_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'scheduled_tweet_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_scheduled_promoted_tweets',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/scheduled_promoted_tweets',
                    'tags' => [
                        'Campaign Management',
                        'Scheduled Promoted Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_scheduled_promoted_tweets_scheduled_promoted_tweet_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdScheduledPromotedTweetsScheduledPromotedTweetId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Scheduled Promoted Tweets Scheduled Promoted Tweet ID',
                'description' => 'X Ads API operation: Campaign Management / Scheduled Promoted Tweets accounts/:account_id/scheduled_promoted_tweets/:scheduled_promoted_tweet_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'scheduled_promoted_tweet_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_scheduled_promoted_tweets_scheduled_promoted_tweet_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/scheduled_promoted_tweets/:scheduled_promoted_tweet_id',
                    'tags' => [
                        'Campaign Management',
                        'Scheduled Promoted Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_targeting_criteria' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdTargetingCriteria',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Targeting Criteria',
                'description' => 'X Ads API operation: Campaign Management / Targeting Criteria accounts/:account_id/targeting_criteria.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'line_item_ids' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'lang' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'targeting_criterion_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_targeting_criteria',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/targeting_criteria',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Criteria',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_targeting_criteria_targeting_criterion_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdTargetingCriteriaTargetingCriterionId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Targeting Criteria Targeting Criterion ID',
                'description' => 'X Ads API operation: Campaign Management / Targeting Criteria accounts/:account_id/targeting_criteria/:targeting_criterion_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'lang' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_targeting_criteria_targeting_criterion_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/targeting_criteria/:targeting_criterion_id',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Criteria',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_targeting_criteria' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdTargetingCriteria',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Targeting Criteria',
                'description' => 'X Ads API operation: Campaign Management / Targeting Criteria accounts/:account_id/targeting_criteria.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'line_item_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'targeting_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'targeting_value' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'tailored_audience_expansion' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'operator_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_targeting_criteria',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/targeting_criteria',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Criteria',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_batch_accounts_account_id_targeting_criteria' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostBatchAccountsAccountIdTargetingCriteria',
                'type' => 'write',
                'name' => 'Post Batch Accounts Account ID Targeting Criteria',
                'description' => 'X Ads API operation: Campaign Management / Targeting Criteria batch/accounts/:account_id/targeting_criteria.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'operation_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'params' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_batch_accounts_account_id_targeting_criteria',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/batch/accounts/{account_id}/targeting_criteria',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Criteria',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_targeting_criteria_targeting_criterion_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdTargetingCriteriaTargetingCriterionId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Targeting Criteria Targeting Criterion ID',
                'description' => 'X Ads API operation: Campaign Management / Targeting Criteria accounts/:account_id/targeting_criteria/:targeting_criterion_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_targeting_criteria_targeting_criterion_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/targeting_criteria/:targeting_criterion_id',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Criteria',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_app_store_categories' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaAppStoreCategories',
                'type' => 'read',
                'name' => 'Get Targeting Criteria App Store Categories',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/app_store_categories.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'os_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_app_store_categories',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/app_store_categories',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_behavior_taxonomies' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaBehaviorTaxonomies',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Behavior Taxonomies',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/behavior_taxonomies.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'parent_behavior_taxonomy_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_behavior_taxonomies',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/behavior_taxonomies',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_behaviors' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaBehaviors',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Behaviors',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/behaviors.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'country_code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_behaviors',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/behaviors',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_conversations' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaConversations',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Conversations',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/conversations.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'conversation_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_conversations',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/conversations',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_devices' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaDevices',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Devices',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/devices.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'os_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_devices',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/devices',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_events' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaEvents',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Events',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/events.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'event_types' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'country_codes' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_events',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/events',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_interests' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaInterests',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Interests',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/interests.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_interests',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/interests',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_languages' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaLanguages',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Languages',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/languages.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_languages',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/languages',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_locations' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaLocations',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Locations',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/locations.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'country_code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'location_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_locations',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/locations',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_network_operators' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaNetworkOperators',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Network Operators',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/network_operators.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'country_code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_network_operators',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/network_operators',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_platform_versions' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaPlatformVersions',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Platform Versions',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/platform_versions.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'os_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_platform_versions',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/platform_versions',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_platforms' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaPlatforms',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Platforms',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/platforms.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'lang' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_platforms',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/platforms',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_tv_markets' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaTvMarkets',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Tv Markets',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/tv_markets.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                ],
                'operation_id' => 'get_targeting_criteria_tv_markets',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/tv_markets',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_targeting_criteria_tv_shows' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetTargetingCriteriaTvShows',
                'type' => 'read',
                'name' => 'Get Targeting Criteria Tv Shows',
                'description' => 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/tv_shows.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'locale' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_targeting_criteria_tv_shows',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/targeting_criteria/tv_shows',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Options',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_targeting_suggestions' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdTargetingSuggestions',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Targeting Suggestions',
                'description' => 'X Ads API operation: Campaign Management / Targeting Suggestions accounts/:account_id/targeting_suggestions.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'suggestion_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'targeting_values' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_targeting_suggestions',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/targeting_suggestions',
                    'tags' => [
                        'Campaign Management',
                        'Targeting Suggestions',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_tax_settings' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdTaxSettings',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Tax Settings',
                'description' => 'X Ads API operation: Campaign Management / Tax Settings accounts/:account_id/tax_settings.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_tax_settings',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/tax_settings',
                    'tags' => [
                        'Campaign Management',
                        'Tax Settings',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_tax_settings' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdTaxSettings',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Tax Settings',
                'description' => 'X Ads API operation: Campaign Management / Tax Settings accounts/:account_id/tax_settings.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'address_city' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'address_country' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'address_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'address_first_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'address_last_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'address_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'address_postal_code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'address_region' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'address_street1' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'address_street2' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'bill_to' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'business_relationship' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'client_address_city' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'client_address_country' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'client_address_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'client_address_first_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'client_address_last_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'client_address_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'client_address_postal_code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'client_address_region' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'client_address_street1' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'client_address_street2' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'invoice_jurisdiction' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'tax_category' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'tax_exemption_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'tax_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_tax_settings',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/tax_settings',
                    'tags' => [
                        'Campaign Management',
                        'Tax Settings',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_user_settings_user_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdUserSettingsUserId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID User Settings User ID',
                'description' => 'X Ads API operation: Campaign Management / User Settings accounts/:account_id/user_settings/:user_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_user_settings_user_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/user_settings/:user_id',
                    'tags' => [
                        'Campaign Management',
                        'User Settings',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_user_settings_user_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdUserSettingsUserId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID User Settings User ID',
                'description' => 'X Ads API operation: Campaign Management / User Settings accounts/:account_id/user_settings/:user_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'notification_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'contact_phone' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'contact_phone_extension' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'subscribed_email_types' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_user_settings_user_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/user_settings/:user_id',
                    'tags' => [
                        'Campaign Management',
                        'User Settings',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_advertiser_business_categories' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAdvertiserBusinessCategories',
                'type' => 'read',
                'name' => 'Get Advertiser Business Categories',
                'description' => 'X Ads API operation: Campaign Management / Advertiser Business Categories advertiser_business_categories.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                ],
                'operation_id' => 'get_advertiser_business_categories',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/advertiser_business_categories',
                    'tags' => [
                        'Campaign Management',
                        'Advertiser Business Categories',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_audience_summary' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdAudienceSummary',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Audience Summary',
                'description' => 'X Ads API operation: Campaign Management / Audience Summary accounts/:account_id/audience_summary.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'targeting_criteria' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_audience_summary',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/audience_summary',
                    'tags' => [
                        'Campaign Management',
                        'Audience Summary',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_account_media' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdAccountMedia',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Account Media',
                'description' => 'X Ads API operation: Creatives / Account Media accounts/:account_id/account_media.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'account_media_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_account_media',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/account_media',
                    'tags' => [
                        'Creatives',
                        'Account Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_account_media_account_media_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdAccountMediaAccountMediaId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Account Media Account Media ID',
                'description' => 'X Ads API operation: Creatives / Account Media accounts/:account_id/account_media/:account_media_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_account_media_account_media_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/account_media/:account_media_id',
                    'tags' => [
                        'Creatives',
                        'Account Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_account_media_account_media_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdAccountMediaAccountMediaId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Account Media Account Media ID',
                'description' => 'X Ads API operation: Creatives / Account Media accounts/:account_id/account_media/:account_media_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_account_media_account_media_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/account_media/:account_media_id',
                    'tags' => [
                        'Creatives',
                        'Account Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_all' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsAll',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards All',
                'description' => 'X Ads API operation: Creatives / Cards Fetch accounts/:account_id/cards/all.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_uris' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_all',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/all',
                    'tags' => [
                        'Creatives',
                        'Cards Fetch',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_all_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsAllCardId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards All Card ID',
                'description' => 'X Ads API operation: Creatives / Cards Fetch accounts/:account_id/cards/all/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_all_card_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/all/:card_id',
                    'tags' => [
                        'Creatives',
                        'Cards Fetch',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_tweets' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdTweets',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Tweets',
                'description' => 'X Ads API operation: Creatives / Tweets accounts/:account_id/tweets.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'tweet_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'timeline_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'trim_user' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'tweet_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'user_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_tweets',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/tweets',
                    'tags' => [
                        'Creatives',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_tweet' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdTweet',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Tweet',
                'description' => 'X Ads API operation: Creatives / Tweets accounts/:account_id/tweet.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'as_user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'text' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'card_uri' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_keys' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'nullcast' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'trim_user' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'tweet_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'video_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'video_cta_value' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'video_description' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'video_title' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_tweet',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/tweet',
                    'tags' => [
                        'Creatives',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_draft_tweets' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdDraftTweets',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Draft Tweets',
                'description' => 'X Ads API operation: Creatives / Draft Tweets accounts/:account_id/draft_tweets.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'user_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_draft_tweets',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/draft_tweets',
                    'tags' => [
                        'Creatives',
                        'Draft Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_draft_tweets_draft_tweet_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdDraftTweetsDraftTweetId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Draft Tweets Draft Tweet ID',
                'description' => 'X Ads API operation: Creatives / Draft Tweets accounts/:account_id/draft_tweets/:draft_tweet_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_draft_tweets_draft_tweet_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/draft_tweets/:draft_tweet_id',
                    'tags' => [
                        'Creatives',
                        'Draft Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_draft_tweets' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdDraftTweets',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Draft Tweets',
                'description' => 'X Ads API operation: Creatives / Draft Tweets accounts/:account_id/draft_tweets.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'as_user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'text' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'card_uri' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_keys' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'nullcast' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_draft_tweets',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/draft_tweets',
                    'tags' => [
                        'Creatives',
                        'Draft Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_draft_tweets_draft_tweet_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdDraftTweetsDraftTweetId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Draft Tweets Draft Tweet ID',
                'description' => 'X Ads API operation: Creatives / Draft Tweets accounts/:account_id/draft_tweets/:draft_tweet_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_uri' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_keys' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'nullcast' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_draft_tweets_draft_tweet_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/draft_tweets/:draft_tweet_id',
                    'tags' => [
                        'Creatives',
                        'Draft Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_draft_tweets_draft_tweet_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdDraftTweetsDraftTweetId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Draft Tweets Draft Tweet ID',
                'description' => 'X Ads API operation: Creatives / Draft Tweets accounts/:account_id/draft_tweets/:draft_tweet_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_draft_tweets_draft_tweet_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/draft_tweets/:draft_tweet_id',
                    'tags' => [
                        'Creatives',
                        'Draft Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_draft_tweets_preview_draft_tweet_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdDraftTweetsPreviewDraftTweetId',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Draft Tweets Preview Draft Tweet ID',
                'description' => 'X Ads API operation: Creatives / Draft Tweets accounts/:account_id/draft_tweets/preview/:draft_tweet_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_draft_tweets_preview_draft_tweet_id',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/draft_tweets/preview/:draft_tweet_id',
                    'tags' => [
                        'Creatives',
                        'Draft Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_scheduled_tweets' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdScheduledTweets',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Scheduled Tweets',
                'description' => 'X Ads API operation: Creatives / Scheduled Tweets accounts/:account_id/scheduled_tweets.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'user_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_scheduled_tweets',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/scheduled_tweets',
                    'tags' => [
                        'Creatives',
                        'Scheduled Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_scheduled_tweets_scheduled_tweet_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdScheduledTweetsScheduledTweetId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Scheduled Tweets Scheduled Tweet ID',
                'description' => 'X Ads API operation: Creatives / Scheduled Tweets accounts/:account_id/scheduled_tweets/:scheduled_tweet_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'scheduled_tweet_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_scheduled_tweets_scheduled_tweet_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/scheduled_tweets/:scheduled_tweet_id',
                    'tags' => [
                        'Creatives',
                        'Scheduled Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_scheduled_tweets' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdScheduledTweets',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Scheduled Tweets',
                'description' => 'X Ads API operation: Creatives / Scheduled Tweets accounts/:account_id/scheduled_tweets.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'as_user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'scheduled_at' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'text' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'card_uri' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_keys' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'nullcast' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_scheduled_tweets',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/scheduled_tweets',
                    'tags' => [
                        'Creatives',
                        'Scheduled Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_scheduled_tweets_scheduled_tweet_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdScheduledTweetsScheduledTweetId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Scheduled Tweets Scheduled Tweet ID',
                'description' => 'X Ads API operation: Creatives / Scheduled Tweets accounts/:account_id/scheduled_tweets/:scheduled_tweet_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'scheduled_tweet_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'card_uri' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_keys' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'nullcast' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'scheduled_at' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_scheduled_tweets_scheduled_tweet_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/scheduled_tweets/:scheduled_tweet_id',
                    'tags' => [
                        'Creatives',
                        'Scheduled Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_scheduled_tweets_scheduled_tweet_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdScheduledTweetsScheduledTweetId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Scheduled Tweets Scheduled Tweet ID',
                'description' => 'X Ads API operation: Creatives / Scheduled Tweets accounts/:account_id/scheduled_tweets/:scheduled_tweet_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'scheduled_tweet_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_scheduled_tweets_scheduled_tweet_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/scheduled_tweets/:scheduled_tweet_id',
                    'tags' => [
                        'Creatives',
                        'Scheduled Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_website' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsWebsite',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Website',
                'description' => 'X Ads API operation: Creatives / Website Cards accounts/:account_id/cards/website.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_website',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/website',
                    'tags' => [
                        'Creatives',
                        'Website Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_website_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsWebsiteCardId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Website Card ID',
                'description' => 'X Ads API operation: Creatives / Website Cards accounts/:account_id/cards/website/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_website_card_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/website/:card_id',
                    'tags' => [
                        'Creatives',
                        'Website Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_cards_website' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdCardsWebsite',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Cards Website',
                'description' => 'X Ads API operation: Creatives / Website Cards accounts/:account_id/cards/website.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'website_title' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'website_url' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_cards_website',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/cards/website',
                    'tags' => [
                        'Creatives',
                        'Website Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_cards_website_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdCardsWebsiteCardId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Cards Website Card ID',
                'description' => 'X Ads API operation: Creatives / Website Cards accounts/:account_id/cards/website/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'website_title' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'website_url' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_cards_website_card_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/cards/website/:card_id',
                    'tags' => [
                        'Creatives',
                        'Website Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_cards_website_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdCardsWebsiteCardId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Cards Website Card ID',
                'description' => 'X Ads API operation: Creatives / Website Cards accounts/:account_id/cards/website/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_cards_website_card_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/cards/website/:card_id',
                    'tags' => [
                        'Creatives',
                        'Website Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_video_website' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsVideoWebsite',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Video Website',
                'description' => 'X Ads API operation: Creatives / Video Website Cards accounts/:account_id/cards/video_website.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_video_website',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/video_website',
                    'tags' => [
                        'Creatives',
                        'Video Website Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_video_website_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsVideoWebsiteCardId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Video Website Card ID',
                'description' => 'X Ads API operation: Creatives / Video Website Cards accounts/:account_id/cards/video_website/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_video_website_card_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/video_website/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video Website Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_cards_video_website' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdCardsVideoWebsite',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Cards Video Website',
                'description' => 'X Ads API operation: Creatives / Video Website Cards accounts/:account_id/cards/video_website.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'title' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'website_url' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_cards_video_website',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/cards/video_website',
                    'tags' => [
                        'Creatives',
                        'Video Website Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_cards_video_website_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdCardsVideoWebsiteCardId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Cards Video Website Card ID',
                'description' => 'X Ads API operation: Creatives / Video Website Cards accounts/:account_id/cards/video_website/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'title' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'website_url' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_cards_video_website_card_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/cards/video_website/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video Website Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_cards_video_website_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdCardsVideoWebsiteCardId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Cards Video Website Card ID',
                'description' => 'X Ads API operation: Creatives / Video Website Cards accounts/:account_id/cards/video_website/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_cards_video_website_card_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/cards/video_website/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video Website Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_image_app_download' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsImageAppDownload',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Image App Download',
                'description' => 'X Ads API operation: Creatives / Image App Download Cards accounts/:account_id/cards/image_app_download.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_image_app_download',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/image_app_download',
                    'tags' => [
                        'Creatives',
                        'Image App Download Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_image_app_download_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsImageAppDownloadCardId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Image App Download Card ID',
                'description' => 'X Ads API operation: Creatives / Image App Download Cards accounts/:account_id/cards/image_app_download/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_image_app_download_card_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/image_app_download/:card_id',
                    'tags' => [
                        'Creatives',
                        'Image App Download Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_cards_image_app_download' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdCardsImageAppDownload',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Cards Image App Download',
                'description' => 'X Ads API operation: Creatives / Image App Download Cards accounts/:account_id/cards/image_app_download.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'country_code' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'ipad_app_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'iphone_app_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'googleplay_app_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'app_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'ipad_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'iphone_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'googleplay_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_cards_image_app_download',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/cards/image_app_download',
                    'tags' => [
                        'Creatives',
                        'Image App Download Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_cards_image_app_download_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdCardsImageAppDownloadCardId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Cards Image App Download Card ID',
                'description' => 'X Ads API operation: Creatives / Image App Download Cards accounts/:account_id/cards/image_app_download/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'country_code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'app_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'ipad_app_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'ipad_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'iphone_app_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'iphone_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'googleplay_app_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'googleplay_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_cards_image_app_download_card_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/cards/image_app_download/:card_id',
                    'tags' => [
                        'Creatives',
                        'Image App Download Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_cards_image_app_download_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdCardsImageAppDownloadCardId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Cards Image App Download Card ID',
                'description' => 'X Ads API operation: Creatives / Image App Download Cards accounts/:account_id/cards/image_app_download/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_cards_image_app_download_card_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/cards/image_app_download/:card_id',
                    'tags' => [
                        'Creatives',
                        'Image App Download Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_image_conversation' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsImageConversation',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Image Conversation',
                'description' => 'X Ads API operation: Creatives / Image Conversation Cards accounts/:account_id/cards/image_conversation.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_image_conversation',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/image_conversation',
                    'tags' => [
                        'Creatives',
                        'Image Conversation Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_image_conversation_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsImageConversationCardId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Image Conversation Card ID',
                'description' => 'X Ads API operation: Creatives / Image Conversation Cards accounts/:account_id/cards/image_conversation/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_image_conversation_card_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/image_conversation/:card_id',
                    'tags' => [
                        'Creatives',
                        'Image Conversation Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_cards_image_conversation' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdCardsImageConversation',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Cards Image Conversation',
                'description' => 'X Ads API operation: Creatives / Image Conversation Cards accounts/:account_id/cards/image_conversation.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'first_cta' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'first_cta_tweet' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'thank_you_text' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'second_cta' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'second_cta_tweet' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'title' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'unlocked_image_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta_tweet' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'fourth_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta_tweet' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'thank_you_url' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_cards_image_conversation',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/cards/image_conversation',
                    'tags' => [
                        'Creatives',
                        'Image Conversation Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_cards_image_conversation_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdCardsImageConversationCardId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Cards Image Conversation Card ID',
                'description' => 'X Ads API operation: Creatives / Image Conversation Cards accounts/:account_id/cards/image_conversation/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'unlocked_image_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'first_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'first_cta_tweet' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'second_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'second_cta_tweet' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta_tweet' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta_tweet' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'thank_you_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'thank_you_url' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'title' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_cards_image_conversation_card_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/cards/image_conversation/:card_id',
                    'tags' => [
                        'Creatives',
                        'Image Conversation Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_cards_image_conversation_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdCardsImageConversationCardId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Cards Image Conversation Card ID',
                'description' => 'X Ads API operation: Creatives / Image Conversation Cards accounts/:account_id/cards/image_conversation/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_cards_image_conversation_card_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/cards/image_conversation/:card_id',
                    'tags' => [
                        'Creatives',
                        'Image Conversation Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_image_direct_message' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsImageDirectMessage',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Image Direct Message',
                'description' => 'X Ads API operation: Creatives / Image Direct Message Cards accounts/:account_id/cards/image_direct_message.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_image_direct_message',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/image_direct_message',
                    'tags' => [
                        'Creatives',
                        'Image Direct Message Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_image_direct_message_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsImageDirectMessageCardId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Image Direct Message Card ID',
                'description' => 'X Ads API operation: Creatives / Image Direct Message Cards accounts/:account_id/cards/image_direct_message/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_image_direct_message_card_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/image_direct_message/:card_id',
                    'tags' => [
                        'Creatives',
                        'Image Direct Message Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_cards_image_direct_message' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdCardsImageDirectMessage',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Cards Image Direct Message',
                'description' => 'X Ads API operation: Creatives / Image Direct Message Cards accounts/:account_id/cards/image_direct_message.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'first_cta' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'first_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'recipient_user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'second_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'second_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_cards_image_direct_message',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/cards/image_direct_message',
                    'tags' => [
                        'Creatives',
                        'Image Direct Message Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_cards_image_direct_message' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdCardsImageDirectMessage',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Cards Image Direct Message',
                'description' => 'X Ads API operation: Creatives / Image Direct Message Cards accounts/:account_id/cards/image_direct_message.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'first_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'first_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'second_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'second_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_cards_image_direct_message',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/cards/image_direct_message',
                    'tags' => [
                        'Creatives',
                        'Image Direct Message Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_cards_image_direct_message_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdCardsImageDirectMessageCardId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Cards Image Direct Message Card ID',
                'description' => 'X Ads API operation: Creatives / Image Direct Message Cards accounts/:account_id/cards/image_direct_message/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_cards_image_direct_message_card_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/cards/image_direct_message/:card_id',
                    'tags' => [
                        'Creatives',
                        'Image Direct Message Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_video_app_download' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsVideoAppDownload',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Video App Download',
                'description' => 'X Ads API operation: Creatives / Video App Download Cards accounts/:account_id/cards/video_app_download.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_video_app_download',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/video_app_download',
                    'tags' => [
                        'Creatives',
                        'Video App Download Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_video_app_download_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsVideoAppDownloadCardId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Video App Download Card ID',
                'description' => 'X Ads API operation: Creatives / Video App Download Cards accounts/:account_id/cards/video_app_download/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_video_app_download_card_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/video_app_download/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video App Download Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_cards_video_app_download' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdCardsVideoAppDownload',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Cards Video App Download',
                'description' => 'X Ads API operation: Creatives / Video App Download Cards accounts/:account_id/cards/video_app_download.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'country_code' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'ipad_app_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'iphone_app_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'googleplay_app_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'app_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'ipad_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'iphone_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'googleplay_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'poster_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_cards_video_app_download',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/cards/video_app_download',
                    'tags' => [
                        'Creatives',
                        'Video App Download Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_cards_video_app_download_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdCardsVideoAppDownloadCardId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Cards Video App Download Card ID',
                'description' => 'X Ads API operation: Creatives / Video App Download Cards accounts/:account_id/cards/video_app_download/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'country_code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'app_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'ipad_app_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'ipad_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'iphone_app_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'iphone_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'googleplay_app_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'googleplay_deep_link' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'poster_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_cards_video_app_download_card_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/cards/video_app_download/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video App Download Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_cards_video_app_download_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdCardsVideoAppDownloadCardId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Cards Video App Download Card ID',
                'description' => 'X Ads API operation: Creatives / Video App Download Cards accounts/:account_id/cards/video_app_download/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_cards_video_app_download_card_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/cards/video_app_download/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video App Download Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_video_conversation' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsVideoConversation',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Video Conversation',
                'description' => 'X Ads API operation: Creatives / Video Conversation Cards accounts/:account_id/cards/video_conversation.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_video_conversation',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/video_conversation',
                    'tags' => [
                        'Creatives',
                        'Video Conversation Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_video_conversation_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsVideoConversationCardId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Video Conversation Card ID',
                'description' => 'X Ads API operation: Creatives / Video Conversation Cards accounts/:account_id/cards/video_conversation/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_video_conversation_card_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/video_conversation/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video Conversation Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_cards_video_conversation' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdCardsVideoConversation',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Cards Video Conversation',
                'description' => 'X Ads API operation: Creatives / Video Conversation Cards accounts/:account_id/cards/video_conversation.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'first_cta' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'first_cta_tweet' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'thank_you_text' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'title' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'second_cta' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'second_cta_tweet' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'unlocked_image_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'unlocked_video_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'poster_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta_tweet' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'fourth_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta_tweet' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'thank_you_url' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_cards_video_conversation',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/cards/video_conversation',
                    'tags' => [
                        'Creatives',
                        'Video Conversation Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_cards_video_conversation_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdCardsVideoConversationCardId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Cards Video Conversation Card ID',
                'description' => 'X Ads API operation: Creatives / Video Conversation Cards accounts/:account_id/cards/video_conversation/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'unlocked_image_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'unlocked_video_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'poster_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'first_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'first_cta_tweet' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'second_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'second_cta_tweet' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta_tweet' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta_tweet' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'thank_you_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'thank_you_url' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'title' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_cards_video_conversation_card_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/cards/video_conversation/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video Conversation Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_cards_video_conversation_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdCardsVideoConversationCardId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Cards Video Conversation Card ID',
                'description' => 'X Ads API operation: Creatives / Video Conversation Cards accounts/:account_id/cards/video_conversation/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_cards_video_conversation_card_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/cards/video_conversation/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video Conversation Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_video_direct_message' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsVideoDirectMessage',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Video Direct Message',
                'description' => 'X Ads API operation: Creatives / Video Direct Message Cards accounts/:account_id/cards/video_direct_message.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_video_direct_message',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/video_direct_message',
                    'tags' => [
                        'Creatives',
                        'Video Direct Message Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_video_direct_message_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsVideoDirectMessageCardId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Video Direct Message Card ID',
                'description' => 'X Ads API operation: Creatives / Video Direct Message Cards accounts/:account_id/cards/video_direct_message/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_video_direct_message_card_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/video_direct_message/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video Direct Message Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_cards_video_direct_message' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdCardsVideoDirectMessage',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Cards Video Direct Message',
                'description' => 'X Ads API operation: Creatives / Video Direct Message Cards accounts/:account_id/cards/video_direct_message.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'first_cta' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'first_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'recipient_user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'poster_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'second_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'second_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_cards_video_direct_message',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/cards/video_direct_message',
                    'tags' => [
                        'Creatives',
                        'Video Direct Message Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_cards_video_direct_message_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdCardsVideoDirectMessageCardId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Cards Video Direct Message Card ID',
                'description' => 'X Ads API operation: Creatives / Video Direct Message Cards accounts/:account_id/cards/video_direct_message/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'poster_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'first_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'first_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'second_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'second_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'fourth_cta_welcome_message_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_cards_video_direct_message_card_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/cards/video_direct_message/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video Direct Message Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_cards_video_direct_message_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdCardsVideoDirectMessageCardId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Cards Video Direct Message Card ID',
                'description' => 'X Ads API operation: Creatives / Video Direct Message Cards accounts/:account_id/cards/video_direct_message/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_cards_video_direct_message_card_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/cards/video_direct_message/:card_id',
                    'tags' => [
                        'Creatives',
                        'Video Direct Message Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_media_library' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdMediaLibrary',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Media Library',
                'description' => 'X Ads API operation: Creatives / Media Library accounts/:account_id/media_library.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_media_library',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/media_library',
                    'tags' => [
                        'Creatives',
                        'Media Library',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_media_library_media_key' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdMediaLibraryMediaKey',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Media Library Media Key',
                'description' => 'X Ads API operation: Creatives / Media Library accounts/:account_id/media_library/:media_key.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_media_library_media_key',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/media_library/:media_key',
                    'tags' => [
                        'Creatives',
                        'Media Library',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_media_library' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdMediaLibrary',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Media Library',
                'description' => 'X Ads API operation: Creatives / Media Library accounts/:account_id/media_library.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'sometimes required',
                    ],
                    'description' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'file_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'poster_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'title' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_media_library',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/media_library',
                    'tags' => [
                        'Creatives',
                        'Media Library',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_media_library_media_key' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdMediaLibraryMediaKey',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Media Library Media Key',
                'description' => 'X Ads API operation: Creatives / Media Library accounts/:account_id/media_library/:media_key.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'description' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'file_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'poster_media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'title' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_media_library_media_key',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/media_library/:media_key',
                    'tags' => [
                        'Creatives',
                        'Media Library',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_media_library_media_key' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdMediaLibraryMediaKey',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Media Library Media Key',
                'description' => 'X Ads API operation: Creatives / Media Library accounts/:account_id/media_library/:media_key.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_media_library_media_key',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/media_library/:media_key',
                    'tags' => [
                        'Creatives',
                        'Media Library',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_poll' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsPoll',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Poll',
                'description' => 'X Ads API operation: Creatives / Poll Cards accounts/:account_id/cards/poll.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'card_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_poll',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/poll',
                    'tags' => [
                        'Creatives',
                        'Poll Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_cards_poll_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdCardsPollCardId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Cards Poll Card ID',
                'description' => 'X Ads API operation: Creatives / Poll Cards accounts/:account_id/cards/poll/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_cards_poll_card_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/cards/poll/:card_id',
                    'tags' => [
                        'Creatives',
                        'Poll Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_cards_poll' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdCardsPoll',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Cards Poll',
                'description' => 'X Ads API operation: Creatives / Poll Cards accounts/:account_id/cards/poll.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'duration_in_minutes' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'first_choice' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'second_choice' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'fourth_choice' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'media_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'third_choice' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_cards_poll',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/cards/poll',
                    'tags' => [
                        'Creatives',
                        'Poll Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_cards_poll_card_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdCardsPollCardId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Cards Poll Card ID',
                'description' => 'X Ads API operation: Creatives / Poll Cards accounts/:account_id/cards/poll/:card_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_cards_poll_card_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/cards/poll/:card_id',
                    'tags' => [
                        'Creatives',
                        'Poll Cards',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_preroll_call_to_actions' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdPrerollCallToActions',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Preroll Call To Actions',
                'description' => 'X Ads API operation: Creatives / Preroll Call To Actions accounts/:account_id/preroll_call_to_actions.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'line_item_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'preroll_call_to_action_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_preroll_call_to_actions',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/preroll_call_to_actions',
                    'tags' => [
                        'Creatives',
                        'Preroll Call To Actions',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_preroll_call_to_actions_preroll_call_to_action_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdPrerollCallToActionsPrerollCallToActionId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Preroll Call To Actions Preroll Call To Action ID',
                'description' => 'X Ads API operation: Creatives / Preroll Call To Actions accounts/:account_id/preroll_call_to_actions/:preroll_call_to_action_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_preroll_call_to_actions_preroll_call_to_action_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/preroll_call_to_actions/:preroll_call_to_action_id',
                    'tags' => [
                        'Creatives',
                        'Preroll Call To Actions',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_preroll_call_to_actions' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdPrerollCallToActions',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Preroll Call To Actions',
                'description' => 'X Ads API operation: Creatives / Preroll Call To Actions accounts/:account_id/preroll_call_to_actions.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'call_to_action' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'call_to_action_url' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'line_item_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_preroll_call_to_actions',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/preroll_call_to_actions',
                    'tags' => [
                        'Creatives',
                        'Preroll Call To Actions',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_preroll_call_to_actions_preroll_call_to_action_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdPrerollCallToActionsPrerollCallToActionId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Preroll Call To Actions Preroll Call To Action ID',
                'description' => 'X Ads API operation: Creatives / Preroll Call To Actions accounts/:account_id/preroll_call_to_actions/:preroll_call_to_action_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'call_to_action' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'call_to_action_url' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_preroll_call_to_actions_preroll_call_to_action_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/preroll_call_to_actions/:preroll_call_to_action_id',
                    'tags' => [
                        'Creatives',
                        'Preroll Call To Actions',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_preroll_call_to_actions_preroll_call_to_action_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdPrerollCallToActionsPrerollCallToActionId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Preroll Call To Actions Preroll Call To Action ID',
                'description' => 'X Ads API operation: Creatives / Preroll Call To Actions accounts/:account_id/preroll_call_to_actions/:preroll_call_to_action_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_preroll_call_to_actions_preroll_call_to_action_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/preroll_call_to_actions/:preroll_call_to_action_id',
                    'tags' => [
                        'Creatives',
                        'Preroll Call To Actions',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_tweet_previews' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdTweetPreviews',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Tweet Previews',
                'description' => 'X Ads API operation: Creatives / Tweet Previews accounts/:account_id/tweet_previews.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'tweet_ids' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'tweet_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_tweet_previews',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/tweet_previews',
                    'tags' => [
                        'Creatives',
                        'Tweet Previews',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_app_event_tags' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdAppEventTags',
                'type' => 'read',
                'name' => 'Get Accounts Account ID App Event Tags',
                'description' => 'X Ads API operation: Measurement / App Event Tags accounts/:account_id/app_event_tags.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'app_event_tag_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_app_event_tags',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/app_event_tags',
                    'tags' => [
                        'Measurement',
                        'App Event Tags',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_app_event_tags_app_event_tag_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdAppEventTagsAppEventTagId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID App Event Tags App Event Tag ID',
                'description' => 'X Ads API operation: Measurement / App Event Tags accounts/:account_id/app_event_tags/:app_event_tag_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_app_event_tags_app_event_tag_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/app_event_tags/:app_event_tag_id',
                    'tags' => [
                        'Measurement',
                        'App Event Tags',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_app_event_tags' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdAppEventTags',
                'type' => 'write',
                'name' => 'Post Accounts Account ID App Event Tags',
                'description' => 'X Ads API operation: Measurement / App Event Tags accounts/:account_id/app_event_tags.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'app_store_identifier' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'conversion_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'os_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'provider_app_event_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'provider_app_event_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'deep_link_scheme' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'post_engagement_attribution_window' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'post_view_attribution_window' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'retargeting_enabled' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_app_event_tags',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/app_event_tags',
                    'tags' => [
                        'Measurement',
                        'App Event Tags',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_app_event_tags_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdAppEventTagsId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID App Event Tags ID',
                'description' => 'X Ads API operation: Measurement / App Event Tags accounts/:account_id/app_event_tags/:id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_app_event_tags_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/app_event_tags/:id',
                    'tags' => [
                        'Measurement',
                        'App Event Tags',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_app_event_provider_configurations' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdAppEventProviderConfigurations',
                'type' => 'read',
                'name' => 'Get Accounts Account ID App Event Provider Configurations',
                'description' => 'X Ads API operation: Measurement / App Event Provider Configurations accounts/:account_id/app_event_provider_configurations.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_app_event_provider_configurations',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/app_event_provider_configurations',
                    'tags' => [
                        'Measurement',
                        'App Event Provider Configurations',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_app_event_provider_configurations_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdAppEventProviderConfigurationsId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID App Event Provider Configurations ID',
                'description' => 'X Ads API operation: Measurement / App Event Provider Configurations accounts/:account_id/app_event_provider_configurations/:id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_app_event_provider_configurations_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/app_event_provider_configurations/:id',
                    'tags' => [
                        'Measurement',
                        'App Event Provider Configurations',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_app_event_provider_configurations' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdAppEventProviderConfigurations',
                'type' => 'write',
                'name' => 'Post Accounts Account ID App Event Provider Configurations',
                'description' => 'X Ads API operation: Measurement / App Event Provider Configurations accounts/:account_id/app_event_provider_configurations.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'provider_advertiser_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_app_event_provider_configurations',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/app_event_provider_configurations',
                    'tags' => [
                        'Measurement',
                        'App Event Provider Configurations',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_app_event_provider_configurations_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdAppEventProviderConfigurationsId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID App Event Provider Configurations ID',
                'description' => 'X Ads API operation: Measurement / App Event Provider Configurations accounts/:account_id/app_event_provider_configurations/:id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_app_event_provider_configurations_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/app_event_provider_configurations/:id',
                    'tags' => [
                        'Measurement',
                        'App Event Provider Configurations',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_app_lists' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdAppLists',
                'type' => 'read',
                'name' => 'Get Accounts Account ID App Lists',
                'description' => 'X Ads API operation: Measurement / App Lists accounts/:account_id/app_lists.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'app_list_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_app_lists',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/app_lists',
                    'tags' => [
                        'Measurement',
                        'App Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_app_lists_app_list_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdAppListsAppListId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID App Lists App List ID',
                'description' => 'X Ads API operation: Measurement / App Lists accounts/:account_id/app_lists/:app_list_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'app_list_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_app_lists_app_list_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/app_lists/:app_list_id',
                    'tags' => [
                        'Measurement',
                        'App Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_app_lists' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdAppLists',
                'type' => 'write',
                'name' => 'Post Accounts Account ID App Lists',
                'description' => 'X Ads API operation: Measurement / App Lists accounts/:account_id/app_lists.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'app_store_identifiers' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_app_lists',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/app_lists',
                    'tags' => [
                        'Measurement',
                        'App Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_app_lists_app_list_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdAppListsAppListId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID App Lists App List ID',
                'description' => 'X Ads API operation: Measurement / App Lists accounts/:account_id/app_lists/:app_list_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'app_list_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_app_lists_app_list_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/app_lists/:app_list_id',
                    'tags' => [
                        'Measurement',
                        'App Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_conversion_attribution' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetConversionAttribution',
                'type' => 'read',
                'name' => 'Get Conversion Attribution',
                'description' => 'X Ads API operation: Measurement / Conversion Attribution conversion_attribution.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'app_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'conversion_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'conversion_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'hashed_device_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'os_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'click_window' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'extra_device_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'non_twitter_engagement_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'non_twitter_engagement_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'view_through_window' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_conversion_attribution',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/conversion_attribution',
                    'tags' => [
                        'Measurement',
                        'Conversion Attribution',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_conversion_event' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostConversionEvent',
                'type' => 'write',
                'name' => 'Post Conversion Event',
                'description' => 'X Ads API operation: Measurement / Conversion Event conversion_event.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'app_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'conversion_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'conversion_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'hashed_device_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'os_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'click_window' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'extra_device_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'non_twitter_engagement_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'non_twitter_engagement_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'view_through_window' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'post_conversion_event',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/conversion_event',
                    'tags' => [
                        'Measurement',
                        'Conversion Event',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_web_event_tags' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdWebEventTags',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Web Event Tags',
                'description' => 'X Ads API operation: Measurement / Web Event Tags accounts/:account_id/web_event_tags.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'web_event_tag_ids' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'with_total_count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_web_event_tags',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/web_event_tags',
                    'tags' => [
                        'Measurement',
                        'Web Event Tags',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_get_accounts_account_id_web_event_tags_web_event_tag_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsGetAccountsAccountIdWebEventTagsWebEventTagId',
                'type' => 'read',
                'name' => 'Get Accounts Account ID Web Event Tags Web Event Tag ID',
                'description' => 'X Ads API operation: Measurement / Web Event Tags accounts/:account_id/web_event_tags/:web_event_tag_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'with_deleted' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'get_accounts_account_id_web_event_tags_web_event_tag_id',
                'operation' => [
                    'method' => 'GET',
                    'path' => '/{version}/accounts/{account_id}/web_event_tags/:web_event_tag_id',
                    'tags' => [
                        'Measurement',
                        'Web Event Tags',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_post_accounts_account_id_web_event_tags' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPostAccountsAccountIdWebEventTags',
                'type' => 'write',
                'name' => 'Post Accounts Account ID Web Event Tags',
                'description' => 'X Ads API operation: Measurement / Web Event Tags accounts/:account_id/web_event_tags.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'click_window' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'retargeting_enabled' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                    'view_through_window' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'required',
                    ],
                ],
                'operation_id' => 'post_accounts_account_id_web_event_tags',
                'operation' => [
                    'method' => 'POST',
                    'path' => '/{version}/accounts/{account_id}/web_event_tags',
                    'tags' => [
                        'Measurement',
                        'Web Event Tags',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_put_accounts_account_id_web_event_tags_web_event_tag_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsPutAccountsAccountIdWebEventTagsWebEventTagId',
                'type' => 'write',
                'name' => 'Put Accounts Account ID Web Event Tags Web Event Tag ID',
                'description' => 'X Ads API operation: Measurement / Web Event Tags accounts/:account_id/web_event_tags/:web_event_tag_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                    'click_window' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'retargeting_enabled' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                    'view_through_window' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'optional',
                    ],
                ],
                'operation_id' => 'put_accounts_account_id_web_event_tags_web_event_tag_id',
                'operation' => [
                    'method' => 'PUT',
                    'path' => '/{version}/accounts/{account_id}/web_event_tags/:web_event_tag_id',
                    'tags' => [
                        'Measurement',
                        'Web Event Tags',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
            'x_ads_delete_accounts_account_id_web_event_tags_web_event_tag_id' => [
                'class' => 'OpenCompany\\Integrations\\XAds\\Tools\\XAdsDeleteAccountsAccountIdWebEventTagsWebEventTagId',
                'type' => 'write',
                'name' => 'Delete Accounts Account ID Web Event Tags Web Event Tag ID',
                'description' => 'X Ads API operation: Measurement / Web Event Tags accounts/:account_id/web_event_tags/:web_event_tag_id.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account ID path parameter.',
                    ],
                ],
                'operation_id' => 'delete_accounts_account_id_web_event_tags_web_event_tag_id',
                'operation' => [
                    'method' => 'DELETE',
                    'path' => '/{version}/accounts/{account_id}/web_event_tags/:web_event_tag_id',
                    'tags' => [
                        'Measurement',
                        'Web Event Tags',
                    ],
                ],
                'auth_modes' => [
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'ads_api_access',
                ],
                'required_access_tier' => 'approved_ads_api_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-ads-api',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/x-ads.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'api_secret', 'type' => 'secret', 'label' => 'API Secret', 'required' => true],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'access_token_secret', 'type' => 'secret', 'label' => 'Access Token Secret', 'required' => true],
            ['key' => 'account_id', 'type' => 'string', 'label' => 'Default Ads Account ID', 'required' => false],
            ['key' => 'api_version', 'type' => 'string', 'label' => 'Ads API Version', 'required' => false, 'default' => '11'],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://ads-api.x.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a generated X Ads tool with optional multi-account credentials.
     *
     * @param  class-string<Tool>  $class  Tool class name
     * @param  array<string, mixed>  $context  Runtime context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the service for the default or named account.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): XAdsService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new XAdsService(
                apiKey: $creds->get('x_ads', 'api_key', '', $account),
                apiSecret: $creds->get('x_ads', 'api_secret', '', $account),
                accessToken: $creds->get('x_ads', 'access_token', '', $account),
                accessTokenSecret: $creds->get('x_ads', 'access_token_secret', '', $account),
                accountId: $creds->get('x_ads', 'account_id', '', $account),
                apiVersion: $creds->get('x_ads', 'api_version', '11', $account),
                baseUrl: $creds->get('x_ads', 'base_url', 'https://ads-api.x.com', $account),
            );
        }

        return app(XAdsService::class);
    }
}