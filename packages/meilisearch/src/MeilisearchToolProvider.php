<?php

namespace OpenCompany\Integrations\Meilisearch;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Meilisearch\Tools\MeilisearchListIndexes;
use OpenCompany\Integrations\Meilisearch\Tools\MeilisearchGetIndex;
use OpenCompany\Integrations\Meilisearch\Tools\MeilisearchCreateIndex;
use OpenCompany\Integrations\Meilisearch\Tools\MeilisearchSearchDocuments;
use OpenCompany\Integrations\Meilisearch\Tools\MeilisearchAddDocuments;
use OpenCompany\Integrations\Meilisearch\Tools\MeilisearchGetDocument;
use OpenCompany\Integrations\Meilisearch\Tools\MeilisearchGetHealth;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MeilisearchToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'meilisearch';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Meilisearch',
            'description' => 'Meilisearch integration for Laravel — manage indexes, search and index documents.',
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
            'name' => 'Meilisearch',
            'description' => 'Meilisearch integration for Laravel — manage indexes, search and index documents.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for the Meilisearch integration.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Meilisearch API key',
                'hint' => 'Generate an API key in your Meilisearch instance under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'http://localhost:7700',
                'hint' => 'The URL of your Meilisearch instance (default: <code>http://localhost:7700</code>)',
                'default' => 'http://localhost:7700',
            ],
        ];
    }

    /**
     * Test the connection to the Meilisearch instance.
     *
     * @param  array<string, mixed>  $config  The integration configuration.
     * @return array{success: bool, message?: string, error?: string} The test result.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'http://localhost:7700', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/health');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Meilisearch API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Meilisearch API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'meilisearch_list_indexes' => [
                'class' => MeilisearchListIndexes::class,
                'type' => 'read',
                'name' => 'List Indexes',
                'description' => 'List all indexes in the Meilisearch instance.',
                'icon' => 'ph:list',
            ],
            'meilisearch_get_index' => [
                'class' => MeilisearchGetIndex::class,
                'type' => 'read',
                'name' => 'Get Index',
                'description' => 'Get detailed information about a specific index.',
                'icon' => 'ph:database',
            ],
            'meilisearch_create_index' => [
                'class' => MeilisearchCreateIndex::class,
                'type' => 'write',
                'name' => 'Create Index',
                'description' => 'Create a new index in Meilisearch.',
                'icon' => 'ph:plus-circle',
            ],
            'meilisearch_search_documents' => [
                'class' => MeilisearchSearchDocuments::class,
                'type' => 'read',
                'name' => 'Search Documents',
                'description' => 'Search for documents in an index.',
                'icon' => 'ph:magnifying-glass',
            ],
            'meilisearch_add_documents' => [
                'class' => MeilisearchAddDocuments::class,
                'type' => 'write',
                'name' => 'Add Documents',
                'description' => 'Add or replace documents in an index.',
                'icon' => 'ph:file-plus',
            ],
            'meilisearch_get_document' => [
                'class' => MeilisearchGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Retrieve a single document from an index.',
                'icon' => 'ph:file-text',
            ],
            'meilisearch_get_health' => [
                'class' => MeilisearchGetHealth::class,
                'type' => 'read',
                'name' => 'Get Health',
                'description' => 'Check the health status of the Meilisearch instance.',
                'icon' => 'ph:heartbeat',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/meilisearch.md';
    }

    /**
     * Get the credential fields for the integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Meilisearch URL', 'required' => false, 'default' => 'http://localhost:7700'],
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
     * Create a tool instance with the appropriate service.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  The context for tool creation.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new MeilisearchService(
                apiKey: $creds->get('meilisearch', 'api_key', '', $account),
                baseUrl: $creds->get('meilisearch', 'url', 'http://localhost:7700', $account),
            );

            return new $class($service);
        }

        return new $class(app(MeilisearchService::class));
    }
}
