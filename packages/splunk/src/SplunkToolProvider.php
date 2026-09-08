<?php

namespace OpenCompany\Integrations\Splunk;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Splunk.
 *
 * Exposes search jobs, export, results, indexes, saved searches, apps, users,
 * server info, and safe raw relative services API tools.
 */
class SplunkToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'bearer_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Splunk Cloud deployments may require REST API access to be enabled for the management port.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'splunk';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Splunk',
            'description' => 'Search, indexes, saved searches, users, apps, and server metadata',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:splunk',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Splunk',
            'description' => 'Splunk REST API coverage for search jobs, export, results, events, indexes, saved searches, apps, users, server info, and raw relative services calls.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:splunk',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://help.splunk.com/en/splunk-enterprise/rest-api-reference',
        ];
    }

    /**
     * Get the configuration schema for the settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Enter your Splunk bearer token', 'hint' => 'Generate a token in Splunk under Settings > Tokens, or use a token provisioned by your Splunk administrator.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Splunk Services URL', 'placeholder' => 'https://example.splunkcloud.com:8089/services', 'hint' => 'Base URL for Splunk REST services. Self-hosted deployments commonly use https://host:8089/services.', 'default' => 'https://localhost:8089/services'],
        ];
    }

    /**
     * Test the connection to Splunk using current-context.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://localhost:8089/services'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->withOptions(['verify' => false])->get($baseUrl . '/authentication/current-context', [
                'output_mode' => 'json',
            ]);

            $json = $response->json();
            if (! is_array($json)) {
                return ['success' => false, 'error' => "Could not reach Splunk API at {$baseUrl}. Check the URL and network access."];
            }

            if (! $response->successful()) {
                return ['success' => false, 'error' => $json['messages'][0]['text'] ?? "Splunk API returned HTTP {$response->status()}."];
            }

            return ['success' => true, 'message' => "Connected to Splunk API at {$baseUrl}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the tool definitions for this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'splunk_search' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkSearch', 'type' => 'write', 'name' => 'Search', 'description' => 'Create an asynchronous search job.', 'icon' => 'ph:magnifying-glass'],
            'splunk_export_search' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkExportSearch', 'type' => 'read', 'name' => 'Export Search', 'description' => 'Run an export search.', 'icon' => 'ph:download-simple'],
            'splunk_list_search_jobs' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkListSearchJobs', 'type' => 'read', 'name' => 'List Search Jobs', 'description' => 'List search jobs.', 'icon' => 'ph:list-magnifying-glass'],
            'splunk_get_search_job' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkGetSearchJob', 'type' => 'read', 'name' => 'Get Search Job', 'description' => 'Get search job status and metadata.', 'icon' => 'ph:magnifying-glass'],
            'splunk_delete_search_job' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkDeleteSearchJob', 'type' => 'write', 'name' => 'Delete Search Job', 'description' => 'Cancel or delete a search job.', 'icon' => 'ph:trash'],
            'splunk_get_search_results' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkGetSearchResults', 'type' => 'read', 'name' => 'Get Search Results', 'description' => 'Retrieve results from a completed search job.', 'icon' => 'ph:table'],
            'splunk_get_search_events' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkGetSearchEvents', 'type' => 'read', 'name' => 'Get Search Events', 'description' => 'Retrieve events from a completed search job.', 'icon' => 'ph:list'],
            'splunk_get_search_log' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkGetSearchLog', 'type' => 'read', 'name' => 'Get Search Log', 'description' => 'Retrieve search.log for a search job.', 'icon' => 'ph:file-text'],
            'splunk_list_indexes' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkListIndexes', 'type' => 'read', 'name' => 'List Indexes', 'description' => 'List indexes.', 'icon' => 'ph:database'],
            'splunk_get_index' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkGetIndex', 'type' => 'read', 'name' => 'Get Index', 'description' => 'Get index details.', 'icon' => 'ph:database'],
            'splunk_create_index' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkCreateIndex', 'type' => 'write', 'name' => 'Create Index', 'description' => 'Create an index.', 'icon' => 'ph:database'],
            'splunk_update_index' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkUpdateIndex', 'type' => 'write', 'name' => 'Update Index', 'description' => 'Update an index.', 'icon' => 'ph:pencil-simple'],
            'splunk_delete_index' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkDeleteIndex', 'type' => 'write', 'name' => 'Delete Index', 'description' => 'Delete an index.', 'icon' => 'ph:trash'],
            'splunk_list_saved_searches' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkListSavedSearches', 'type' => 'read', 'name' => 'List Saved Searches', 'description' => 'List saved searches.', 'icon' => 'ph:floppy-disk'],
            'splunk_get_saved_search' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkGetSavedSearch', 'type' => 'read', 'name' => 'Get Saved Search', 'description' => 'Get a saved search.', 'icon' => 'ph:floppy-disk'],
            'splunk_create_saved_search' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkCreateSavedSearch', 'type' => 'write', 'name' => 'Create Saved Search', 'description' => 'Create a saved search.', 'icon' => 'ph:plus-circle'],
            'splunk_update_saved_search' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkUpdateSavedSearch', 'type' => 'write', 'name' => 'Update Saved Search', 'description' => 'Update a saved search.', 'icon' => 'ph:pencil-simple'],
            'splunk_delete_saved_search' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkDeleteSavedSearch', 'type' => 'write', 'name' => 'Delete Saved Search', 'description' => 'Delete a saved search.', 'icon' => 'ph:trash'],
            'splunk_dispatch_saved_search' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkDispatchSavedSearch', 'type' => 'write', 'name' => 'Dispatch Saved Search', 'description' => 'Dispatch a saved search.', 'icon' => 'ph:play'],
            'splunk_list_apps' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkListApps', 'type' => 'read', 'name' => 'List Apps', 'description' => 'List installed apps.', 'icon' => 'ph:squares-four'],
            'splunk_get_app' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkGetApp', 'type' => 'read', 'name' => 'Get App', 'description' => 'Get an installed app.', 'icon' => 'ph:squares-four'],
            'splunk_list_users' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkListUsers', 'type' => 'read', 'name' => 'List Users', 'description' => 'List Splunk users.', 'icon' => 'ph:users'],
            'splunk_get_user' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkGetUser', 'type' => 'read', 'name' => 'Get User', 'description' => 'Get a Splunk user.', 'icon' => 'ph:user'],
            'splunk_get_current_user' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the current authenticated user context.', 'icon' => 'ph:user'],
            'splunk_get_server_info' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkGetServerInfo', 'type' => 'read', 'name' => 'Get Server Info', 'description' => 'Get Splunk server version and platform info.', 'icon' => 'ph:info'],
            'splunk_api_get' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkApiGet', 'type' => 'read', 'name' => 'Api Get', 'description' => 'Call a safe relative services path with GET.', 'icon' => 'ph:magnifying-glass'],
            'splunk_api_post' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkApiPost', 'type' => 'write', 'name' => 'Api Post', 'description' => 'Call a safe relative services path with POST.', 'icon' => 'ph:pencil-simple'],
            'splunk_api_delete' => ['class' => 'OpenCompany\\Integrations\\Splunk\\Tools\\SplunkApiDelete', 'type' => 'write', 'name' => 'Api Delete', 'description' => 'Call a safe relative services path with DELETE.', 'icon' => 'ph:trash'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/splunk.md';
    }

    /**
     * Get the credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Splunk Services URL', 'required' => false, 'default' => 'https://localhost:8089/services'],
        ];
    }

    /**
     * Confirm this provider is an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool with optional account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Fully-qualified tool class name.
     * @param  array{account?: mixed}  $context  Optional multi-account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the service for the default account or a named account.
     *
     * @param  array{account?: mixed}  $context  Optional multi-account context.
     */
    private function resolveService(array $context = []): SplunkService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new SplunkService(
                accessToken: $creds->get('splunk', 'access_token', '', $account),
                baseUrl: $creds->get('splunk', 'url', 'https://localhost:8089/services', $account),
            );
        }

        return app(SplunkService::class);
    }
}
