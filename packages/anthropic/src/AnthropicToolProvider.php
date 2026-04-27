<?php

namespace OpenCompany\Integrations\Anthropic;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicListMessages;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicCreateMessage;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicListModels;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetModel;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicListWorkspaces;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetWorkspace;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class AnthropicToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'anthropic';
    }

/**
     * Short metadata for UI display.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'messages, models, workspaces',
            'description' => 'Anthropic Claude AI',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:anthropic',
        ];
    }

/**
     * Full integration metadata for the integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Anthropic',
            'description' => 'Anthropic Claude AI — create messages, list models, manage workspaces, and more.',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:anthropic',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://docs.anthropic.com/en/docs',
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
                'placeholder' => 'Enter your Anthropic API key',
                'hint' => 'Find your API key in the <a href="https://console.anthropic.com/settings/keys" target="_blank">Anthropic Console</a> under API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.anthropic.com/v1',
                'hint' => 'Use the default Anthropic API URL, or a compatible proxy URL',
                'default' => 'https://api.anthropic.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Anthropic API.
     *
     * @param  array  $config  Configuration values to test with.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.anthropic.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'anthropic-version' => '2023-06-01',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/models', [
                'limit' => 1,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Anthropic API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? ($json['error'] ?? 'Unknown error');
                return ['success' => false, 'error' => is_string($error) ? "API error: {$error}" : 'API error: ' . json_encode($error)];
            }

            return [
                'success' => true,
                'message' => "Connected to Anthropic API at {$baseUrl}.",
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
     * Return all available Anthropic tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'anthropic_list_messages' => [
                'class' => AnthropicListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages in the Anthropic conversation history.',
                'icon' => 'ph:list',
            ],
            'anthropic_create_message' => [
                'class' => AnthropicCreateMessage::class,
                'type' => 'write',
                'name' => 'Create Message',
                'description' => 'Send a prompt to Claude and receive a response.',
                'icon' => 'ph:chat-circle-text',
            ],
            'anthropic_list_models' => [
                'class' => AnthropicListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available Anthropic AI models.',
                'icon' => 'ph:list',
            ],
            'anthropic_get_model' => [
                'class' => AnthropicGetModel::class,
                'type' => 'read',
                'name' => 'Get Model',
                'description' => 'Get details for a specific Anthropic model.',
                'icon' => 'ph:info',
            ],
            'anthropic_list_workspaces' => [
                'class' => AnthropicListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List Anthropic workspaces.',
                'icon' => 'ph:folders',
            ],
            'anthropic_get_workspace' => [
                'class' => AnthropicGetWorkspace::class,
                'type' => 'read',
                'name' => 'Get Workspace',
                'description' => 'Get details for a specific Anthropic workspace.',
                'icon' => 'ph:folder',
            ],
            'anthropic_get_current_user' => [
                'class' => AnthropicGetCurrentUser::class,
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
        return __DIR__ . '/../lua-docs/anthropic.md';
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
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.anthropic.com/v1'],
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

            $service = new AnthropicService(
                apiKey: $creds->get('anthropic', 'api_key', '', $account),
                baseUrl: $creds->get('anthropic', 'url', 'https://api.anthropic.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(AnthropicService::class));
    }
}
