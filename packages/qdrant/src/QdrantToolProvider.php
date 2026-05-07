<?php

namespace OpenCompany\Integrations\Qdrant;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Qdrant\Tools\QdrantClearPayload;
use OpenCompany\Integrations\Qdrant\Tools\QdrantCountPoints;
use OpenCompany\Integrations\Qdrant\Tools\QdrantCreateCollection;
use OpenCompany\Integrations\Qdrant\Tools\QdrantCreatePayloadIndex;
use OpenCompany\Integrations\Qdrant\Tools\QdrantCreateSnapshot;
use OpenCompany\Integrations\Qdrant\Tools\QdrantDeleteCollection;
use OpenCompany\Integrations\Qdrant\Tools\QdrantDeletePayload;
use OpenCompany\Integrations\Qdrant\Tools\QdrantDeletePayloadIndex;
use OpenCompany\Integrations\Qdrant\Tools\QdrantDeletePoints;
use OpenCompany\Integrations\Qdrant\Tools\QdrantGetClusterInfo;
use OpenCompany\Integrations\Qdrant\Tools\QdrantGetCollection;
use OpenCompany\Integrations\Qdrant\Tools\QdrantListAliases;
use OpenCompany\Integrations\Qdrant\Tools\QdrantListCollectionAliases;
use OpenCompany\Integrations\Qdrant\Tools\QdrantListCollections;
use OpenCompany\Integrations\Qdrant\Tools\QdrantListSnapshots;
use OpenCompany\Integrations\Qdrant\Tools\QdrantQueryPoints;
use OpenCompany\Integrations\Qdrant\Tools\QdrantRetrievePoints;
use OpenCompany\Integrations\Qdrant\Tools\QdrantScrollPoints;
use OpenCompany\Integrations\Qdrant\Tools\QdrantSearch;
use OpenCompany\Integrations\Qdrant\Tools\QdrantSetPayload;
use OpenCompany\Integrations\Qdrant\Tools\QdrantUpdateAliases;
use OpenCompany\Integrations\Qdrant\Tools\QdrantUpsertPoints;

/**
 * Tool provider for the Qdrant integration.
 *
 * Defines Qdrant REST tools, catalog metadata, credentials, and multi-account service resolution.
 */
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
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
        return 'qdrant';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Qdrant',
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
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://api.qdrant.tech/api-reference',
        ];
    }

    public function configSchema(): array
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
            'qdrant_delete_collection' => [
                'class' => QdrantDeleteCollection::class,
                'type' => 'write',
                'name' => 'Delete Collection',
                'description' => 'Delete a collection and all of its points.',
                'icon' => 'ph:folder-minus',
            ],
            'qdrant_search' => [
                'class' => QdrantSearch::class,
                'type' => 'read',
                'name' => 'Search Points',
                'description' => 'Search for similar vectors in a collection.',
                'icon' => 'ph:magnifying-glass',
            ],
            'qdrant_query_points' => [
                'class' => QdrantQueryPoints::class,
                'type' => 'read',
                'name' => 'Query Points',
                'description' => 'Use the modern Qdrant Query API.',
                'icon' => 'ph:graph',
            ],
            'qdrant_retrieve_points' => [
                'class' => QdrantRetrievePoints::class,
                'type' => 'read',
                'name' => 'Retrieve Points',
                'description' => 'Retrieve points by ids.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'qdrant_scroll_points' => [
                'class' => QdrantScrollPoints::class,
                'type' => 'read',
                'name' => 'Scroll Points',
                'description' => 'Scroll points with filters and pagination.',
                'icon' => 'ph:arrows-down-up',
            ],
            'qdrant_count_points' => [
                'class' => QdrantCountPoints::class,
                'type' => 'read',
                'name' => 'Count Points',
                'description' => 'Count points matching an optional filter.',
                'icon' => 'ph:hash',
            ],
            'qdrant_upsert_points' => [
                'class' => QdrantUpsertPoints::class,
                'type' => 'write',
                'name' => 'Upsert Points',
                'description' => 'Insert or update points (vectors) in a collection.',
                'icon' => 'ph:arrow-up-circle',
            ],
            'qdrant_delete_points' => [
                'class' => QdrantDeletePoints::class,
                'type' => 'write',
                'name' => 'Delete Points',
                'description' => 'Delete points by ids or filter.',
                'icon' => 'ph:selection-minus',
            ],
            'qdrant_set_payload' => [
                'class' => QdrantSetPayload::class,
                'type' => 'write',
                'name' => 'Set Payload',
                'description' => 'Set payload values on selected points.',
                'icon' => 'ph:tag',
            ],
            'qdrant_delete_payload' => [
                'class' => QdrantDeletePayload::class,
                'type' => 'write',
                'name' => 'Delete Payload',
                'description' => 'Delete payload keys from selected points.',
                'icon' => 'ph:tag-simple-x',
            ],
            'qdrant_clear_payload' => [
                'class' => QdrantClearPayload::class,
                'type' => 'write',
                'name' => 'Clear Payload',
                'description' => 'Clear all payload from selected points.',
                'icon' => 'ph:eraser',
            ],
            'qdrant_create_payload_index' => [
                'class' => QdrantCreatePayloadIndex::class,
                'type' => 'write',
                'name' => 'Create Payload Index',
                'description' => 'Create a payload index for filtering.',
                'icon' => 'ph:funnel',
            ],
            'qdrant_delete_payload_index' => [
                'class' => QdrantDeletePayloadIndex::class,
                'type' => 'write',
                'name' => 'Delete Payload Index',
                'description' => 'Delete a payload index.',
                'icon' => 'ph:funnel-x',
            ],
            'qdrant_get_cluster_info' => [
                'class' => QdrantGetClusterInfo::class,
                'type' => 'read',
                'name' => 'Get Cluster Info',
                'description' => 'Get information about the Qdrant cluster.',
                'icon' => 'ph:info',
            ],
            'qdrant_list_aliases' => [
                'class' => QdrantListAliases::class,
                'type' => 'read',
                'name' => 'List Aliases',
                'description' => 'List Qdrant collection aliases.',
                'icon' => 'ph:link',
            ],
            'qdrant_list_collection_aliases' => [
                'class' => QdrantListCollectionAliases::class,
                'type' => 'read',
                'name' => 'List Collection Aliases',
                'description' => 'List aliases for one collection.',
                'icon' => 'ph:link-simple',
            ],
            'qdrant_update_aliases' => [
                'class' => QdrantUpdateAliases::class,
                'type' => 'write',
                'name' => 'Update Aliases',
                'description' => 'Atomically create, delete, or rename collection aliases.',
                'icon' => 'ph:arrows-left-right',
            ],
            'qdrant_list_snapshots' => [
                'class' => QdrantListSnapshots::class,
                'type' => 'read',
                'name' => 'List Snapshots',
                'description' => 'List snapshots for a collection.',
                'icon' => 'ph:camera',
            ],
            'qdrant_create_snapshot' => [
                'class' => QdrantCreateSnapshot::class,
                'type' => 'write',
                'name' => 'Create Snapshot',
                'description' => 'Create a collection snapshot.',
                'icon' => 'ph:camera-plus',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/qdrant.md';
    }

    public function credentialFields(): array
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
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Qdrant service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool execution context.
     */
    private function resolveService(array $context = []): QdrantService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new QdrantService(
                apiKey: $creds->get('qdrant', 'api_key', '', $account),
                baseUrl: $creds->get('qdrant', 'url', 'https://your-cluster-url.qdrant.tech:6333', $account),
            );
        }

        return app(QdrantService::class);
    }
}
