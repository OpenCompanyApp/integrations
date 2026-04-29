<?php

namespace OpenCompany\Integrations\MistralAI;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MistralAI\Tools\MistralAIChat;
use OpenCompany\Integrations\MistralAI\Tools\MistralAICreateEmbedding;
use OpenCompany\Integrations\MistralAI\Tools\MistralAIListModels;
use OpenCompany\Integrations\MistralAI\Tools\MistralAIFinetune;
use OpenCompany\Integrations\MistralAI\Tools\MistralAIListAgents;
use OpenCompany\Integrations\MistralAI\Tools\MistralAICreateAgent;
use OpenCompany\Integrations\MistralAI\Tools\MistralAIGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MistralAIToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'mistralai';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Mistralai',
            'description' => 'MistralAI integration for Laravel — chat completions, embeddings, model management…',
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
            'name' => 'Mistralai',
            'description' => 'MistralAI integration for Laravel — chat completions, embeddings, model management, fine-tuning, and agent management.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your MistralAI API key',
                'hint' => 'Generate an API key in your <a href="https://console.mistral.ai/api-keys" target="_blank">Mistral console</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.mistral.ai/v1',
                'hint' => 'Use the default MistralAI API URL or a compatible proxy endpoint',
                'default' => 'https://api.mistral.ai/v1',
            ],
        ];
    }

    /**
     * Test the connection to the MistralAI API using the provided config.
     *
     * @param  array<string, mixed>  $config  The configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.mistral.ai/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/models');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach MistralAI API at {$baseUrl}. Check the URL.",
                ];
            }

            $modelCount = count($json['data'] ?? []);

            return [
                'success' => true,
                'message' => "Connected to MistralAI API — {$modelCount} models available.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, mixed>
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
            'mistralai_chat' => [
                'class' => MistralAIChat::class,
                'type' => 'write',
                'name' => 'Chat Completion',
                'description' => 'Generate chat completions using MistralAI models.',
                'icon' => 'ph:chat-circle-text',
            ],
            'mistralai_create_embedding' => [
                'class' => MistralAICreateEmbedding::class,
                'type' => 'write',
                'name' => 'Create Embedding',
                'description' => 'Generate text embeddings using MistralAI embedding models.',
                'icon' => 'ph:vector-three',
            ],
            'mistralai_list_models' => [
                'class' => MistralAIListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available MistralAI models.',
                'icon' => 'ph:list',
            ],
            'mistralai_finetune' => [
                'class' => MistralAIFinetune::class,
                'type' => 'write',
                'name' => 'Fine-tune Model',
                'description' => 'Create a fine-tuning job on MistralAI.',
                'icon' => 'ph:sliders',
            ],
            'mistralai_list_agents' => [
                'class' => MistralAIListAgents::class,
                'type' => 'read',
                'name' => 'List Agents',
                'description' => 'List MistralAI agents.',
                'icon' => 'ph:robot',
            ],
            'mistralai_create_agent' => [
                'class' => MistralAICreateAgent::class,
                'type' => 'write',
                'name' => 'Create Agent',
                'description' => 'Create a new MistralAI agent.',
                'icon' => 'ph:robot',
            ],
            'mistralai_get_current_user' => [
                'class' => MistralAIGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get information about the authenticated MistralAI user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mistralai.md';
    }

    /**
     * Get the credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.mistral.ai/v1'],
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
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with account information.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new MistralAIService(
                apiKey: $creds->get('mistralai', 'api_key', '', $account),
                baseUrl: $creds->get('mistralai', 'url', 'https://api.mistral.ai/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(MistralAIService::class));
    }
}
