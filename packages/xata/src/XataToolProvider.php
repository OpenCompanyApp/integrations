<?php

namespace OpenCompany\Integrations\Xata;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides Xata tools and setup metadata.
 *
 * Covers workspace database management and data-plane branch, schema, records,
 * query, search, aggregate, vector search, and transaction operations.
 */
class XataToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Compact tool definitions for catalog extraction.
     *
     * @var array<string, array{0: string, 1: string, 2: string, 3: string, 4: string}>
     */
    private const TOOL_DEFINITIONS = [
        'xata_list_databases' => ['XataListDatabases', 'read', 'List Databases', 'List databases in a Xata workspace.', 'ph:database'],
        'xata_create_database' => ['XataCreateDatabase', 'write', 'Create Database', 'Create a Xata database in a workspace.', 'ph:database'],
        'xata_list_branches' => ['XataListBranches', 'read', 'List Branches', 'List branches for a Xata database.', 'ph:git-branch'],
        'xata_create_branch' => ['XataCreateBranch', 'write', 'Create Branch', 'Create a branch for a Xata database.', 'ph:git-branch'],
        'xata_get_schema' => ['XataGetSchema', 'read', 'Get Schema', 'Read schema for a database branch.', 'ph:brackets-curly'],
        'xata_update_schema' => ['XataUpdateSchema', 'write', 'Update Schema', 'Update schema for a database branch.', 'ph:brackets-curly'],
        'xata_query_table' => ['XataQueryTable', 'read', 'Query Table', 'Query records from a table.', 'ph:list-magnifying-glass'],
        'xata_search_branch' => ['XataSearchBranch', 'read', 'Search Branch', 'Search records across a branch.', 'ph:magnifying-glass'],
        'xata_get_record' => ['XataGetRecord', 'read', 'Get Record', 'Get one record by table and id.', 'ph:file-text'],
        'xata_insert_record' => ['XataInsertRecord', 'write', 'Insert Record', 'Insert a record into a table.', 'ph:plus-circle'],
        'xata_update_record' => ['XataUpdateRecord', 'write', 'Update Record', 'Patch a record by table and id.', 'ph:pencil-simple'],
        'xata_delete_record' => ['XataDeleteRecord', 'write', 'Delete Record', 'Delete a record by table and id.', 'ph:trash'],
        'xata_aggregate_table' => ['XataAggregateTable', 'read', 'Aggregate Table', 'Run table aggregation queries.', 'ph:chart-bar'],
        'xata_vector_search' => ['XataVectorSearch', 'read', 'Vector Search', 'Run vector similarity search for a table.', 'ph:target'],
        'xata_transaction' => ['XataTransaction', 'write', 'Transaction', 'Execute a branch transaction.', 'ph:arrows-clockwise'],
    ];

    /**
     * Describe auth and host support for catalog setup flows.
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
                'token_keys' => ['api_key'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
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
        return 'xata';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Xata',
            'description' => 'Serverless database and search',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:xata',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Xata',
            'description' => 'Manage Xata databases, branches, schemas, records, search, vector search, aggregations, and transactions.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:xata',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://xata.io/docs/api-reference',
            'source_url' => 'https://xata.io/docs/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'xau_...',
                'hint' => 'Create a personal API key in Xata account settings.',
                'required' => true,
            ],
            [
                'key' => 'workspace_id',
                'type' => 'text',
                'label' => 'Workspace ID',
                'placeholder' => 'ws_...',
                'hint' => 'Required for workspace management operations such as listing databases.',
            ],
            [
                'key' => 'api_endpoint',
                'type' => 'url',
                'label' => 'Database API Endpoint',
                'placeholder' => 'https://example.us-east-1.xata.sh',
                'hint' => 'Required for database branch operations.',
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Management API Base URL',
                'placeholder' => 'https://api.xata.io',
                'default' => 'https://api.xata.io',
            ],
        ];
    }

    /**
     * Test the API key against the workspaces endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.xata.io'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'Xata API key is required.'];
        }

        try {
            $response = Http::withToken($apiKey)->acceptJson()->timeout(10)->get($baseUrl . '/workspaces');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Xata API returned HTTP ' . $response->status() . '.'];
            }

            return ['success' => true, 'message' => 'Connected to Xata.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'workspace_id' => 'nullable|string',
            'api_endpoint' => 'nullable|url',
            'url' => 'nullable|url',
        ];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Return Xata tool metadata.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (self::TOOL_DEFINITIONS as $slug => [$class, $type, $name, $description, $icon]) {
            $tools[$slug] = [
                'class' => __NAMESPACE__ . '\\Tools\\' . $class,
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'icon' => $icon,
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/xata.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Xata tool with default or account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @param  array<string, mixed>  $context  Optional context containing an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new $class(new XataService(
                apiKey: (string) $creds->get('xata', 'api_key', '', (string) $account),
                workspaceId: (string) $creds->get('xata', 'workspace_id', '', (string) $account),
                apiEndpoint: (string) $creds->get('xata', 'api_endpoint', '', (string) $account),
                baseUrl: (string) $creds->get('xata', 'url', 'https://api.xata.io', (string) $account),
            ));
        }

        return new $class(app(XataService::class));
    }
}
