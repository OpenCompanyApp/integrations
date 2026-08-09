<?php

namespace OpenCompany\Integrations\Algolia;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaAddApiKey;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaApiDelete;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaApiGet;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaApiPost;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaApiPut;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaBatch;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaBatchRules;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaBatchSynonyms;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaBrowse;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaClearIndex;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaClearRules;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaClearSynonyms;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaDeleteApiKey;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaDeleteIndex;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaDeleteObject;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaDeleteRule;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaDeleteSynonym;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaGetApiKey;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaGetCurrentUser;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaGetObject;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaGetRule;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaGetSettings;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaGetSynonym;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaGetTask;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaIndexOperation;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaListApiKeys;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaListIndices;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaListLogs;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaPartialUpdate;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSaveObject;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSaveRule;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSaveSynonym;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSearch;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSearchFacetValues;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSearchMultiple;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSearchRules;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSearchSynonyms;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSetSettings;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaUpdateApiKey;

/**
 * Registers Algolia tools, metadata, credential fields, and multi-account service resolution.
 */
class AlgoliaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [
                    'Use an Algolia Admin API key for full index, settings, rules, synonyms, keys, and logs coverage. Search-only keys can run read/search tools only.',
                ],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
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
        return 'algolia';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Algolia',
            'description' => 'Search indexing and relevance',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:algolia',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Algolia',
            'description' => 'Search, indexing, settings, synonyms, rules, API keys, logs, and tasks.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:algolia',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.algolia.com/doc/rest-api/search/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'app_id',
                'type' => 'text',
                'label' => 'Application ID',
                'placeholder' => 'e.g. ABC123XYZ',
                'hint' => 'Found in the Algolia dashboard under Settings > API Keys.',
                'required' => true,
            ],
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Algolia API key',
                'hint' => 'Use the Admin API Key for full coverage. Search-only keys can only run read/search tools.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test Algolia credentials with a lightweight list indices call.
     *
     * @param  array<string, mixed>  $config  Credential configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $appId = (string) ($config['app_id'] ?? '');
        $apiKey = (string) ($config['api_key'] ?? '');

        if ($appId === '' || $apiKey === '') {
            return ['success' => false, 'error' => 'Application ID and API Key are required.'];
        }

        try {
            $response = Http::withHeaders([
                'X-Algolia-Application-Id' => $appId,
                'X-Algolia-API-Key' => $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get("https://{$appId}.algolia.net/1/indexes");

            if ($response->successful()) {
                $data = $response->json();
                $indexCount = count($data['items'] ?? []);

                return [
                    'success' => true,
                    'message' => "Connected to Algolia (Application ID: {$appId}). Found {$indexCount} index(es).",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Algolia API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'app_id' => 'nullable|string',
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'algolia_search' => $this->tool(AlgoliaSearch::class, 'read', 'Search', 'Search an Algolia index.'),
            'algolia_search_multiple' => $this->tool(AlgoliaSearchMultiple::class, 'read', 'Search Multiple', 'Search multiple Algolia indices in one request.'),
            'algolia_browse' => $this->tool(AlgoliaBrowse::class, 'read', 'Browse', 'Browse records in an index for exports or complete scans.'),
            'algolia_search_facet_values' => $this->tool(AlgoliaSearchFacetValues::class, 'read', 'Search Facet Values', 'Search values for a facet attribute.'),
            'algolia_get_object' => $this->tool(AlgoliaGetObject::class, 'read', 'Get Object', 'Retrieve a single record by objectID.'),
            'algolia_save_object' => $this->tool(AlgoliaSaveObject::class, 'write', 'Save Object', 'Create or replace a record in an index.'),
            'algolia_delete_object' => $this->tool(AlgoliaDeleteObject::class, 'write', 'Delete Object', 'Delete a record from an index.'),
            'algolia_partial_update' => $this->tool(AlgoliaPartialUpdate::class, 'write', 'Partial Update', 'Update specific attributes of a record.'),
            'algolia_list_indices' => $this->tool(AlgoliaListIndices::class, 'read', 'List Indices', 'List all indices in an application.'),
            'algolia_get_settings' => $this->tool(AlgoliaGetSettings::class, 'read', 'Get Settings', 'Get index settings.'),
            'algolia_set_settings' => $this->tool(AlgoliaSetSettings::class, 'write', 'Set Settings', 'Update index settings.'),
            'algolia_clear_index' => $this->tool(AlgoliaClearIndex::class, 'write', 'Clear Index', 'Remove all records from an index.'),
            'algolia_delete_index' => $this->tool(AlgoliaDeleteIndex::class, 'write', 'Delete Index', 'Delete an index.'),
            'algolia_index_operation' => $this->tool(AlgoliaIndexOperation::class, 'write', 'Index Operation', 'Copy or move an index.'),
            'algolia_batch' => $this->tool(AlgoliaBatch::class, 'write', 'Batch', 'Perform multiple write operations in one request.'),
            'algolia_get_task' => $this->tool(AlgoliaGetTask::class, 'read', 'Get Task', 'Get status for an indexing task.'),
            'algolia_search_synonyms' => $this->tool(AlgoliaSearchSynonyms::class, 'read', 'Search Synonyms', 'Search synonyms in an index.'),
            'algolia_get_synonym' => $this->tool(AlgoliaGetSynonym::class, 'read', 'Get Synonym', 'Get one synonym.'),
            'algolia_save_synonym' => $this->tool(AlgoliaSaveSynonym::class, 'write', 'Save Synonym', 'Create or replace one synonym.'),
            'algolia_delete_synonym' => $this->tool(AlgoliaDeleteSynonym::class, 'write', 'Delete Synonym', 'Delete one synonym.'),
            'algolia_batch_synonyms' => $this->tool(AlgoliaBatchSynonyms::class, 'write', 'Batch Synonyms', 'Create or update multiple synonyms.'),
            'algolia_clear_synonyms' => $this->tool(AlgoliaClearSynonyms::class, 'write', 'Clear Synonyms', 'Clear index synonyms.'),
            'algolia_search_rules' => $this->tool(AlgoliaSearchRules::class, 'read', 'Search Rules', 'Search query rules in an index.'),
            'algolia_get_rule' => $this->tool(AlgoliaGetRule::class, 'read', 'Get Rule', 'Get one query rule.'),
            'algolia_save_rule' => $this->tool(AlgoliaSaveRule::class, 'write', 'Save Rule', 'Create or replace one query rule.'),
            'algolia_delete_rule' => $this->tool(AlgoliaDeleteRule::class, 'write', 'Delete Rule', 'Delete one query rule.'),
            'algolia_batch_rules' => $this->tool(AlgoliaBatchRules::class, 'write', 'Batch Rules', 'Create or update multiple query rules.'),
            'algolia_clear_rules' => $this->tool(AlgoliaClearRules::class, 'write', 'Clear Rules', 'Clear index query rules.'),
            'algolia_get_current_user' => $this->tool(AlgoliaGetCurrentUser::class, 'read', 'List API Keys (Legacy)', 'Legacy slug that lists API keys. Use algolia_list_api_keys for new agents.'),
            'algolia_list_api_keys' => $this->tool(AlgoliaListApiKeys::class, 'read', 'List API Keys', 'List API keys.'),
            'algolia_get_api_key' => $this->tool(AlgoliaGetApiKey::class, 'read', 'Get API Key', 'Get one API key.'),
            'algolia_add_api_key' => $this->tool(AlgoliaAddApiKey::class, 'write', 'Add API Key', 'Add a restricted API key.'),
            'algolia_update_api_key' => $this->tool(AlgoliaUpdateApiKey::class, 'write', 'Update API Key', 'Update an API key.'),
            'algolia_delete_api_key' => $this->tool(AlgoliaDeleteApiKey::class, 'write', 'Delete API Key', 'Delete an API key.'),
            'algolia_list_logs' => $this->tool(AlgoliaListLogs::class, 'read', 'List Logs', 'List recent Algolia logs.'),
            'algolia_api_get' => $this->tool(AlgoliaApiGet::class, 'read', 'API GET', 'Call a relative Algolia API path with GET.'),
            'algolia_api_post' => $this->tool(AlgoliaApiPost::class, 'write', 'API POST', 'Call a relative Algolia API path with POST.'),
            'algolia_api_put' => $this->tool(AlgoliaApiPut::class, 'write', 'API PUT', 'Call a relative Algolia API path with PUT.'),
            'algolia_api_delete' => $this->tool(AlgoliaApiDelete::class, 'write', 'API DELETE', 'Call a relative Algolia API path with DELETE.'),
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/algolia.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'app_id', 'type' => 'text', 'label' => 'Application ID', 'required' => true],
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool with default or account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Algolia service, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    private function resolveService(array $context = []): AlgoliaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AlgoliaService(
                appId: $creds->get('algolia', 'app_id', '', $account),
                apiKey: $creds->get('algolia', 'api_key', '', $account),
            );
        }

        return app(AlgoliaService::class);
    }

    /**
     * Build one catalog entry.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @return array<string, mixed>
     */
    private function tool(string $class, string $type, string $name, string $description): array
    {
        return [
            'class' => $class,
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'icon' => $type === 'read' ? 'ph:magnifying-glass' : 'ph:pencil-simple',
        ];
    }
}
