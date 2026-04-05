<?php

namespace OpenCompany\Integrations\RetellAI;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\RetellAI\Tools\RetellAICreateCall;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIGetCall;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIListCalls;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIListAgents;
use OpenCompany\Integrations\RetellAI\Tools\RetellAICreateAgent;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIGetCurrentUser;

class RetellAIToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'retell-ai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'calls, agents, voice',
            'description' => 'AI-powered voice calls',
            'icon' => 'ph:phone-call',
            'logo' => 'simple-icons:retellai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Retell AI',
            'description' => 'AI-powered voice agent platform for phone calls',
            'icon' => 'ph:phone-call',
            'logo' => 'simple-icons:retellai',
            'category' => 'voice',
            'badge' => 'verified',
            'docs_url' => 'https://docs.retellai.com/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Retell AI API key',
                'hint' => 'Find your API key in the Retell AI dashboard under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.retellai.com/v2',
                'hint' => 'Use the default Retell AI API URL unless you have a custom endpoint',
                'default' => 'https://api.retellai.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.retellai.com/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/list-agents');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Retell AI API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Retell AI API at {$baseUrl}.",
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
            'retell_ai_create_call' => [
                'class' => RetellAICreateCall::class,
                'type' => 'write',
                'name' => 'Create Call',
                'description' => 'Create a new AI-powered phone call.',
                'icon' => 'ph:phone-call',
            ],
            'retell_ai_get_call' => [
                'class' => RetellAIGetCall::class,
                'type' => 'read',
                'name' => 'Get Call',
                'description' => 'Retrieve details for a specific phone call.',
                'icon' => 'ph:phone',
            ],
            'retell_ai_list_calls' => [
                'class' => RetellAIListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List phone calls with optional filters.',
                'icon' => 'ph:list',
            ],
            'retell_ai_list_agents' => [
                'class' => RetellAIListAgents::class,
                'type' => 'read',
                'name' => 'List Agents',
                'description' => 'List all configured voice agents.',
                'icon' => 'ph:users',
            ],
            'retell_ai_create_agent' => [
                'class' => RetellAICreateAgent::class,
                'type' => 'write',
                'name' => 'Create Agent',
                'description' => 'Create a new voice AI agent.',
                'icon' => 'ph:user-plus',
            ],
            'retell_ai_get_current_user' => [
                'class' => RetellAIGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Retrieve current account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/retell-ai.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.retellai.com/v2'],
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

            $service = new RetellAIService(
                apiKey: $creds->get('retell-ai', 'api_key', '', $account),
                baseUrl: $creds->get('retell-ai', 'url', 'https://api.retellai.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(RetellAIService::class));
    }
}
