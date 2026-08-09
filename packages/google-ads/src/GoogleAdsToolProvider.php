<?php

namespace OpenCompany\Integrations\GoogleAds;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsAccountBudgetProposal;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsAdGroupReport;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsAdReport;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsApplyRecommendations;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsAssetReport;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsCampaignReport;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsCreateBatchJob;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsCreateCampaignBudget;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsCreateCustomerMatchList;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsCreatePerformanceMaxCampaign;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsCreateSearchCampaign;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsDiagnostics;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsGenerateKeywordIdeas;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsGetChangeEvents;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsGetChangeStatus;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsInviteUser;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsKeywordReport;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsLinkAsset;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsListAccessibleCustomers;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsListBillingSetups;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsListCampaigns;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsListCustomerClients;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsListRecommendations;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsManageAd;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsManageAdGroup;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsManageCampaign;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsManageCampaignCriteria;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsManageKeyword;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsMutate;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsPerformanceMaxReport;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsRawRequest;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsRunCustomerMatchJob;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsSearch;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsSearchStream;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsSearchTermReport;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsUploadCallConversions;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsUploadClickConversions;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsUploadImageAsset;

/**
 * Tool catalog and credential metadata for Google Ads.
 *
 * Supports web OAuth, CLI/manual refresh-token setup, and multi-account runtime resolution.
 */
class GoogleAdsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe web and CLI setup support for host applications.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'oauth2_with_developer_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'oauth_and_secret',
                'setup_flows' => ['oauth_redirect', 'manual_refresh_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => true,
                'oauth_scopes' => ['https://www.googleapis.com/auth/adwords'],
                'notes' => [
                    'CLI hosts such as KosmoKrator can use manually generated refresh tokens.',
                    'Hosted web apps should use an OAuth redirect endpoint for multi-user setup.',
                    'Production creation/management requires a developer token with permitted Google Ads API use.',
                ],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'oauth_redirect',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_refresh_token',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [
                'Google Ads API developer token',
                'OAuth access or refresh token with the adwords scope',
                'Client customer ID for most account-specific tools',
            ],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'google-ads';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Google Ads',
            'description' => 'Campaign management, reporting, audiences, conversions, assets, billing, and batch jobs',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:googleads',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Ads',
            'description' => 'Enterprise Google Ads API integration with CLI/manual token support, GAQL reporting, governed writes, full campaign builders, and conversion/audience tooling.',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:googleads',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://developers.google.com/google-ads/api/docs/start',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'developer_token', 'type' => 'secret', 'label' => 'Developer Token', 'required' => true],
            ['key' => 'client_id', 'type' => 'string', 'label' => 'OAuth Client ID', 'required' => false],
            ['key' => 'client_secret', 'type' => 'secret', 'label' => 'OAuth Client Secret', 'required' => false],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => false],
            ['key' => 'refresh_token', 'type' => 'secret', 'label' => 'Refresh Token', 'required' => false],
            ['key' => 'expires_at', 'type' => 'string', 'label' => 'Access Token Expiry Timestamp', 'required' => false],
            ['key' => 'manager_customer_id', 'type' => 'string', 'label' => 'Manager Customer ID', 'required' => false],
            ['key' => 'default_customer_id', 'type' => 'string', 'label' => 'Default Client Customer ID', 'required' => false],
            ['key' => 'linked_customer_id', 'type' => 'string', 'label' => 'Linked Customer ID', 'required' => false],
            ['key' => 'api_version', 'type' => 'string', 'label' => 'API Version', 'default' => 'v24', 'required' => false],
        ];
    }

    /**
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        if (empty($config['developer_token'])) {
            return ['success' => false, 'error' => 'Google Ads developer_token is required.'];
        }
        if (empty($config['access_token']) && (empty($config['refresh_token']) || empty($config['client_id']) || empty($config['client_secret']))) {
            return ['success' => false, 'error' => 'Google Ads requires access_token, or client_id/client_secret/refresh_token for automatic CLI refresh.'];
        }

        $service = $this->serviceFromConfig($config);

        try {
            $response = $service->listAccessibleCustomers();

            return [
                'success' => true,
                'message' => 'Connected to Google Ads. Accessible customers: ' . count($response['resourceNames'] ?? []),
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'developer_token' => 'required|string',
            'access_token' => 'nullable|string',
            'refresh_token' => 'nullable|string',
            'client_id' => 'nullable|string',
            'client_secret' => 'nullable|string',
            'manager_customer_id' => 'nullable|string',
            'default_customer_id' => 'nullable|string',
            'api_version' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'google_ads_diagnostics' => ['class' => GoogleAdsDiagnostics::class, 'type' => 'read', 'name' => 'Diagnostics', 'description' => 'Show safe configuration diagnostics.', 'icon' => 'ph:stethoscope'],
            'google_ads_list_accessible_customers' => ['class' => GoogleAdsListAccessibleCustomers::class, 'type' => 'read', 'name' => 'List Accessible Customers', 'description' => 'List Google Ads customers directly accessible to the OAuth user.', 'icon' => 'ph:users'],
            'google_ads_list_customer_clients' => ['class' => GoogleAdsListCustomerClients::class, 'type' => 'read', 'name' => 'List Customer Clients', 'description' => 'List managed client accounts under a manager or customer.', 'icon' => 'ph:tree-structure'],
            'google_ads_search' => ['class' => GoogleAdsSearch::class, 'type' => 'read', 'name' => 'GAQL Search', 'description' => 'Run a paginated Google Ads Query Language search.', 'icon' => 'ph:magnifying-glass'],
            'google_ads_search_stream' => ['class' => GoogleAdsSearchStream::class, 'type' => 'read', 'name' => 'GAQL Search Stream', 'description' => 'Run a streaming GAQL report for larger result sets.', 'icon' => 'ph:stream'],
            'google_ads_campaign_report' => ['class' => GoogleAdsCampaignReport::class, 'type' => 'read', 'name' => 'Campaign Report', 'description' => 'Run a normalized campaign performance report.', 'icon' => 'ph:chart-line'],
            'google_ads_ad_group_report' => ['class' => GoogleAdsAdGroupReport::class, 'type' => 'read', 'name' => 'Ad Group Report', 'description' => 'Run a normalized ad group performance report.', 'icon' => 'ph:chart-bar'],
            'google_ads_ad_report' => ['class' => GoogleAdsAdReport::class, 'type' => 'read', 'name' => 'Ad Report', 'description' => 'Run an ad and creative performance report.', 'icon' => 'ph:browser'],
            'google_ads_keyword_report' => ['class' => GoogleAdsKeywordReport::class, 'type' => 'read', 'name' => 'Keyword Report', 'description' => 'Run a keyword performance report.', 'icon' => 'ph:key'],
            'google_ads_search_term_report' => ['class' => GoogleAdsSearchTermReport::class, 'type' => 'read', 'name' => 'Search Term Report', 'description' => 'Analyze search terms and query performance.', 'icon' => 'ph:text-aa'],
            'google_ads_asset_report' => ['class' => GoogleAdsAssetReport::class, 'type' => 'read', 'name' => 'Asset Report', 'description' => 'Report on assets and policy/performance labels.', 'icon' => 'ph:image'],
            'google_ads_performance_max_report' => ['class' => GoogleAdsPerformanceMaxReport::class, 'type' => 'read', 'name' => 'Performance Max Report', 'description' => 'Report on Performance Max campaigns and asset groups.', 'icon' => 'ph:sparkle'],
            'google_ads_list_campaigns' => ['class' => GoogleAdsListCampaigns::class, 'type' => 'read', 'name' => 'List Campaigns', 'description' => 'List campaigns with status, budget, channel, and optimization fields.', 'icon' => 'ph:list'],
            'google_ads_create_campaign_budget' => ['class' => GoogleAdsCreateCampaignBudget::class, 'type' => 'write', 'name' => 'Create Campaign Budget', 'description' => 'Create a campaign budget with micros normalization.', 'icon' => 'ph:currency-dollar'],
            'google_ads_manage_campaign' => ['class' => GoogleAdsManageCampaign::class, 'type' => 'write', 'name' => 'Manage Campaign', 'description' => 'Create, update, pause, enable, or remove campaigns.', 'icon' => 'ph:megaphone'],
            'google_ads_manage_ad_group' => ['class' => GoogleAdsManageAdGroup::class, 'type' => 'write', 'name' => 'Manage Ad Group', 'description' => 'Create, update, pause, enable, or remove ad groups.', 'icon' => 'ph:squares-four'],
            'google_ads_manage_keyword' => ['class' => GoogleAdsManageKeyword::class, 'type' => 'write', 'name' => 'Manage Keyword', 'description' => 'Add, update, or remove keyword criteria.', 'icon' => 'ph:key'],
            'google_ads_manage_ad' => ['class' => GoogleAdsManageAd::class, 'type' => 'write', 'name' => 'Manage Ad', 'description' => 'Create or manage responsive search ads and ad statuses.', 'icon' => 'ph:browser'],
            'google_ads_manage_campaign_criteria' => ['class' => GoogleAdsManageCampaignCriteria::class, 'type' => 'write', 'name' => 'Manage Campaign Criteria', 'description' => 'Add or remove location, language, schedule, and negative criteria.', 'icon' => 'ph:target'],
            'google_ads_upload_image_asset' => ['class' => GoogleAdsUploadImageAsset::class, 'type' => 'write', 'name' => 'Upload Image Asset', 'description' => 'Create image assets from pre-encoded image metadata.', 'icon' => 'ph:image-square'],
            'google_ads_link_asset' => ['class' => GoogleAdsLinkAsset::class, 'type' => 'write', 'name' => 'Link Asset', 'description' => 'Link an asset to a customer, campaign, ad group, or asset group.', 'icon' => 'ph:link'],
            'google_ads_create_search_campaign' => ['class' => GoogleAdsCreateSearchCampaign::class, 'type' => 'write', 'name' => 'Create Search Campaign', 'description' => 'Create a complete paused Search campaign with budget, ad group, keywords, targets, and RSA.', 'icon' => 'ph:magnifying-glass'],
            'google_ads_create_performance_max_campaign' => ['class' => GoogleAdsCreatePerformanceMaxCampaign::class, 'type' => 'write', 'name' => 'Create Performance Max Campaign', 'description' => 'Create a governed Performance Max campaign using mixed mutate operations.', 'icon' => 'ph:sparkle'],
            'google_ads_generate_keyword_ideas' => ['class' => GoogleAdsGenerateKeywordIdeas::class, 'type' => 'read', 'name' => 'Generate Keyword Ideas', 'description' => 'Generate keyword ideas and forecasts inputs.', 'icon' => 'ph:lightbulb'],
            'google_ads_list_recommendations' => ['class' => GoogleAdsListRecommendations::class, 'type' => 'read', 'name' => 'List Recommendations', 'description' => 'List optimization recommendations.', 'icon' => 'ph:trend-up'],
            'google_ads_apply_recommendations' => ['class' => GoogleAdsApplyRecommendations::class, 'type' => 'write', 'name' => 'Apply Recommendations', 'description' => 'Apply selected recommendations with explicit confirmation.', 'icon' => 'ph:check-circle'],
            'google_ads_upload_click_conversions' => ['class' => GoogleAdsUploadClickConversions::class, 'type' => 'write', 'name' => 'Upload Click Conversions', 'description' => 'Upload offline or enhanced lead click conversions.', 'icon' => 'ph:upload'],
            'google_ads_upload_call_conversions' => ['class' => GoogleAdsUploadCallConversions::class, 'type' => 'write', 'name' => 'Upload Call Conversions', 'description' => 'Upload offline call conversions.', 'icon' => 'ph:phone-call'],
            'google_ads_create_customer_match_list' => ['class' => GoogleAdsCreateCustomerMatchList::class, 'type' => 'write', 'name' => 'Create Customer Match List', 'description' => 'Create a CRM-based user list for Customer Match.', 'icon' => 'ph:users-three'],
            'google_ads_run_customer_match_job' => ['class' => GoogleAdsRunCustomerMatchJob::class, 'type' => 'write', 'name' => 'Run Customer Match Job', 'description' => 'Create, populate, and run an OfflineUserDataJob for audience uploads.', 'icon' => 'ph:queue'],
            'google_ads_get_change_status' => ['class' => GoogleAdsGetChangeStatus::class, 'type' => 'read', 'name' => 'Get Change Status', 'description' => 'List changed resources for sync workflows.', 'icon' => 'ph:clock-counter-clockwise'],
            'google_ads_get_change_events' => ['class' => GoogleAdsGetChangeEvents::class, 'type' => 'read', 'name' => 'Get Change Events', 'description' => 'List field-level recent account changes.', 'icon' => 'ph:activity'],
            'google_ads_create_batch_job' => ['class' => GoogleAdsCreateBatchJob::class, 'type' => 'write', 'name' => 'Create Batch Job', 'description' => 'Create a batch job for large async operations.', 'icon' => 'ph:stack'],
            'google_ads_mutate' => ['class' => GoogleAdsMutate::class, 'type' => 'write', 'name' => 'Mutate Resource', 'description' => 'Governed resource-specific or mixed mutate escape hatch.', 'icon' => 'ph:code'],
            'google_ads_raw_request' => ['class' => GoogleAdsRawRequest::class, 'type' => 'write', 'name' => 'Raw API Request', 'description' => 'Low-level versioned Google Ads API request for advanced coverage.', 'icon' => 'ph:terminal-window'],
            'google_ads_list_billing_setups' => ['class' => GoogleAdsListBillingSetups::class, 'type' => 'read', 'name' => 'List Billing Setups', 'description' => 'List billing setup resources.', 'icon' => 'ph:receipt'],
            'google_ads_account_budget_proposal' => ['class' => GoogleAdsAccountBudgetProposal::class, 'type' => 'write', 'name' => 'Account Budget Proposal', 'description' => 'Create account budget proposal operations for monthly invoicing accounts.', 'icon' => 'ph:bank'],
            'google_ads_invite_user' => ['class' => GoogleAdsInviteUser::class, 'type' => 'write', 'name' => 'Invite User', 'description' => 'Invite a user to a Google Ads account.', 'icon' => 'ph:user-plus'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/google-ads.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'developer_token', 'type' => 'secret', 'label' => 'Developer Token', 'required' => true],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => false],
            ['key' => 'refresh_token', 'type' => 'secret', 'label' => 'Refresh Token', 'required' => false],
            ['key' => 'client_id', 'type' => 'string', 'label' => 'OAuth Client ID', 'required' => false],
            ['key' => 'client_secret', 'type' => 'secret', 'label' => 'OAuth Client Secret', 'required' => false],
            ['key' => 'manager_customer_id', 'type' => 'string', 'label' => 'Manager Customer ID', 'required' => false],
            ['key' => 'default_customer_id', 'type' => 'string', 'label' => 'Default Customer ID', 'required' => false],
            ['key' => 'api_version', 'type' => 'string', 'label' => 'API Version', 'required' => false, 'default' => 'v24'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve account-specific credentials for multi-account hosts.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): GoogleAdsService
    {
        $account = $context['account'] ?? null;
        if ($account === null) {
            return app(GoogleAdsService::class);
        }

        $creds = app(CredentialResolver::class);
        $get = static function (string $key, mixed $default = '') use ($creds, $account): mixed {
            $value = $creds->get('google-ads', $key, null, $account);

            return $value !== null && $value !== ''
                ? $value
                : $creds->get('google_ads', $key, $default, $account);
        };

        $expiresAt = $get('expires_at', null);

        return new GoogleAdsService(
            clientId: $get('client_id'),
            clientSecret: $get('client_secret'),
            accessToken: $get('access_token'),
            refreshToken: $get('refresh_token'),
            expiresAt: is_numeric($expiresAt) ? (int) $expiresAt : null,
            developerToken: $get('developer_token'),
            managerCustomerId: $get('manager_customer_id'),
            defaultCustomerId: $get('default_customer_id'),
            linkedCustomerId: $get('linked_customer_id'),
            apiVersion: $get('api_version', 'v24'),
        );
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private function serviceFromConfig(array $config): GoogleAdsService
    {
        return new GoogleAdsService(
            clientId: (string) ($config['client_id'] ?? ''),
            clientSecret: (string) ($config['client_secret'] ?? ''),
            accessToken: (string) ($config['access_token'] ?? ''),
            refreshToken: (string) ($config['refresh_token'] ?? ''),
            expiresAt: isset($config['expires_at']) ? (int) $config['expires_at'] : null,
            developerToken: (string) ($config['developer_token'] ?? ''),
            managerCustomerId: (string) ($config['manager_customer_id'] ?? ''),
            defaultCustomerId: (string) ($config['default_customer_id'] ?? ''),
            linkedCustomerId: (string) ($config['linked_customer_id'] ?? ''),
            apiVersion: (string) ($config['api_version'] ?? 'v24'),
        );
    }
}
