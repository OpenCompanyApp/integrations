<?php

namespace OpenCompany\Integrations\GoogleCloudSearch;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Cloud Search.
 *
 * Exposes generated coverage for the official Cloud Search v1 Discovery
 * document, including query, indexing, data sources, search applications,
 * debug, settings, stats, media upload, customer initialization, and operations.
 */
class GoogleCloudSearchToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Google Cloud Search scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-cloud-search'; }
    public function appMeta(): array { return ['label' => 'Google Cloud Search', 'description' => 'Search, suggest, indexing, data sources, settings, stats, debug, media, and operations', 'icon' => 'ph:magnifying-glass', 'logo' => 'logos:google-icon']; }
    public function integrationMeta(): array { return ['name' => 'Google Cloud Search', 'description' => 'Generated coverage for the Google Cloud Search v1 REST API: query, suggest, indexing, data sources, search applications, debug, settings, stats, media upload, customer initialization, and operations.', 'icon' => 'ph:magnifying-glass', 'logo' => 'logos:google-icon', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/workspace/cloud-search/docs/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Cloud Search scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://cloudsearch.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://cloudsearch.googleapis.com']]; }

    /**
     * Verify Google Cloud Search credentials with a lightweight query sources call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://cloudsearch.googleapis.com'), '/');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer '.$accessToken, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl.'/v1/query/sources');
            if (!$response->successful()) return ['success' => false, 'error' => 'Google Cloud Search API returned HTTP '.$response->status().'.'];
            return ['success' => true, 'message' => "Connected to Google Cloud Search at {$baseUrl}."];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_cloud_search_operations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchOperationsGet',
  'type' => 'read',
  'name' => 'Operations Get',
  'description' => 'Operations Get (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_operations_lro_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchOperationsLroList',
  'type' => 'read',
  'name' => 'Operations Lro List',
  'description' => 'Operations Lro List (GET /v1/{+name}/lro).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_settings_get_customer' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsGetCustomer',
  'type' => 'read',
  'name' => 'Settings Get Customer',
  'description' => 'Settings Get Customer (GET /v1/settings/customer).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_settings_update_customer' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsUpdateCustomer',
  'type' => 'write',
  'name' => 'Settings Update Customer',
  'description' => 'Settings Update Customer (PATCH /v1/settings/customer).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_settings_searchapplications_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsSearchapplicationsUpdate',
  'type' => 'write',
  'name' => 'Settings Searchapplications Update',
  'description' => 'Settings Searchapplications Update (PUT /v1/settings/{+name}).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_settings_searchapplications_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsSearchapplicationsPatch',
  'type' => 'write',
  'name' => 'Settings Searchapplications Patch',
  'description' => 'Settings Searchapplications Patch (PATCH /v1/settings/{+name}).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_settings_searchapplications_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsSearchapplicationsDelete',
  'type' => 'write',
  'name' => 'Settings Searchapplications Delete',
  'description' => 'Settings Searchapplications Delete (DELETE /v1/settings/{+name}).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_settings_searchapplications_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsSearchapplicationsCreate',
  'type' => 'write',
  'name' => 'Settings Searchapplications Create',
  'description' => 'Settings Searchapplications Create (POST /v1/settings/searchapplications).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_settings_searchapplications_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsSearchapplicationsList',
  'type' => 'read',
  'name' => 'Settings Searchapplications List',
  'description' => 'Settings Searchapplications List (GET /v1/settings/searchapplications).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_settings_searchapplications_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsSearchapplicationsGet',
  'type' => 'read',
  'name' => 'Settings Searchapplications Get',
  'description' => 'Settings Searchapplications Get (GET /v1/settings/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_settings_searchapplications_reset' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsSearchapplicationsReset',
  'type' => 'write',
  'name' => 'Settings Searchapplications Reset',
  'description' => 'Settings Searchapplications Reset (POST /v1/settings/{+name}:reset).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_settings_datasources_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsDatasourcesDelete',
  'type' => 'write',
  'name' => 'Settings Datasources Delete',
  'description' => 'Settings Datasources Delete (DELETE /v1/settings/{+name}).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_settings_datasources_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsDatasourcesPatch',
  'type' => 'write',
  'name' => 'Settings Datasources Patch',
  'description' => 'Settings Datasources Patch (PATCH /v1/settings/{+name}).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_settings_datasources_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsDatasourcesUpdate',
  'type' => 'write',
  'name' => 'Settings Datasources Update',
  'description' => 'Settings Datasources Update (PUT /v1/settings/{+name}).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_settings_datasources_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsDatasourcesCreate',
  'type' => 'write',
  'name' => 'Settings Datasources Create',
  'description' => 'Settings Datasources Create (POST /v1/settings/datasources).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_settings_datasources_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsDatasourcesGet',
  'type' => 'read',
  'name' => 'Settings Datasources Get',
  'description' => 'Settings Datasources Get (GET /v1/settings/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_settings_datasources_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchSettingsDatasourcesList',
  'type' => 'read',
  'name' => 'Settings Datasources List',
  'description' => 'Settings Datasources List (GET /v1/settings/datasources).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_debug_identitysources_unmappedids_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchDebugIdentitysourcesUnmappedidsList',
  'type' => 'read',
  'name' => 'Debug Identitysources Unmappedids List',
  'description' => 'Debug Identitysources Unmappedids List (GET /v1/debug/{+parent}/unmappedids).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_debug_identitysources_items_list_forunmappedidentity' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchDebugIdentitysourcesItemsListForunmappedidentity',
  'type' => 'read',
  'name' => 'Debug Identitysources Items List Forunmappedidentity',
  'description' => 'Debug Identitysources Items List Forunmappedidentity (GET /v1/debug/{+parent}/items:forunmappedidentity).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_debug_datasources_items_check_access' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchDebugDatasourcesItemsCheckAccess',
  'type' => 'write',
  'name' => 'Debug Datasources Items Check Access',
  'description' => 'Debug Datasources Items Check Access (POST /v1/debug/{+name}:checkAccess).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_debug_datasources_items_search_by_view_url' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchDebugDatasourcesItemsSearchByViewUrl',
  'type' => 'write',
  'name' => 'Debug Datasources Items Search By View Url',
  'description' => 'Debug Datasources Items Search By View Url (POST /v1/debug/{+name}/items:searchByViewUrl).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_debug_datasources_items_unmappedids_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchDebugDatasourcesItemsUnmappedidsList',
  'type' => 'read',
  'name' => 'Debug Datasources Items Unmappedids List',
  'description' => 'Debug Datasources Items Unmappedids List (GET /v1/debug/{+parent}/unmappedids).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_indexing_datasources_delete_schema' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesDeleteSchema',
  'type' => 'write',
  'name' => 'Indexing Datasources Delete Schema',
  'description' => 'Indexing Datasources Delete Schema (DELETE /v1/indexing/{+name}/schema).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_indexing_datasources_get_schema' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesGetSchema',
  'type' => 'read',
  'name' => 'Indexing Datasources Get Schema',
  'description' => 'Indexing Datasources Get Schema (GET /v1/indexing/{+name}/schema).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_indexing_datasources_update_schema' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesUpdateSchema',
  'type' => 'write',
  'name' => 'Indexing Datasources Update Schema',
  'description' => 'Indexing Datasources Update Schema (PUT /v1/indexing/{+name}/schema).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_indexing_datasources_items_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesItemsDelete',
  'type' => 'write',
  'name' => 'Indexing Datasources Items Delete',
  'description' => 'Indexing Datasources Items Delete (DELETE /v1/indexing/{+name}).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_indexing_datasources_items_index' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesItemsIndex',
  'type' => 'write',
  'name' => 'Indexing Datasources Items Index',
  'description' => 'Indexing Datasources Items Index (POST /v1/indexing/{+name}:index).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_indexing_datasources_items_unreserve' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesItemsUnreserve',
  'type' => 'write',
  'name' => 'Indexing Datasources Items Unreserve',
  'description' => 'Indexing Datasources Items Unreserve (POST /v1/indexing/{+name}/items:unreserve).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_indexing_datasources_items_poll' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesItemsPoll',
  'type' => 'write',
  'name' => 'Indexing Datasources Items Poll',
  'description' => 'Indexing Datasources Items Poll (POST /v1/indexing/{+name}/items:poll).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_indexing_datasources_items_push' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesItemsPush',
  'type' => 'write',
  'name' => 'Indexing Datasources Items Push',
  'description' => 'Indexing Datasources Items Push (POST /v1/indexing/{+name}:push).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_indexing_datasources_items_delete_queue_items' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesItemsDeleteQueueItems',
  'type' => 'write',
  'name' => 'Indexing Datasources Items Delete Queue Items',
  'description' => 'Indexing Datasources Items Delete Queue Items (POST /v1/indexing/{+name}/items:deleteQueueItems).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_indexing_datasources_items_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesItemsGet',
  'type' => 'read',
  'name' => 'Indexing Datasources Items Get',
  'description' => 'Indexing Datasources Items Get (GET /v1/indexing/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_indexing_datasources_items_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesItemsList',
  'type' => 'read',
  'name' => 'Indexing Datasources Items List',
  'description' => 'Indexing Datasources Items List (GET /v1/indexing/{+name}/items).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_indexing_datasources_items_upload' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchIndexingDatasourcesItemsUpload',
  'type' => 'write',
  'name' => 'Indexing Datasources Items Upload',
  'description' => 'Indexing Datasources Items Upload (POST /v1/indexing/{+name}:upload).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_media_upload' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchMediaUpload',
  'type' => 'write',
  'name' => 'Media Upload',
  'description' => 'Media Upload (POST /v1/media/{+resourceName}).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_v1_initialize_customer' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchV1InitializeCustomer',
  'type' => 'write',
  'name' => 'V1 Initialize Customer',
  'description' => 'V1 Initialize Customer (POST /v1:initializeCustomer).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_query_suggest' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchQuerySuggest',
  'type' => 'write',
  'name' => 'Query Suggest',
  'description' => 'Query Suggest (POST /v1/query/suggest).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_query_search' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchQuerySearch',
  'type' => 'write',
  'name' => 'Query Search',
  'description' => 'Query Search (POST /v1/query/search).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_query_remove_activity' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchQueryRemoveActivity',
  'type' => 'write',
  'name' => 'Query Remove Activity',
  'description' => 'Query Remove Activity (POST /v1/query:removeActivity).',
  'icon' => 'ph:cloud-arrow-up',
),
            'google_cloud_search_query_sources_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchQuerySourcesList',
  'type' => 'read',
  'name' => 'Query Sources List',
  'description' => 'Query Sources List (GET /v1/query/sources).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_stats_get_user' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchStatsGetUser',
  'type' => 'read',
  'name' => 'Stats Get User',
  'description' => 'Stats Get User (GET /v1/stats/user).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_stats_get_searchapplication' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchStatsGetSearchapplication',
  'type' => 'read',
  'name' => 'Stats Get Searchapplication',
  'description' => 'Stats Get Searchapplication (GET /v1/stats/searchapplication).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_stats_get_index' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchStatsGetIndex',
  'type' => 'read',
  'name' => 'Stats Get Index',
  'description' => 'Stats Get Index (GET /v1/stats/index).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_stats_get_query' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchStatsGetQuery',
  'type' => 'read',
  'name' => 'Stats Get Query',
  'description' => 'Stats Get Query (GET /v1/stats/query).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_stats_get_session' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchStatsGetSession',
  'type' => 'read',
  'name' => 'Stats Get Session',
  'description' => 'Stats Get Session (GET /v1/stats/session).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_stats_user_searchapplications_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchStatsUserSearchapplicationsGet',
  'type' => 'read',
  'name' => 'Stats User Searchapplications Get',
  'description' => 'Stats User Searchapplications Get (GET /v1/stats/user/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_stats_query_searchapplications_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchStatsQuerySearchapplicationsGet',
  'type' => 'read',
  'name' => 'Stats Query Searchapplications Get',
  'description' => 'Stats Query Searchapplications Get (GET /v1/stats/query/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_stats_index_datasources_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchStatsIndexDatasourcesGet',
  'type' => 'read',
  'name' => 'Stats Index Datasources Get',
  'description' => 'Stats Index Datasources Get (GET /v1/stats/index/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_cloud_search_stats_session_searchapplications_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCloudSearch\\Tools\\GoogleCloudSearchStatsSessionSearchapplicationsGet',
  'type' => 'read',
  'name' => 'Stats Session Searchapplications Get',
  'description' => 'Stats Session Searchapplications Get (GET /v1/stats/session/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Cloud Search tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleCloudSearchService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleCloudSearchService(accessToken: $creds->get('google-cloud-search', 'access_token', '', $account), baseUrl: $creds->get('google-cloud-search', 'url', 'https://cloudsearch.googleapis.com', $account));
        }
        return app(GoogleCloudSearchService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/google-cloud-search.md'; }
}