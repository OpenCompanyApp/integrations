<?php

namespace OpenCompany\Integrations\Chroma;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Chroma\Tools\ChromaAddDocuments;
use OpenCompany\Integrations\Chroma\Tools\ChromaCountCollections;
use OpenCompany\Integrations\Chroma\Tools\ChromaCountDocuments;
use OpenCompany\Integrations\Chroma\Tools\ChromaCreateCollection;
use OpenCompany\Integrations\Chroma\Tools\ChromaDeleteCollection;
use OpenCompany\Integrations\Chroma\Tools\ChromaDeleteDocuments;
use OpenCompany\Integrations\Chroma\Tools\ChromaGetCollection;
use OpenCompany\Integrations\Chroma\Tools\ChromaGetDocument;
use OpenCompany\Integrations\Chroma\Tools\ChromaGetHealth;
use OpenCompany\Integrations\Chroma\Tools\ChromaListCollections;
use OpenCompany\Integrations\Chroma\Tools\ChromaQueryDocuments;
use OpenCompany\Integrations\Chroma\Tools\ChromaUpdateCollection;
use OpenCompany\Integrations\Chroma\Tools\ChromaUpdateDocuments;
use OpenCompany\Integrations\Chroma\Tools\ChromaUpsertDocuments;

/**
 * Registers Chroma tools and integration metadata.
 *
 * Exposes the official v2 REST API surfaces for system heartbeat, collection
 * management, and record add/get/query/update/upsert/delete operations.
 */
class ChromaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'token_keys' => ['api_key'],
                'notes' => ['Chroma v2 REST API uses the x-chroma-token header. Local self-hosted deployments may also run without authentication, but hosted deployments require a token.'],
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
        return 'chroma';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Chroma',
            'description' => 'Vector database',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:chroma',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Chroma',
            'description' => 'Open-source vector database for storing, managing, and querying embeddings.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:chroma',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.trychroma.com/reference/chroma-api',
            'source_url' => 'https://docs.trychroma.com/reference/chroma-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Chroma API token',
                'hint' => 'Token sent as the <code>x-chroma-token</code> header.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Chroma Server URL',
                'placeholder' => 'https://api.trychroma.com',
                'hint' => 'Server origin only; do not include <code>/api/v2</code>.',
                'default' => 'http://localhost:8000',
            ],
            [
                'key' => 'tenant',
                'type' => 'text',
                'label' => 'Tenant',
                'placeholder' => 'default_tenant',
                'default' => 'default_tenant',
            ],
            [
                'key' => 'database',
                'type' => 'text',
                'label' => 'Database',
                'placeholder' => 'default_database',
                'default' => 'default_database',
            ],
        ];
    }

    /**
     * Test the connection by calling the Chroma v2 heartbeat endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'http://localhost:8000'), '/');
        $baseUrl = (string) preg_replace('#/api/v[12]$#', '', $baseUrl);

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'x-chroma-token' => $apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v2/heartbeat');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Chroma server at {$baseUrl}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Chroma server returned status {$response->status()}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => "Could not reach Chroma server: {$e->getMessage()}"];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
            'tenant' => 'nullable|string',
            'database' => 'nullable|string',
        ];
    }

    /**
     * Return Chroma tool metadata.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'chroma_get_health' => [
                'class' => ChromaGetHealth::class,
                'type' => 'read',
                'name' => 'Get Health',
                'description' => 'Check the Chroma v2 heartbeat endpoint.',
                'icon' => 'ph:heartbeat',
            ],
            'chroma_list_collections' => [
                'class' => ChromaListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List vector collections in the configured tenant/database.',
                'icon' => 'ph:list',
            ],
            'chroma_count_collections' => [
                'class' => ChromaCountCollections::class,
                'type' => 'read',
                'name' => 'Count Collections',
                'description' => 'Count vector collections in the configured tenant/database.',
                'icon' => 'ph:number-circle-one',
            ],
            'chroma_get_collection' => [
                'class' => ChromaGetCollection::class,
                'type' => 'read',
                'name' => 'Get Collection',
                'description' => 'Get details for a collection by UUID or name.',
                'icon' => 'ph:folder-open',
            ],
            'chroma_create_collection' => [
                'class' => ChromaCreateCollection::class,
                'type' => 'write',
                'name' => 'Create Collection',
                'description' => 'Create a new vector collection.',
                'icon' => 'ph:folder-plus',
            ],
            'chroma_update_collection' => [
                'class' => ChromaUpdateCollection::class,
                'type' => 'write',
                'name' => 'Update Collection',
                'description' => 'Update collection name, metadata, or configuration.',
                'icon' => 'ph:pencil-simple',
            ],
            'chroma_delete_collection' => [
                'class' => ChromaDeleteCollection::class,
                'type' => 'write',
                'name' => 'Delete Collection',
                'description' => 'Delete a collection and all records in it.',
                'icon' => 'ph:trash',
            ],
            'chroma_add_documents' => [
                'class' => ChromaAddDocuments::class,
                'type' => 'write',
                'name' => 'Add Documents',
                'description' => 'Add records with embeddings, documents, metadata, or URIs.',
                'icon' => 'ph:file-plus',
            ],
            'chroma_update_documents' => [
                'class' => ChromaUpdateDocuments::class,
                'type' => 'write',
                'name' => 'Update Documents',
                'description' => 'Update existing records in a collection.',
                'icon' => 'ph:pencil-simple-line',
            ],
            'chroma_upsert_documents' => [
                'class' => ChromaUpsertDocuments::class,
                'type' => 'write',
                'name' => 'Upsert Documents',
                'description' => 'Create or update records in a collection.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chroma_delete_documents' => [
                'class' => ChromaDeleteDocuments::class,
                'type' => 'write',
                'name' => 'Delete Documents',
                'description' => 'Delete records by IDs or filters.',
                'icon' => 'ph:trash-simple',
            ],
            'chroma_count_documents' => [
                'class' => ChromaCountDocuments::class,
                'type' => 'read',
                'name' => 'Count Documents',
                'description' => 'Count records in a collection.',
                'icon' => 'ph:number-circle-two',
            ],
            'chroma_query_documents' => [
                'class' => ChromaQueryDocuments::class,
                'type' => 'read',
                'name' => 'Query Documents',
                'description' => 'Run nearest-neighbor similarity search.',
                'icon' => 'ph:magnifying-glass',
            ],
            'chroma_get_document' => [
                'class' => ChromaGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Retrieve records by IDs or filters.',
                'icon' => 'ph:file-text',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/chroma.md';
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Chroma tool with default or account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @param  array<string, mixed>  $context  Optional context containing an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new $class(new ChromaService(
                apiKey: (string) $creds->get('chroma', 'api_key', '', (string) $account),
                baseUrl: (string) $creds->get('chroma', 'url', 'http://localhost:8000', (string) $account),
                tenant: (string) $creds->get('chroma', 'tenant', 'default_tenant', (string) $account),
                database: (string) $creds->get('chroma', 'database', 'default_database', (string) $account),
            ));
        }

        return new $class(app(ChromaService::class));
    }
}
