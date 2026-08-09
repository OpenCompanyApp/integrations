<?php

namespace OpenCompany\Integrations\Tavily;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Tavily\Tools\TavilyCreateResearchTask;
use OpenCompany\Integrations\Tavily\Tools\TavilyCrawl;
use OpenCompany\Integrations\Tavily\Tools\TavilyExtract;
use OpenCompany\Integrations\Tavily\Tools\TavilyGetResearchTask;
use OpenCompany\Integrations\Tavily\Tools\TavilyGetUsage;
use OpenCompany\Integrations\Tavily\Tools\TavilyMap;
use OpenCompany\Integrations\Tavily\Tools\TavilySearch;

/**
 * Tool catalog and configuration metadata for Tavily.
 *
 * Exposes Tavily's public API endpoints as agent tools and resolves
 * account-specific API keys for multi-account host environments.
 */
class TavilyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'tavily';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Tavily',
            'description' => 'AI search, extraction, crawl, map, and research',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'ph:magnifying-glass',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Tavily',
            'description' => 'AI-optimized web search, extraction, website crawling, site mapping, research tasks, and usage reporting.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'ph:magnifying-glass',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.tavily.com/documentation/api-reference/introduction',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'tvly-YOUR_API_KEY',
                'hint' => 'Create an API key in the Tavily dashboard.',
                'required' => true,
            ],
            [
                'key' => 'project_id',
                'type' => 'text',
                'label' => 'Project ID',
                'placeholder' => 'Optional Tavily project ID',
                'hint' => 'Optional. Sent as X-Project-ID to scope tracking and usage.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.tavily.com',
                'hint' => 'Use https://api.tavily.com unless Tavily provides a dedicated endpoint.',
                'default' => 'https://api.tavily.com',
            ],
        ];
    }

    /**
     * Verify Tavily credentials with the lightweight usage endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.tavily.com'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        $headers = [
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ];

        if (!empty($config['project_id'])) {
            $headers['X-Project-ID'] = (string) $config['project_id'];
        }

        try {
            $response = Http::withHeaders($headers)->timeout(10)->get($baseUrl . '/usage');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => 'Tavily API returned HTTP ' . $response->status() . '.',
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Tavily API at {$baseUrl}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'project_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'tavily_search' => [
                'class' => TavilySearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Execute an AI-optimized web search with optional answer, images, raw content, domain filters, and recency controls.',
                'icon' => 'ph:magnifying-glass',
            ],
            'tavily_extract' => [
                'class' => TavilyExtract::class,
                'type' => 'read',
                'name' => 'Extract',
                'description' => 'Extract clean markdown or text content from one or more URLs.',
                'icon' => 'ph:file-text',
            ],
            'tavily_crawl' => [
                'class' => TavilyCrawl::class,
                'type' => 'read',
                'name' => 'Crawl',
                'description' => 'Crawl a website and extract content from discovered pages.',
                'icon' => 'ph:tree-structure',
            ],
            'tavily_map' => [
                'class' => TavilyMap::class,
                'type' => 'read',
                'name' => 'Map',
                'description' => 'Map a website and return discovered URLs.',
                'icon' => 'ph:map-trifold',
            ],
            'tavily_create_research_task' => [
                'class' => TavilyCreateResearchTask::class,
                'type' => 'read',
                'name' => 'Create Research Task',
                'description' => 'Queue a Tavily Research task for comprehensive multi-source research.',
                'icon' => 'ph:binoculars',
            ],
            'tavily_get_research_task' => [
                'class' => TavilyGetResearchTask::class,
                'type' => 'read',
                'name' => 'Get Research Task',
                'description' => 'Retrieve status or completed content for a Tavily Research task.',
                'icon' => 'ph:clipboard-text',
            ],
            'tavily_get_usage' => [
                'class' => TavilyGetUsage::class,
                'type' => 'read',
                'name' => 'Get Usage',
                'description' => 'Get API key and account credit usage details.',
                'icon' => 'ph:gauge',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/tavily.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'project_id', 'type' => 'text', 'label' => 'Project ID', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.tavily.com'],
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
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): TavilyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new TavilyService(
                apiKey: $creds->get('tavily', 'api_key', '', $account),
                baseUrl: $creds->get('tavily', 'url', 'https://api.tavily.com', $account),
                projectId: $creds->get('tavily', 'project_id', '', $account),
            );
        }

        return app(TavilyService::class);
    }
}
