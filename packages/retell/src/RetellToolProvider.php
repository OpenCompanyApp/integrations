<?php

namespace OpenCompany\Integrations\Retell;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Retell\Tools\RetellListCalls;
use OpenCompany\Integrations\Retell\Tools\RetellGetCall;
use OpenCompany\Integrations\Retell\Tools\RetellCreatePhoneCall;
use OpenCompany\Integrations\Retell\Tools\RetellListAgents;
use OpenCompany\Integrations\Retell\Tools\RetellGetAgent;
use OpenCompany\Integrations\Retell\Tools\RetellCreateAgent;
use OpenCompany\Integrations\Retell\Tools\RetellGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class RetellToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'retell';
    }

/**
     * Short metadata shown in tool listings and UI labels.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'calls, agents, phone calls',
            'description' => 'AI voice agents & calls',
            'icon' => 'ph:phone-call',
            'logo' => 'simple-icons:retell',
        ];
    }

/**
     * Full integration metadata for the integrations catalog.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Retell AI',
            'description' => 'AI voice agents and phone call management',
            'icon' => 'ph:phone-call',
            'logo' => 'simple-icons:retell',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://docs.retellai.com/api-reference',
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
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Retell AI API key',
                'hint' => 'Find your API key in the Retell AI dashboard under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.retellai.com',
                'hint' => 'Use <code>https://api.retellai.com</code> for the cloud API, or your custom endpoint',
                'default' => 'https://api.retellai.com',
            ],
        ];
    }

    /**
     * Test the connection to the Retell AI API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.retellai.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

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

    /**
     * Laravel validation rules for the configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Registered tools keyed by tool name.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'retell_list_calls' => [
                'class' => RetellListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List AI voice calls with optional filtering and pagination.',
                'icon' => 'ph:list-bullets',
            ],
            'retell_get_call' => [
                'class' => RetellGetCall::class,
                'type' => 'read',
                'name' => 'Get Call',
                'description' => 'Get details of a specific call.',
                'icon' => 'ph:phone',
            ],
            'retell_create_phone_call' => [
                'class' => RetellCreatePhoneCall::class,
                'type' => 'write',
                'name' => 'Create Phone Call',
                'description' => 'Initiate a new AI-powered phone call.',
                'icon' => 'ph:phone-call',
            ],
            'retell_list_agents' => [
                'class' => RetellListAgents::class,
                'type' => 'read',
                'name' => 'List Agents',
                'description' => 'List all AI voice agents.',
                'icon' => 'ph:users',
            ],
            'retell_get_agent' => [
                'class' => RetellGetAgent::class,
                'type' => 'read',
                'name' => 'Get Agent',
                'description' => 'Get details of a specific AI agent.',
                'icon' => 'ph:user',
            ],
            'retell_create_agent' => [
                'class' => RetellCreateAgent::class,
                'type' => 'write',
                'name' => 'Create Agent',
                'description' => 'Create a new AI voice agent.',
                'icon' => 'ph:user-plus',
            ],
            'retell_get_current_user' => [
                'class' => RetellGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Retell AI user.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/retell.md';
    }

    /**
     * Credential fields for quick-reference.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.retellai.com'],
        ];
    }

    /**
     * Whether this class represents an integration provider.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context with optional 'account' for multi-account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new RetellService(
                accessToken: $creds->get('retell', 'access_token', '', $account),
                baseUrl: $creds->get('retell', 'url', 'https://api.retellai.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(RetellService::class));
    }
}
