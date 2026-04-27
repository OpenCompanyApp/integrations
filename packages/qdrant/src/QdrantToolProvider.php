<?php

namespace OpenCompany\Integrations\Qdrant;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Qdrant\Tools\QdrantListCollections;
use OpenCompany\Integrations\Qdrant\Tools\QdrantGetCollection;
use OpenCompany\Integrations\Qdrant\Tools\QdrantCreateCollection;
use OpenCompany\Integrations\Qdrant\Tools\QdrantSearch;
use OpenCompany\Integrations\Qdrant\Tools\QdrantUpsertPoints;
use OpenCompany\Integrations\Qdrant\Tools\QdrantGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class QdrantToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'qdrant';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'collections, search, upsert, cluster',
            'description' => 'Vector database',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:qdrant',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Qdrant',
            'description' => 'High-performance vector similarity search engine',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:qdrant',
            'category' => 'database',
            'badge' => 'verified',
            'docs_url' => 'https://qdrant.tech/documentation/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Qdrant API key',
                'hint' => 'Generate an API key in your Qdrant Cloud dashboard under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Cluster URL',
                'placeholder' => 'https://your-cluster-url.qdrant.tech:6333',
                'hint' => 'Your Qdrant cluster REST API URL. Find it in the Qdrant Cloud dashboard.',
                'default' => 'https://your-cluster-url.qdrant.tech:6333',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://your-cluster-url.qdrant.tech:6333', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/cluster');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Qdrant API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Qdrant cluster at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
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
            'qdrant_list_collections' => [
                'class' => QdrantListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List all vector collections in the Qdrant cluster.',
                'icon' => 'ph:folders',
            ],
            'qdrant_get_collection' => [
                'class' => QdrantGetCollection::class,
                'type' => 'read',
                'name' => 'Get Collection',
                'description' => 'Get detailed information about a specific collection.',
                'icon' => 'ph:folder-open',
            ],
            'qdrant_create_collection' => [
                'class' => QdrantCreateCollection::class,
                'type' => 'write',
                'name' => 'Create Collection',
                'description' => 'Create a new vector collection.',
                'icon' => 'ph:folder-plus',
            ],
            'qdrant_search' => [
                'class' => QdrantSearch::class,
                'type' => 'read',
                'name' => 'Search Points',
                'description' => 'Search for similar vectors in a collection.',
                'icon' => 'ph:magnifying-glass',
            ],
            'qdrant_upsert_points' => [
                'class' => QdrantUpsertPoints::class,
                'type' => 'write',
                'name' => 'Upsert Points',
                'description' => 'Insert or update points (vectors) in a collection.',
                'icon' => 'ph:arrow-up-circle',
            ],
            'qdrant_get_current_user' => [
                'class' => QdrantGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Cluster Info',
                'description' => 'Get information about the Qdrant cluster.',
                'icon' => 'ph:info',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/qdrant.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Cluster URL', 'required' => false, 'default' => 'https://your-cluster-url.qdrant.tech:6333'],
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

            $service = new QdrantService(
                apiKey: $creds->get('qdrant', 'api_key', '', $account),
                baseUrl: $creds->get('qdrant', 'url', 'https://your-cluster-url.qdrant.tech:6333', $account),
            );

            return new $class($service);
        }

        return new $class(app(QdrantService::class));
    }
}
