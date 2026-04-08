<?php

namespace OpenCompany\Integrations\Chroma;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Chroma\Tools\ChromaListCollections;
use OpenCompany\Integrations\Chroma\Tools\ChromaGetCollection;
use OpenCompany\Integrations\Chroma\Tools\ChromaCreateCollection;
use OpenCompany\Integrations\Chroma\Tools\ChromaAddDocuments;
use OpenCompany\Integrations\Chroma\Tools\ChromaQueryDocuments;
use OpenCompany\Integrations\Chroma\Tools\ChromaGetDocument;
use OpenCompany\Integrations\Chroma\Tools\ChromaGetHealth;

class ChromaToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'chroma';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'collections, documents, queries',
            'description' => 'Vector database',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:chroma',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Chroma',
            'description' => 'Open-source vector database for storing and querying embeddings',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:chroma',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.trychroma.com/docs/overview/introduction',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Chroma API key',
                'hint' => 'The API key for authenticating with your Chroma server',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Chroma Server URL',
                'placeholder' => 'http://localhost:8000/api/v1',
                'hint' => 'The base URL of your Chroma server API',
                'default' => 'http://localhost:8000/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'http://localhost:8000/api/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/heartbeat');

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
        } catch (\Exception $e) {
            return ['success' => false, 'error' => "Could not reach Chroma server: {$e->getMessage()}"];
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
            'chroma_list_collections' => [
                'class' => ChromaListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List all vector collections in Chroma.',
                'icon' => 'ph:list',
            ],
            'chroma_get_collection' => [
                'class' => ChromaGetCollection::class,
                'type' => 'read',
                'name' => 'Get Collection',
                'description' => 'Get details of a specific collection.',
                'icon' => 'ph:folder-open',
            ],
            'chroma_create_collection' => [
                'class' => ChromaCreateCollection::class,
                'type' => 'write',
                'name' => 'Create Collection',
                'description' => 'Create a new vector collection.',
                'icon' => 'ph:folder-plus',
            ],
            'chroma_add_documents' => [
                'class' => ChromaAddDocuments::class,
                'type' => 'write',
                'name' => 'Add Documents',
                'description' => 'Add documents with embeddings to a collection.',
                'icon' => 'ph:file-plus',
            ],
            'chroma_query_documents' => [
                'class' => ChromaQueryDocuments::class,
                'type' => 'read',
                'name' => 'Query Documents',
                'description' => 'Search for similar documents using query embeddings.',
                'icon' => 'ph:magnifying-glass',
            ],
            'chroma_get_document' => [
                'class' => ChromaGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Retrieve documents by ID from a collection.',
                'icon' => 'ph:file-text',
            ],
            'chroma_get_health' => [
                'class' => ChromaGetHealth::class,
                'type' => 'read',
                'name' => 'Get Health',
                'description' => 'Check the health status of the Chroma server.',
                'icon' => 'ph:heartbeat',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/chroma.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Chroma Server URL', 'required' => false, 'default' => 'http://localhost:8000/api/v1'],
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

            $service = new ChromaService(
                apiKey: $creds->get('chroma', 'api_key', '', $account),
                baseUrl: $creds->get('chroma', 'url', 'http://localhost:8000/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ChromaService::class));
    }
}
