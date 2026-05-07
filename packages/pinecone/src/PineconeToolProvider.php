<?php

namespace OpenCompany\Integrations\Pinecone;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pinecone\Tools\PineconeConfigureIndex;
use OpenCompany\Integrations\Pinecone\Tools\PineconeListIndexes;
use OpenCompany\Integrations\Pinecone\Tools\PineconeGetIndex;
use OpenCompany\Integrations\Pinecone\Tools\PineconeCreateIndex;
use OpenCompany\Integrations\Pinecone\Tools\PineconeDeleteIndex;
use OpenCompany\Integrations\Pinecone\Tools\PineconeUpsertVectors;
use OpenCompany\Integrations\Pinecone\Tools\PineconeQueryVectors;
use OpenCompany\Integrations\Pinecone\Tools\PineconeFetchVectors;
use OpenCompany\Integrations\Pinecone\Tools\PineconeUpdateVector;
use OpenCompany\Integrations\Pinecone\Tools\PineconeDeleteVectors;
use OpenCompany\Integrations\Pinecone\Tools\PineconeDescribeIndexStats;
use OpenCompany\Integrations\Pinecone\Tools\PineconeListCollections;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class PineconeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
              0 => 'Pinecone REST requests use Api-Key and X-Pinecone-Api-Version headers.',
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




/**
     * Get the integration app name identifier.
     */
    public function appName(): string
    {
        return 'pinecone';
    }

/**
     * Get short metadata for the integration.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Pinecone',
            'description' => 'Vector database',
            'icon' => 'ph:tree-structure',
            'logo' => 'simple-icons:pinecone',
        ];
    }

/**
     * Get full integration metadata for display in the UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Pinecone',
            'description' => 'Vector database for AI applications: store, search, and manage embeddings at scale',
            'icon' => 'ph:tree-structure',
            'logo' => 'simple-icons:pinecone',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.pinecone.io/reference/api',
            'source_url' => 'https://docs.pinecone.io/reference/api',
        ];
    }/**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Pinecone API key',
                'hint' => 'Find your API key in the Pinecone console at <code>https://app.pinecone.io</code> under API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.pinecone.io',
                'hint' => 'Use <code>https://api.pinecone.io</code> for the standard Pinecone API',
                'default' => 'https://api.pinecone.io',
            ],
            [
                'key' => 'api_version',
                'type' => 'text',
                'label' => 'API Version',
                'placeholder' => '2026-04',
                'hint' => 'Date-based Pinecone API version sent as X-Pinecone-Api-Version.',
                'default' => '2026-04',
            ],
        ];
    }

    /**
     * Test the connection to the Pinecone API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  The configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['api_key'] ?? $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.pinecone.io', '/');
        $apiVersion = (string) ($config['api_version'] ?? '2026-04');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Api-Key' => $accessToken,
                'X-Pinecone-Api-Version' => $apiVersion,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/indexes');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Pinecone API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Pinecone API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration values.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
            'api_version' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'pinecone_list_indexes' => [
                'class' => PineconeListIndexes::class,
                'type' => 'read',
                'name' => 'List Indexes',
                'description' => 'List all vector indexes in your Pinecone project.',
                'icon' => 'ph:list',
            ],
            'pinecone_get_index' => [
                'class' => PineconeGetIndex::class,
                'type' => 'read',
                'name' => 'Get Index',
                'description' => 'Get details of a specific vector index.',
                'icon' => 'ph:info',
            ],
            'pinecone_create_index' => [
                'class' => PineconeCreateIndex::class,
                'type' => 'write',
                'name' => 'Create Index',
                'description' => 'Create a new serverless vector index.',
                'icon' => 'ph:plus-circle',
            ],
            'pinecone_configure_index' => [
                'class' => PineconeConfigureIndex::class,
                'type' => 'write',
                'name' => 'Configure Index',
                'description' => 'Configure an existing Pinecone index.',
                'icon' => 'ph:sliders',
            ],
            'pinecone_delete_index' => [
                'class' => PineconeDeleteIndex::class,
                'type' => 'write',
                'name' => 'Delete Index',
                'description' => 'Delete a Pinecone index.',
                'icon' => 'ph:trash',
            ],
            'pinecone_upsert_vectors' => [
                'class' => PineconeUpsertVectors::class,
                'type' => 'write',
                'name' => 'Upsert Vectors',
                'description' => 'Upsert vectors into a Pinecone index.',
                'icon' => 'ph:arrow-up-circle',
            ],
            'pinecone_query_vectors' => [
                'class' => PineconeQueryVectors::class,
                'type' => 'read',
                'name' => 'Query Vectors',
                'description' => 'Search for similar vectors in a Pinecone index.',
                'icon' => 'ph:magnifying-glass',
            ],
            'pinecone_fetch_vectors' => [
                'class' => PineconeFetchVectors::class,
                'type' => 'read',
                'name' => 'Fetch Vectors',
                'description' => 'Fetch vectors by ID from a Pinecone index.',
                'icon' => 'ph:download-simple',
            ],
            'pinecone_update_vector' => [
                'class' => PineconeUpdateVector::class,
                'type' => 'write',
                'name' => 'Update Vector',
                'description' => 'Update vector values or metadata.',
                'icon' => 'ph:pencil',
            ],
            'pinecone_delete_vectors' => [
                'class' => PineconeDeleteVectors::class,
                'type' => 'write',
                'name' => 'Delete Vectors',
                'description' => 'Delete vectors by ID, filter, or namespace.',
                'icon' => 'ph:trash',
            ],
            'pinecone_describe_index_stats' => [
                'class' => PineconeDescribeIndexStats::class,
                'type' => 'read',
                'name' => 'Describe Index Stats',
                'description' => 'Describe vector and namespace statistics for an index.',
                'icon' => 'ph:chart-bar',
            ],
            'pinecone_list_collections' => [
                'class' => PineconeListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List all collections in your Pinecone project.',
                'icon' => 'ph:folders',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pinecone.md';
    }

    /**
     * Get the credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Pinecone API URL', 'required' => false, 'default' => 'https://api.pinecone.io'],
            ['key' => 'api_version', 'type' => 'text', 'label' => 'API Version', 'required' => false, 'default' => '2026-04'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account context.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context including an 'account' key for multi-account.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new PineconeService(
                accessToken: $creds->get('pinecone', 'api_key', $creds->get('pinecone', 'access_token', '', $account), $account),
                baseUrl: $creds->get('pinecone', 'url', 'https://api.pinecone.io', $account),
                apiVersion: $creds->get('pinecone', 'api_version', '2026-04', $account),
            );

            return new $class($service);
        }

        return new $class(app(PineconeService::class));
    }
}
