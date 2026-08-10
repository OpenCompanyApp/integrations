<?php

namespace OpenCompany\Integrations\JinaAI;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\JinaAI\Tools\JinaAIClassify;
use OpenCompany\Integrations\JinaAI\Tools\JinaAIEmbeddings;
use OpenCompany\Integrations\JinaAI\Tools\JinaAIGround;
use OpenCompany\Integrations\JinaAI\Tools\JinaAIRead;
use OpenCompany\Integrations\JinaAI\Tools\JinaAIRerank;
use OpenCompany\Integrations\JinaAI\Tools\JinaAISearch;
use OpenCompany\Integrations\JinaAI\Tools\JinaAISegment;

/**
 * Tool provider for the Jina AI integration.
 *
 * Defines metadata, credentials, multi-account service resolution, and Search Foundation tools.
 */
class JinaAIToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'jinaai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Jina AI',
            'description' => 'Reader, search, grounding, embeddings, reranking, classification, and segmentation.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:jinaai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Jina AI',
            'description' => 'Search Foundation APIs for reader/search, grounding, embeddings, reranking, classification, and segmentation.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:jinaai',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://jina.ai/en-US/reader/',
        ];
    }

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
                'hint' => 'Overrides the v1 model API endpoint. Reader/search/grounding use their documented Jina hostnames.',
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
            'jinaai_classify' => [
                'class' => JinaAIClassify::class,
                'type' => 'read',
                'name' => 'Classify',
                'description' => 'Classify text or image inputs with zero-shot labels or a trained classifier.',
                'icon' => 'ph:tag',
            ],
            'jinaai_segment' => [
                'class' => JinaAISegment::class,
                'type' => 'read',
                'name' => 'Segment',
                'description' => 'Tokenize or segment long text.',
                'icon' => 'ph:scissors',
            ],
        ];
    }

    /**
     * Path to the JavaScript documentation file.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/jinaai.md';
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

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Jina AI service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool execution context.
     */
    private function resolveService(array $context = []): JinaAIService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new JinaAIService(
                apiKey: $creds->get('jinaai', 'api_key', '', $account),
                baseUrl: $creds->get('jinaai', 'url', 'https://api.jina.ai/v1', $account),
            );
        }

        return app(JinaAIService::class);
    }
}
