<?php

namespace OpenCompany\Integrations\Elastic;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Elastic\Tools\ElasticClusterHealth;
use OpenCompany\Integrations\Elastic\Tools\ElasticCreateIndex;
use OpenCompany\Integrations\Elastic\Tools\ElasticGetDocument;
use OpenCompany\Integrations\Elastic\Tools\ElasticGetIndex;
use OpenCompany\Integrations\Elastic\Tools\ElasticIndexDocument;
use OpenCompany\Integrations\Elastic\Tools\ElasticListIndices;
use OpenCompany\Integrations\Elastic\Tools\ElasticSearchDocuments;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ElasticToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'basic',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'username_password',
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

    /**
     * Get the integration app name.
     */
    public function appName(): string
    {
        return 'elastic';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Elastic',
            'description' => 'Elasticsearch integration for Laravel — search, index, and manage documents and indices.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
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
            'name' => 'Elastic',
            'description' => 'Elasticsearch integration for Laravel — search, index, and manage documents and indices.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'data',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for the integration.
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
                'placeholder' => 'Enter your Elasticsearch API key',
                'hint' => 'Use an API key for token-based authentication. Alternatively, provide username and password below.',
                'required' => false,
            ],
            [
                'key' => 'username',
                'type' => 'string',
                'label' => 'Username',
                'placeholder' => 'elastic',
                'hint' => 'Username for Basic authentication. Used when API key is not provided.',
                'required' => false,
            ],
            [
                'key' => 'password',
                'type' => 'secret',
                'label' => 'Password',
                'placeholder' => 'Enter your Elasticsearch password',
                'hint' => 'Password for Basic authentication. Used when API key is not provided.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Elasticsearch URL',
                'placeholder' => 'http://localhost:9200',
                'hint' => 'The base URL of your Elasticsearch cluster (e.g., <code>http://localhost:9200</code> or <code>https://your-cluster.es.cloud.elastic.co</code>)',
                'default' => 'http://localhost:9200',
            ],
        ];
    }

    /**
     * Test the connection to Elasticsearch.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $username = $config['username'] ?? '';
        $password = $config['password'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'http://localhost:9200', '/');

        if (empty($apiKey) && (empty($username) || empty($password))) {
            return ['success' => false, 'error' => 'Provide an API key or username and password.'];
        }

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(10);

            if (! empty($apiKey)) {
                $http = $http->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                ]);
            } else {
                $http = $http->withBasicAuth($username, $password);
            }

            $response = $http->get($baseUrl . '/_cluster/health');
            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Elasticsearch at {$baseUrl}. Check the URL.",
                ];
            }

            $status = $json['status'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Elasticsearch at {$baseUrl}. Cluster status: {$status}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'username' => 'nullable|string',
            'password' => 'nullable|string',
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
            'elastic_list_indices' => [
                'class' => ElasticListIndices::class,
                'type' => 'read',
                'name' => 'List Indices',
                'description' => 'List all indices in the Elasticsearch cluster.',
                'icon' => 'ph:list',
            ],
            'elastic_get_index' => [
                'class' => ElasticGetIndex::class,
                'type' => 'read',
                'name' => 'Get Index',
                'description' => 'Get detailed information about a specific index.',
                'icon' => 'ph:database',
            ],
            'elastic_create_index' => [
                'class' => ElasticCreateIndex::class,
                'type' => 'write',
                'name' => 'Create Index',
                'description' => 'Create a new Elasticsearch index with optional settings.',
                'icon' => 'ph:plus-circle',
            ],
            'elastic_search_documents' => [
                'class' => ElasticSearchDocuments::class,
                'type' => 'read',
                'name' => 'Search Documents',
                'description' => 'Search for documents in an index using a query.',
                'icon' => 'ph:magnifying-glass',
            ],
            'elastic_index_document' => [
                'class' => ElasticIndexDocument::class,
                'type' => 'write',
                'name' => 'Index Document',
                'description' => 'Create or update a document in an index.',
                'icon' => 'ph:file-plus',
            ],
            'elastic_get_document' => [
                'class' => ElasticGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Retrieve a single document by ID.',
                'icon' => 'ph:file-text',
            ],
            'elastic_cluster_health' => [
                'class' => ElasticClusterHealth::class,
                'type' => 'read',
                'name' => 'Cluster Health',
                'description' => 'Get the health status of the Elasticsearch cluster.',
                'icon' => 'ph:heartbeat',
            ],
        ];
    }

    /**
     * Get the path to JavaScript documentation (not used).
     */
    public function scriptDocsPath(): ?string
    {
        return null;
    }

    /**
     * Get the credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => false],
            ['key' => 'username', 'type' => 'string', 'label' => 'Username', 'required' => false],
            ['key' => 'password', 'type' => 'secret', 'label' => 'Password', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'Elasticsearch URL', 'required' => false, 'default' => 'http://localhost:9200'],
        ];
    }

    /**
     * Confirm this is an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the appropriate service.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ElasticService(
                baseUrl: $creds->get('elastic', 'url', 'http://localhost:9200', $account),
                apiKey: $creds->get('elastic', 'api_key', '', $account),
                username: $creds->get('elastic', 'username', '', $account),
                password: $creds->get('elastic', 'password', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ElasticService::class));
    }
}
