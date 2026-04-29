<?php

namespace OpenCompany\Integrations\Typesense;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Typesense\Tools\TypesenseListCollections;
use OpenCompany\Integrations\Typesense\Tools\TypesenseGetCollection;
use OpenCompany\Integrations\Typesense\Tools\TypesenseCreateCollection;
use OpenCompany\Integrations\Typesense\Tools\TypesenseSearchDocuments;
use OpenCompany\Integrations\Typesense\Tools\TypesenseIndexDocument;
use OpenCompany\Integrations\Typesense\Tools\TypesenseGetDocument;
use OpenCompany\Integrations\Typesense\Tools\TypesenseGetHealth;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TypesenseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'typesense';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Typesense',
            'description' => 'Open-source search engine',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:typesense',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Typesense',
            'description' => 'Fast, open-source search engine for building delightful search experiences',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:typesense',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://typesense.org/docs/api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Typesense API key',
                'hint' => 'Find your API key in the Typesense dashboard or server configuration',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Typesense URL',
                'placeholder' => 'http://localhost:8108',
                'hint' => 'The URL of your Typesense instance (default: <code>http://localhost:8108</code>)',
                'default' => 'http://localhost:8108',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'http://localhost:8108', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-TYPESENSE-API-KEY' => $apiKey,
            ])->timeout(10)->get($baseUrl . '/health');

            $json = $response->json();

            if ($response->successful() && ($json['ok'] ?? false) === true) {
                return [
                    'success' => true,
                    'message' => "Connected to Typesense at {$baseUrl}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Typesense health check failed at {$baseUrl}. Status: {$response->status()}",
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
            'typesense_list_collections' => [
                'class' => TypesenseListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List all collections in the Typesense instance.',
                'icon' => 'ph:folder',
            ],
            'typesense_get_collection' => [
                'class' => TypesenseGetCollection::class,
                'type' => 'read',
                'name' => 'Get Collection',
                'description' => 'Get details of a specific collection.',
                'icon' => 'ph:folder-open',
            ],
            'typesense_create_collection' => [
                'class' => TypesenseCreateCollection::class,
                'type' => 'write',
                'name' => 'Create Collection',
                'description' => 'Create a new collection with a schema.',
                'icon' => 'ph:folder-plus',
            ],
            'typesense_search_documents' => [
                'class' => TypesenseSearchDocuments::class,
                'type' => 'read',
                'name' => 'Search Documents',
                'description' => 'Search for documents in a collection.',
                'icon' => 'ph:magnifying-glass',
            ],
            'typesense_index_document' => [
                'class' => TypesenseIndexDocument::class,
                'type' => 'write',
                'name' => 'Index Document',
                'description' => 'Index (create or update) a document in a collection.',
                'icon' => 'ph:plus-circle',
            ],
            'typesense_get_document' => [
                'class' => TypesenseGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Retrieve a single document by ID.',
                'icon' => 'ph:file-text',
            ],
            'typesense_get_health' => [
                'class' => TypesenseGetHealth::class,
                'type' => 'read',
                'name' => 'Get Health',
                'description' => 'Check the health of the Typesense instance.',
                'icon' => 'ph:heartbeat',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/typesense.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Typesense URL', 'required' => false, 'default' => 'http://localhost:8108'],
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

            $service = new TypesenseService(
                apiKey: $creds->get('typesense', 'api_key', '', $account),
                baseUrl: $creds->get('typesense', 'url', 'http://localhost:8108', $account),
            );

            return new $class($service);
        }

        return new $class(app(TypesenseService::class));
    }
}
