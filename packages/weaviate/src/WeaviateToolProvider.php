<?php

namespace OpenCompany\Integrations\Weaviate;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Weaviate\Tools\WeaviateCreateClass;
use OpenCompany\Integrations\Weaviate\Tools\WeaviateCreateObject;
use OpenCompany\Integrations\Weaviate\Tools\WeaviateGetHealth;
use OpenCompany\Integrations\Weaviate\Tools\WeaviateGetObject;
use OpenCompany\Integrations\Weaviate\Tools\WeaviateGetSchema;
use OpenCompany\Integrations\Weaviate\Tools\WeaviateListSchemas;
use OpenCompany\Integrations\Weaviate\Tools\WeaviateSearchObjects;

class WeaviateToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'weaviate';
    }

    /**
     * Get application metadata for display and categorization.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'schemas, search, objects',
            'description' => 'Vector database',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:weaviate',
        ];
    }

    /**
     * Get integration metadata for the marketplace / integration registry.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Weaviate',
            'description' => 'AI-native vector database for semantic search and data storage',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:weaviate',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://weaviate.io/developers/weaviate/api',
        ];
    }

    /**
     * Get the configuration schema for the Weaviate integration.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Weaviate API key',
                'hint' => 'The Bearer token or API key for authenticating with Weaviate. Leave empty for unauthenticated instances.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'http://localhost:8080/v1',
                'hint' => 'The base URL of your Weaviate instance. Use <code>http://localhost:8080/v1</code> for local, or your Weaviate Cloud URL.',
                'default' => 'http://localhost:8080/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Weaviate instance.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'http://localhost:8080/v1', '/');

        try {
            $service = new WeaviateService(
                apiKey: $apiKey,
                baseUrl: $baseUrl,
            );

            $health = $service->getHealth();

            return [
                'success' => true,
                'message' => "Connected to Weaviate at {$baseUrl}.",
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
     */
    public function tools(): array
    {
        return [
            'weaviate_list_schemas' => [
                'class' => WeaviateListSchemas::class,
                'type' => 'read',
                'name' => 'List Schemas',
                'description' => 'List all schemas (collections) in the Weaviate instance.',
                'icon' => 'ph:list',
            ],
            'weaviate_get_schema' => [
                'class' => WeaviateGetSchema::class,
                'type' => 'read',
                'name' => 'Get Schema',
                'description' => 'Get the schema definition for a specific class.',
                'icon' => 'ph:file-text',
            ],
            'weaviate_create_class' => [
                'class' => WeaviateCreateClass::class,
                'type' => 'write',
                'name' => 'Create Class',
                'description' => 'Create a new class (collection) in the Weaviate schema.',
                'icon' => 'ph:plus-circle',
            ],
            'weaviate_search_objects' => [
                'class' => WeaviateSearchObjects::class,
                'type' => 'read',
                'name' => 'Search Objects',
                'description' => 'Search objects using GraphQL queries.',
                'icon' => 'ph:magnifying-glass',
            ],
            'weaviate_create_object' => [
                'class' => WeaviateCreateObject::class,
                'type' => 'write',
                'name' => 'Create Object',
                'description' => 'Create a new data object in a Weaviate class.',
                'icon' => 'ph:plus',
            ],
            'weaviate_get_object' => [
                'class' => WeaviateGetObject::class,
                'type' => 'read',
                'name' => 'Get Object',
                'description' => 'Retrieve a specific data object by class name and ID.',
                'icon' => 'ph:eye',
            ],
            'weaviate_get_health' => [
                'class' => WeaviateGetHealth::class,
                'type' => 'read',
                'name' => 'Get Health',
                'description' => 'Check the health/liveness of the Weaviate instance.',
                'icon' => 'ph:heartbeat',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/weaviate.md';
    }

    /**
     * Get the credential fields for the integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'Weaviate URL', 'required' => false, 'default' => 'http://localhost:8080/v1'],
        ];
    }

    /**
     * Confirm this class acts as an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool class with the appropriate service instance.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new WeaviateService(
                apiKey: $creds->get('weaviate', 'api_key', '', $account),
                baseUrl: $creds->get('weaviate', 'url', 'http://localhost:8080/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(WeaviateService::class));
    }
}
