<?php

namespace OpenCompany\Integrations\MongoDB;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBAggregate;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBDeleteOne;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBFind;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBFindOne;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBGetCurrentUser;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBInsertMany;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBInsertOne;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBListCollections;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBUpdateOne;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MongoDBToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'mongodb';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'MongoDB Atlas',
            'description' => 'MongoDB Atlas database',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:mongodb',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'MongoDB Atlas',
            'description' => 'Query and manage documents in MongoDB Atlas via the Data API',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:mongodb',
            'category' => 'database',
            'badge' => 'verified',
            'docs_url' => 'https://www.mongodb.com/docs/atlas/app-services/data-api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your MongoDB Atlas Data API key',
                'hint' => 'Generate an API key in your MongoDB Atlas project under "App Services" → "Data API"',
                'required' => true,
            ],
            [
                'key' => 'cluster_url',
                'type' => 'url',
                'label' => 'Cluster URL',
                'placeholder' => 'https://data.mongodb-api.com/app/data-xxxxx/endpoint/data/v1',
                'hint' => 'The Data API endpoint URL from your Atlas App Services app. Found in "App Services" → "Data API" → "Endpoint URL".',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $clusterUrl = rtrim($config['cluster_url'] ?? '', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($clusterUrl)) {
            return ['success' => false, 'error' => 'No cluster URL provided'];
        }

        try {
            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->post($clusterUrl . '/action/find', [
                'database' => 'admin',
                'collection' => 'system.version',
                'filter' => [],
                'limit' => 1,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach MongoDB Atlas API at {$clusterUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to MongoDB Atlas Data API at {$clusterUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'cluster_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'mongodb_find' => [
                'class' => MongoDBFind::class,
                'type' => 'read',
                'name' => 'Find Documents',
                'description' => 'Query documents from a MongoDB collection with filters.',
                'icon' => 'ph:magnifying-glass',
            ],
            'mongodb_find_one' => [
                'class' => MongoDBFindOne::class,
                'type' => 'read',
                'name' => 'Find One Document',
                'description' => 'Find a single document in a MongoDB collection.',
                'icon' => 'ph:magnifying-glass',
            ],
            'mongodb_insert_one' => [
                'class' => MongoDBInsertOne::class,
                'type' => 'write',
                'name' => 'Insert Document',
                'description' => 'Insert a single document into a MongoDB collection.',
                'icon' => 'ph:plus',
            ],
            'mongodb_insert_many' => [
                'class' => MongoDBInsertMany::class,
                'type' => 'write',
                'name' => 'Insert Many Documents',
                'description' => 'Insert multiple documents into a MongoDB collection.',
                'icon' => 'ph:plus',
            ],
            'mongodb_update_one' => [
                'class' => MongoDBUpdateOne::class,
                'type' => 'write',
                'name' => 'Update Document',
                'description' => 'Update a single document in a MongoDB collection.',
                'icon' => 'ph:pencil',
            ],
            'mongodb_delete_one' => [
                'class' => MongoDBDeleteOne::class,
                'type' => 'write',
                'name' => 'Delete Document',
                'description' => 'Delete a single document from a MongoDB collection.',
                'icon' => 'ph:trash',
            ],
            'mongodb_aggregate' => [
                'class' => MongoDBAggregate::class,
                'type' => 'read',
                'name' => 'Aggregate',
                'description' => 'Run an aggregation pipeline on a MongoDB collection.',
                'icon' => 'ph:funnel',
            ],
            'mongodb_list_collections' => [
                'class' => MongoDBListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List collections in a MongoDB database.',
                'icon' => 'ph:list',
            ],
            'mongodb_get_current_user' => [
                'class' => MongoDBGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Verify connectivity and get current user info.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mongodb.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'cluster_url', 'type' => 'url', 'label' => 'Cluster URL', 'required' => true],
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

            $service = new MongoDBService(
                apiKey: $creds->get('mongodb', 'api_key', '', $account),
                clusterUrl: $creds->get('mongodb', 'cluster_url', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(MongoDBService::class));
    }
}
