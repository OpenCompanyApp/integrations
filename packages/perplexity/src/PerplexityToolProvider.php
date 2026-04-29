<?php

namespace OpenCompany\Integrations\Perplexity;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityChat;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityAsk;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityListModels;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
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
        return 'perplexity';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Perplexity AI',
            'description' => 'AI-powered search and answers',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:perplexity',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Perplexity AI',
            'description' => 'AI-powered search, chat completions, and answers with citations',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:perplexity',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://docs.perplexity.ai/',
        ];
    }    public function configSchema(): array
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
            ])->timeout(10)->get($baseUrl.'/models');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Perplexity API at {$baseUrl}. Check the URL.",
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
                'name' => 'Chat',
                'description' => 'Send messages to Perplexity AI for chat completions with citations.',
                'icon' => 'ph:chat-circle-text',
            ],
            'perplexity_ask' => [
                'class' => PerplexityAsk::class,
                'type' => 'read',
                'name' => 'Ask',
                'description' => 'Ask a question and get an answer with cited sources.',
                'icon' => 'ph:question',
            ],
            'perplexity_list_models' => [
                'class' => PerplexityListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available Perplexity AI models.',
                'icon' => 'ph:list',
            ],
            'perplexity_get_current_user' => [
                'class' => PerplexityGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Current User',
                'description' => 'Get the current authenticated user\'s information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/perplexity.md';
    }    public function credentialFields(): array
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
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new PerplexityService(
                apiKey: $creds->get('perplexity', 'api_key', '', $account),
                baseUrl: $creds->get('perplexity', 'url', 'https://api.perplexity.ai', $account),
            );

            return new $class($service);
        }

        return new $class(app(PerplexityService::class));
    }
}
