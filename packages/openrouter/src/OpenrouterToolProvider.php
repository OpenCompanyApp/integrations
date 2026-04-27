<?php

namespace OpenCompany\Integrations\Openrouter;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListModels;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterCreateCompletion;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListGenerations;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetGeneration;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListApiKeys;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetUsage;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class OpenrouterToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * The application name used for registration.
     */
    public function appName(): string
    {
        return 'openrouter';
    }

/**
     * Short metadata for UI display.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'models, completions, generations',
            'description' => 'OpenRouter AI Gateway',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:openrouter',
        ];
    }

/**
     * Full integration metadata for the integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'OpenRouter',
            'description' => 'OpenRouter AI Gateway — access hundreds of AI models through a single API, manage generations, keys, and usage.',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:openrouter',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://openrouter.ai/docs/api-reference',
        ];
    }/**
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
                'placeholder' => 'Enter your OpenRouter API key',
                'hint' => 'Find your API key in the <a href="https://openrouter.ai/settings/keys" target="_blank">OpenRouter Settings</a> under API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://openrouter.ai/api/v1',
                'hint' => 'Use the default OpenRouter API URL, or a compatible proxy URL',
                'default' => 'https://openrouter.ai/api/v1',
            ],
        ];
    }

    /**
     * Test the connection to the OpenRouter API.
     *
     * @param  array  $config  Configuration values to test with.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://openrouter.ai/api/v1', '/');

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
                    'error' => "Could not reach OpenRouter API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? ($json['error'] ?? 'Unknown error');
                return ['success' => false, 'error' => is_string($error) ? "API error: {$error}" : 'API error: ' . json_encode($error)];
            }

            return [
                'success' => true,
                'message' => "Connected to OpenRouter API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all available OpenRouter tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'openrouter_list_models' => [
                'class' => OpenrouterListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available AI models on OpenRouter.',
                'icon' => 'ph:list',
            ],
            'openrouter_create_completion' => [
                'class' => OpenrouterCreateCompletion::class,
                'type' => 'write',
                'name' => 'Create Completion',
                'description' => 'Create a chat completion using any OpenRouter model.',
                'icon' => 'ph:chat-circle-text',
            ],
            'openrouter_list_generations' => [
                'class' => OpenrouterListGenerations::class,
                'type' => 'read',
                'name' => 'List Generations',
                'description' => 'List generation records from OpenRouter.',
                'icon' => 'ph:list',
            ],
            'openrouter_get_generation' => [
                'class' => OpenrouterGetGeneration::class,
                'type' => 'read',
                'name' => 'Get Generation',
                'description' => 'Get details for a specific OpenRouter generation.',
                'icon' => 'ph:info',
            ],
            'openrouter_list_api_keys' => [
                'class' => OpenrouterListApiKeys::class,
                'type' => 'read',
                'name' => 'List API Keys',
                'description' => 'List API keys for the OpenRouter account.',
                'icon' => 'ph:key',
            ],
            'openrouter_get_usage' => [
                'class' => OpenrouterGetUsage::class,
                'type' => 'read',
                'name' => 'Get Usage',
                'description' => 'Get usage statistics for the OpenRouter account.',
                'icon' => 'ph:chart-bar',
            ],
            'openrouter_get_current_user' => [
                'class' => OpenrouterGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/openrouter.md';
    }

    /**
     * Credential fields required for multi-account setup.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://openrouter.ai/api/v1'],
        ];
    }

    /**
     * Confirm this provider is an integration (not just standalone tools).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array  $context  Context containing optional 'account' key for multi-account.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new OpenrouterService(
                apiKey: $creds->get('openrouter', 'api_key', '', $account),
                baseUrl: $creds->get('openrouter', 'url', 'https://openrouter.ai/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(OpenrouterService::class));
    }
}
