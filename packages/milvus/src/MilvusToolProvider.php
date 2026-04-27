<?php

namespace OpenCompany\Integrations\Milvus;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Milvus\Tools\MilvusListCollections;
use OpenCompany\Integrations\Milvus\Tools\MilvusGetCollection;
use OpenCompany\Integrations\Milvus\Tools\MilvusCreateCollection;
use OpenCompany\Integrations\Milvus\Tools\MilvusInsertDocuments;
use OpenCompany\Integrations\Milvus\Tools\MilvusSearchDocuments;
use OpenCompany\Integrations\Milvus\Tools\MilvusGetCollectionStats;
use OpenCompany\Integrations\Milvus\Tools\MilvusGetHealth;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MilvusToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
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
        return 'milvus';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'collections, documents, search',
            'description' => 'Vector database',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:milvus',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Milvus',
            'description' => 'High-performance vector database for storing, indexing and searching embeddings at scale',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:milvus',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://milvus.io/docs',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Milvus API key',
                'hint' => 'The API key for authenticating with your Milvus instance',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Milvus API URL',
                'placeholder' => 'https://api.milvus.io/v1',
                'hint' => 'The base URL of your Milvus API',
                'default' => 'https://api.milvus.io/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.milvus.io/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/health');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Milvus server at {$baseUrl}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Milvus server returned status {$response->status()}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => "Could not reach Milvus server: {$e->getMessage()}"];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'milvus_list_collections' => [
                'class' => MilvusListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List all vector collections in Milvus.',
                'icon' => 'ph:list',
            ],
            'milvus_get_collection' => [
                'class' => MilvusGetCollection::class,
                'type' => 'read',
                'name' => 'Get Collection',
                'description' => 'Get details of a specific collection.',
                'icon' => 'ph:folder-open',
            ],
            'milvus_create_collection' => [
                'class' => MilvusCreateCollection::class,
                'type' => 'write',
                'name' => 'Create Collection',
                'description' => 'Create a new vector collection.',
                'icon' => 'ph:folder-plus',
            ],
            'milvus_insert_documents' => [
                'class' => MilvusInsertDocuments::class,
                'type' => 'write',
                'name' => 'Insert Documents',
                'description' => 'Insert documents with vectors into a collection.',
                'icon' => 'ph:file-plus',
            ],
            'milvus_search_documents' => [
                'class' => MilvusSearchDocuments::class,
                'type' => 'read',
                'name' => 'Search Documents',
                'description' => 'Search for similar documents using vector queries.',
                'icon' => 'ph:magnifying-glass',
            ],
            'milvus_get_collection_stats' => [
                'class' => MilvusGetCollectionStats::class,
                'type' => 'read',
                'name' => 'Get Collection Stats',
                'description' => 'Get statistics for a collection including row count.',
                'icon' => 'ph:chart-bar',
            ],
            'milvus_get_health' => [
                'class' => MilvusGetHealth::class,
                'type' => 'read',
                'name' => 'Get Health',
                'description' => 'Check the health status of the Milvus server.',
                'icon' => 'ph:heartbeat',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/milvus.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Milvus API URL', 'required' => false, 'default' => 'https://api.milvus.io/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new MilvusService(
                apiKey: $creds->get('milvus', 'api_key', '', $account),
                baseUrl: $creds->get('milvus', 'url', 'https://api.milvus.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(MilvusService::class));
    }
}
