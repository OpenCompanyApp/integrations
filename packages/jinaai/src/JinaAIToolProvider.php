<?php

namespace OpenCompany\Integrations\JinaAI;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\JinaAI\Tools\JinaAISearch;
use OpenCompany\Integrations\JinaAI\Tools\JinaAIRead;
use OpenCompany\Integrations\JinaAI\Tools\JinaAIGround;
use OpenCompany\Integrations\JinaAI\Tools\JinaAIEmbeddings;
use OpenCompany\Integrations\JinaAI\Tools\JinaAIRerank;

/**
 * JinaAI Tool Provider.
 *
 * Implements ConfigurableIntegration and ToolProvider to expose Jina AI
 * capabilities (search, read, ground, embeddings, rerank) as agent tools
 * within the OpenCompany integration ecosystem.
 */
class JinaAIToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Machine name of the integration.
     */
    public function appName(): string
    {
        return 'jinaai';
    }

    /**
     * Short metadata shown in tool listings.
     *
     * @return array<string, string> Label, description, icon, and logo
     */
    public function appMeta(): array
    {
        return [
            'label' => 'search, read, ground, embeddings, rerank',
            'description' => 'AI search, reader, grounding, embeddings & reranking',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:jinaai',
        ];
    }

    /**
     * Extended metadata for the integration catalog.
     *
     * @return array<string, string> Name, description, icon, logo, category, badge, docs URL
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Jina AI',
            'description' => 'AI-powered search, content extraction, grounding, embeddings, and reranking',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:jinaai',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://jina.ai/api/',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your Jina AI API key',
                'hint' => 'Generate an API key at <code>jina.ai/api-key</code>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.jina.ai/v1',
                'hint' => 'Override only if using a custom Jina AI endpoint',
                'default' => 'https://api.jina.ai/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Jina AI API.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_key and optional url
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.jina.ai/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(15)->post($baseUrl . '/embeddings', [
                'input' => ['test'],
                'model' => 'jina-embeddings-v3',
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Jina AI API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Jina AI API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Tool definitions provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'jinaai_search' => [
                'class' => JinaAISearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Search the web using Jina AI.',
                'icon' => 'ph:magnifying-glass',
            ],
            'jinaai_read' => [
                'class' => JinaAIRead::class,
                'type' => 'read',
                'name' => 'Read',
                'description' => 'Read and extract content from a URL.',
                'icon' => 'ph:article',
            ],
            'jinaai_ground' => [
                'class' => JinaAIGround::class,
                'type' => 'read',
                'name' => 'Ground',
                'description' => 'Ground a statement against provided context.',
                'icon' => 'ph:shield-check',
            ],
            'jinaai_embeddings' => [
                'class' => JinaAIEmbeddings::class,
                'type' => 'read',
                'name' => 'Embeddings',
                'description' => 'Generate text embeddings.',
                'icon' => 'ph:vector-three',
            ],
            'jinaai_rerank' => [
                'class' => JinaAIRerank::class,
                'type' => 'read',
                'name' => 'Rerank',
                'description' => 'Rerank documents by relevance to a query.',
                'icon' => 'ph:sort-ascending',
            ],
        ];
    }

    /**
     * Path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/jinaai.md';
    }

    /**
     * Credential fields required by this integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.jina.ai/v1'],
        ];
    }

    /**
     * Whether this class represents an integration (always true).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  string  $class   Fully-qualified tool class name
     * @param  array<string, mixed>  $context  Context containing optional 'account' key
     * @return Tool Instantiated tool with the appropriate service
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new JinaAIService(
                apiKey: $creds->get('jinaai', 'api_key', '', $account),
                baseUrl: $creds->get('jinaai', 'url', 'https://api.jina.ai/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(JinaAIService::class));
    }
}
