<?php

namespace OpenCompany\Integrations\Browserbase;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseContextsCreate;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseContextsGet;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseContextsUpdate;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseContextsDelete;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseDownloadsList;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseDownloadsGet;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseDownloadsDelete;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseExtensionsUpload;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseExtensionsGet;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseExtensionsDelete;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseFetchCreate;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseFunctionsList;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseFunctionBuildsList;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseFunctionBuildsGet;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseFunctionBuildsGetLogs;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseInvocationsGet;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseInvocationsGetLogs;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseFunctionVersionsGet;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseFunctionVersionsListInvocations;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseFunctionsGet;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseFunctionsInvoke;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseFunctionsListVersions;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseProjectsList;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseProjectsGet;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseProjectsUsage;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseSearchWeb;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseSessionsList;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseSessionsCreate;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseSessionsGet;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseSessionsUpdate;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseSessionsGetDebug;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseSessionsGetLogs;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseSessionsGetRecording;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseSessionsUploadFile;

/**
 * Tool catalog and configuration metadata for Browserbase.
 *
 * Exposes the official Browserbase OpenAPI v1 operation set as endpoint-specific
 * tools and resolves account-specific API keys for multi-account hosts.
 */
class BrowserbaseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => [], 'notes' => ['Browserbase uses the X-BB-API-Key request header.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'browserbase'; }
    public function appMeta(): array { return ['label' => 'Browserbase', 'description' => 'Cloud browser sessions, fetch, search, functions, contexts, downloads, and extensions', 'icon' => 'ph:browser', 'logo' => 'ph:browser']; }
    public function integrationMeta(): array { return ['name' => 'Browserbase', 'description' => 'Manage Browserbase cloud browser sessions, contexts, extensions, downloads, functions, fetch, search, projects, and usage.', 'icon' => 'ph:browser', 'logo' => 'ph:browser', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://docs.browserbase.com/reference/api/overview']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Browserbase API key', 'hint' => 'Sent as X-BB-API-Key.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.browserbase.com', 'hint' => 'Use https://api.browserbase.com unless Browserbase provides a dedicated endpoint.', 'default' => 'https://api.browserbase.com']]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? ''); $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.browserbase.com'), '/');
        if ($apiKey === '') { return ['success' => false, 'error' => 'Browserbase API key is required.']; }
        try { $response = Http::withHeaders(['X-BB-API-Key' => $apiKey, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/v1/projects'); if (!$response->successful()) { return ['success' => false, 'error' => 'Browserbase API returned HTTP ' . $response->status() . '.']; } return ['success' => true, 'message' => 'Connected to Browserbase at ' . $baseUrl . '.']; } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['api_key' => 'nullable|string', 'url' => 'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            'browserbase_contexts_create' => [
                'class' => BrowserbaseContextsCreate::class,
                'name' => 'Contexts Create',
                'description' => 'Create a Context

Official Browserbase endpoint: POST /v1/contexts.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Browserbase OpenAPI schema.',
                    ],
                ],
            ],
            'browserbase_contexts_get' => [
                'class' => BrowserbaseContextsGet::class,
                'name' => 'Contexts Get',
                'description' => 'Get a Context

Official Browserbase endpoint: GET /v1/contexts/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_contexts_update' => [
                'class' => BrowserbaseContextsUpdate::class,
                'name' => 'Contexts Update',
                'description' => 'Update a Context

Official Browserbase endpoint: PUT /v1/contexts/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_contexts_delete' => [
                'class' => BrowserbaseContextsDelete::class,
                'name' => 'Contexts Delete',
                'description' => 'Delete a Context

Official Browserbase endpoint: DELETE /v1/contexts/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_downloads_list' => [
                'class' => BrowserbaseDownloadsList::class,
                'name' => 'Downloads List',
                'description' => 'List Downloads

Official Browserbase endpoint: GET /v1/downloads.',
                'parameters' => [
                    'session_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Filter downloads by session ID (required).',
                    ],
                    'filename' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter by exact filename match.',
                    ],
                    'mime_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter by MIME type.',
                    ],
                    'min_size' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Minimum file size in bytes.',
                    ],
                    'max_size' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Maximum file size in bytes.',
                    ],
                    'created_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter downloads created on or after this timestamp.',
                    ],
                    'created_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter downloads created on or before this timestamp.',
                    ],
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Maximum number of results to return.',
                    ],
                    'offset' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of results to skip for pagination.',
                    ],
                ],
            ],
            'browserbase_downloads_get' => [
                'class' => BrowserbaseDownloadsGet::class,
                'name' => 'Downloads Get',
                'description' => 'Get a Download

Official Browserbase endpoint: GET /v1/downloads/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The download ID.',
                    ],
                ],
            ],
            'browserbase_downloads_delete' => [
                'class' => BrowserbaseDownloadsDelete::class,
                'name' => 'Downloads Delete',
                'description' => 'Delete a Download

Official Browserbase endpoint: DELETE /v1/downloads/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The download ID to delete.',
                    ],
                ],
            ],
            'browserbase_extensions_upload' => [
                'class' => BrowserbaseExtensionsUpload::class,
                'name' => 'Extensions Upload',
                'description' => 'Upload an Extension

Official Browserbase endpoint: POST /v1/extensions.',
                'parameters' => [
                    'file' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'file Provide a local file path for upload.',
                    ],
                ],
            ],
            'browserbase_extensions_get' => [
                'class' => BrowserbaseExtensionsGet::class,
                'name' => 'Extensions Get',
                'description' => 'Get an Extension

Official Browserbase endpoint: GET /v1/extensions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_extensions_delete' => [
                'class' => BrowserbaseExtensionsDelete::class,
                'name' => 'Extensions Delete',
                'description' => 'Delete an Extension

Official Browserbase endpoint: DELETE /v1/extensions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_fetch_create' => [
                'class' => BrowserbaseFetchCreate::class,
                'name' => 'Fetch Create',
                'description' => 'Fetch a Page

Official Browserbase endpoint: POST /v1/fetch.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Browserbase OpenAPI schema.',
                    ],
                ],
            ],
            'browserbase_functions_list' => [
                'class' => BrowserbaseFunctionsList::class,
                'name' => 'Functions List',
                'description' => 'List Functions

Official Browserbase endpoint: GET /v1/functions.',
                'parameters' => [
                    'offset' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'offset',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'limit',
                    ],
                ],
            ],
            'browserbase_function_builds_list' => [
                'class' => BrowserbaseFunctionBuildsList::class,
                'name' => 'Function Builds List',
                'description' => 'List Function Builds

Official Browserbase endpoint: GET /v1/functions/builds.',
                'parameters' => [
                    'offset' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'offset',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'limit',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                ],
            ],
            'browserbase_function_builds_get' => [
                'class' => BrowserbaseFunctionBuildsGet::class,
                'name' => 'Function Builds Get',
                'description' => 'Get a Function Build

Official Browserbase endpoint: GET /v1/functions/builds/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_function_builds_get_logs' => [
                'class' => BrowserbaseFunctionBuildsGetLogs::class,
                'name' => 'Function Builds Get Logs',
                'description' => 'Get Function Build Logs

Official Browserbase endpoint: GET /v1/functions/builds/{id}/logs.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_invocations_get' => [
                'class' => BrowserbaseInvocationsGet::class,
                'name' => 'Invocations Get',
                'description' => 'Get an Invocation

Official Browserbase endpoint: GET /v1/functions/invocations/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_invocations_get_logs' => [
                'class' => BrowserbaseInvocationsGetLogs::class,
                'name' => 'Invocations Get Logs',
                'description' => 'Get Invocation Logs

Official Browserbase endpoint: GET /v1/functions/invocations/{id}/logs.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_function_versions_get' => [
                'class' => BrowserbaseFunctionVersionsGet::class,
                'name' => 'Function Versions Get',
                'description' => 'Get a Function Version

Official Browserbase endpoint: GET /v1/functions/versions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_function_versions_list_invocations' => [
                'class' => BrowserbaseFunctionVersionsListInvocations::class,
                'name' => 'Function Versions List Invocations',
                'description' => 'List Invocations for a Function Version

Official Browserbase endpoint: GET /v1/functions/versions/{id}/invocations.',
                'parameters' => [
                    'offset' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'offset',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'limit',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_functions_get' => [
                'class' => BrowserbaseFunctionsGet::class,
                'name' => 'Functions Get',
                'description' => 'Get a Function

Official Browserbase endpoint: GET /v1/functions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_functions_invoke' => [
                'class' => BrowserbaseFunctionsInvoke::class,
                'name' => 'Functions Invoke',
                'description' => 'Invoke a Function

Official Browserbase endpoint: POST /v1/functions/{id}/invoke.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Browserbase OpenAPI schema.',
                    ],
                ],
            ],
            'browserbase_functions_list_versions' => [
                'class' => BrowserbaseFunctionsListVersions::class,
                'name' => 'Functions List Versions',
                'description' => 'List Function Versions

Official Browserbase endpoint: GET /v1/functions/{id}/versions.',
                'parameters' => [
                    'offset' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'offset',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'limit',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_projects_list' => [
                'class' => BrowserbaseProjectsList::class,
                'name' => 'Projects List',
                'description' => 'List Projects

Official Browserbase endpoint: GET /v1/projects.',
                'parameters' => [],
            ],
            'browserbase_projects_get' => [
                'class' => BrowserbaseProjectsGet::class,
                'name' => 'Projects Get',
                'description' => 'Get a Project

Official Browserbase endpoint: GET /v1/projects/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_projects_usage' => [
                'class' => BrowserbaseProjectsUsage::class,
                'name' => 'Projects Usage',
                'description' => 'Get Project Usage

Official Browserbase endpoint: GET /v1/projects/{id}/usage.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_search_web' => [
                'class' => BrowserbaseSearchWeb::class,
                'name' => 'Search Web',
                'description' => 'Web Search

Official Browserbase endpoint: POST /v1/search.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Browserbase OpenAPI schema.',
                    ],
                ],
            ],
            'browserbase_sessions_list' => [
                'class' => BrowserbaseSessionsList::class,
                'name' => 'Sessions List',
                'description' => 'List Sessions

Official Browserbase endpoint: GET /v1/sessions.',
                'parameters' => [
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                        'enum' => [
                            'PENDING',
                            'RUNNING',
                            'ERROR',
                            'TIMED_OUT',
                            'COMPLETED',
                        ],
                    ],
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Query sessions by user metadata. See [Querying Sessions by User Metadata](/features/sessions#querying-sessions-by-user-metadata) for the schema of this query.',
                    ],
                ],
            ],
            'browserbase_sessions_create' => [
                'class' => BrowserbaseSessionsCreate::class,
                'name' => 'Sessions Create',
                'description' => 'Create a Session

Official Browserbase endpoint: POST /v1/sessions.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Browserbase OpenAPI schema.',
                    ],
                ],
            ],
            'browserbase_sessions_get' => [
                'class' => BrowserbaseSessionsGet::class,
                'name' => 'Sessions Get',
                'description' => 'Get a Session

Official Browserbase endpoint: GET /v1/sessions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_sessions_update' => [
                'class' => BrowserbaseSessionsUpdate::class,
                'name' => 'Sessions Update',
                'description' => 'Update a Session

Official Browserbase endpoint: POST /v1/sessions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Browserbase OpenAPI schema.',
                    ],
                ],
            ],
            'browserbase_sessions_get_debug' => [
                'class' => BrowserbaseSessionsGetDebug::class,
                'name' => 'Sessions Get Debug',
                'description' => 'Session Live URLs

Official Browserbase endpoint: GET /v1/sessions/{id}/debug.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_sessions_get_logs' => [
                'class' => BrowserbaseSessionsGetLogs::class,
                'name' => 'Sessions Get Logs',
                'description' => 'Session Logs

Official Browserbase endpoint: GET /v1/sessions/{id}/logs.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_sessions_get_recording' => [
                'class' => BrowserbaseSessionsGetRecording::class,
                'name' => 'Sessions Get Recording',
                'description' => 'Session Recording

Official Browserbase endpoint: GET /v1/sessions/{id}/recording.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'browserbase_sessions_upload_file' => [
                'class' => BrowserbaseSessionsUploadFile::class,
                'name' => 'Sessions Upload File',
                'description' => 'Create Session Uploads

Official Browserbase endpoint: POST /v1/sessions/{id}/uploads.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'file' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'file Provide a local file path for upload.',
                    ],
                ],
            ],
        ]; }
    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): BrowserbaseService { $account = $context['account'] ?? null; if ($account !== null) { $creds = app(CredentialResolver::class); return new BrowserbaseService(apiKey: $creds->get('browserbase', 'api_key', '', $account), baseUrl: $creds->get('browserbase', 'url', 'https://api.browserbase.com', $account)); } return app(BrowserbaseService::class); }
    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/browserbase.md'; }
    public function isIntegration(): bool { return true; }
}
