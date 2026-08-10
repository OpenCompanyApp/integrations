<?php

namespace OpenCompany\Integrations\Perplexity;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityAgent;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityAsk;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityChat;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityContextualizedEmbeddings;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityCreateAsyncSonar;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityEmbeddings;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityGetAsyncSonar;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityListModels;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityListAsyncSonar;
use OpenCompany\Integrations\Perplexity\Tools\PerplexitySearch;

/**
 * Tool provider for the Perplexity integration.
 *
 * Defines Sonar, Search, Agent, and Embeddings tools plus credential setup and multi-account resolution.
 */
class PerplexityToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'perplexity';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Perplexity',
            'description' => 'Sonar answers, web search, agents, and embeddings.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:perplexity',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Perplexity',
            'description' => 'Sonar chat completions, web search, async research, Agent API responses, and embeddings.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:perplexity',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.perplexity.ai/api-reference/sonar-post',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Perplexity API key',
                'hint' => 'Generate an API key in your Perplexity account settings under "API"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.perplexity.ai',
                'hint' => 'Use <code>https://api.perplexity.ai</code> for the default endpoint',
                'default' => 'https://api.perplexity.ai',
            ],
        ];
    }

    /**
     * Verify Perplexity credentials with the documented models endpoint.
     *
     * @param  array<string, mixed>  $config  Credential form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.perplexity.ai', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/v1/models');

            if (! $response->successful()) {
                return [
                    'success' => false,
                    'error' => "Perplexity API returned HTTP {$response->status()}. Check your API key and URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Perplexity API at {$baseUrl}.",
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
            'perplexity_chat' => [
                'class' => PerplexityChat::class,
                'type' => 'read',
                'name' => 'Sonar Chat',
                'description' => 'Create a Sonar chat completion with citations and search metadata.',
                'icon' => 'ph:chat-circle-text',
            ],
            'perplexity_ask' => [
                'class' => PerplexityAsk::class,
                'type' => 'read',
                'name' => 'Ask',
                'description' => 'Ask a one-shot question through Sonar chat.',
                'icon' => 'ph:question',
            ],
            'perplexity_search' => [
                'class' => PerplexitySearch::class,
                'type' => 'read',
                'name' => 'Search Web',
                'description' => 'Search the web and retrieve relevant page contents.',
                'icon' => 'ph:magnifying-glass',
            ],
            'perplexity_create_async_sonar' => [
                'class' => PerplexityCreateAsyncSonar::class,
                'type' => 'read',
                'name' => 'Create Async Sonar',
                'description' => 'Submit a long-running asynchronous Sonar request.',
                'icon' => 'ph:hourglass-high',
            ],
            'perplexity_list_async_sonar' => [
                'class' => PerplexityListAsyncSonar::class,
                'type' => 'read',
                'name' => 'List Async Sonar',
                'description' => 'List asynchronous Sonar requests.',
                'icon' => 'ph:list-checks',
            ],
            'perplexity_get_async_sonar' => [
                'class' => PerplexityGetAsyncSonar::class,
                'type' => 'read',
                'name' => 'Get Async Sonar',
                'description' => 'Get one asynchronous Sonar request by id.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'perplexity_agent' => [
                'class' => PerplexityAgent::class,
                'type' => 'read',
                'name' => 'Agent Response',
                'description' => 'Create a response with the Perplexity Agent API.',
                'icon' => 'ph:sparkle',
            ],
            'perplexity_embeddings' => [
                'class' => PerplexityEmbeddings::class,
                'type' => 'read',
                'name' => 'Embeddings',
                'description' => 'Create embeddings for one or more texts.',
                'icon' => 'ph:circles-three-plus',
            ],
            'perplexity_contextualized_embeddings' => [
                'class' => PerplexityContextualizedEmbeddings::class,
                'type' => 'read',
                'name' => 'Contextualized Embeddings',
                'description' => 'Create contextualized embeddings for grouped document chunks.',
                'icon' => 'ph:brackets-square',
            ],
            'perplexity_list_models' => [
                'class' => PerplexityListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List Agent API models.',
                'icon' => 'ph:list',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/perplexity.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.perplexity.ai'],
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
     * Resolve the Perplexity service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool execution context.
     */
    private function resolveService(array $context = []): PerplexityService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new PerplexityService(
                apiKey: $creds->get('perplexity', 'api_key', '', $account),
                baseUrl: $creds->get('perplexity', 'url', 'https://api.perplexity.ai', $account),
            );
        }

        return app(PerplexityService::class);
    }
}
