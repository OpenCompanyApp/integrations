<?php

namespace OpenCompany\Integrations\Wise;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Wise\Tools\WiseCreateTransfer;
use OpenCompany\Integrations\Wise\Tools\WiseGetCurrentUser;
use OpenCompany\Integrations\Wise\Tools\WiseGetProfile;
use OpenCompany\Integrations\Wise\Tools\WiseGetTransfer;
use OpenCompany\Integrations\Wise\Tools\WiseListBalances;
use OpenCompany\Integrations\Wise\Tools\WiseListProfiles;
use OpenCompany\Integrations\Wise\Tools\WiseListTransfers;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class WiseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
              0 => 'api_key',
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
     *
     * @return string
     */
    public function appName(): string
    {
        return 'wise';
    }

/**
     * Get short application metadata for display purposes.
     *
     * @return array
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Wise',
            'description' => 'International money transfers',
            'icon' => 'ph:money',
            'logo' => 'simple-icons:wise',
        ];
    }

/**
     * Get integration metadata for marketplace / settings display.
     *
     * @return array
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Wise',
            'description' => 'International money transfers and multi-currency accounts',
            'icon' => 'ph:money',
            'logo' => 'simple-icons:wise',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.wise.com/api/',
        ];
    }/**
     * Get the configuration schema for Wise credentials.
     *
     * @return array
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Wise API token',
                'hint' => 'Generate an API token in your Wise account settings under API tokens.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API URL',
                'placeholder' => 'https://api.wise.com',
                'hint' => 'Use https://api.wise.com for production or https://api.wise-sandbox.com for sandbox.',
                'default' => 'https://api.wise.com',
            ],
        ];
    }

    /**
     * Test the Wise API connection by fetching the current user.
     *
     * @param array $config Configuration containing api_key and url.
     * @return array Result with success boolean and message or error.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.wise.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/me');

            if (!$response->successful()) {
                $error = $response->json('errors.0.message')
                    ?? $response->json('message')
                    ?? "HTTP {$response->status()}";

                return [
                    'success' => false,
                    'error' => "Wise API error: {$error}",
                ];
            }

            $user = $response->json();
            $name = trim(($user['firstName'] ?? '') . ' ' . ($user['lastName'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Wise API as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array
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
     * @return array
     */
    public function tools(): array
    {
        return [
            'wise_list_profiles' => [
                'class' => WiseListProfiles::class,
                'type' => 'read',
                'name' => 'List Profiles',
                'description' => 'List all Wise profiles for the authenticated user.',
                'icon' => 'ph:user',
            ],
            'wise_get_profile' => [
                'class' => WiseGetProfile::class,
                'type' => 'read',
                'name' => 'Get Profile',
                'description' => 'Get details of a specific Wise profile.',
                'icon' => 'ph:user',
            ],
            'wise_list_balances' => [
                'class' => WiseListBalances::class,
                'type' => 'read',
                'name' => 'List Balances',
                'description' => 'List multi-currency account balances for a profile.',
                'icon' => 'ph:wallet',
            ],
            'wise_list_transfers' => [
                'class' => WiseListTransfers::class,
                'type' => 'read',
                'name' => 'List Transfers',
                'description' => 'List transfers with optional filtering by status or profile.',
                'icon' => 'ph:arrows-left-right',
            ],
            'wise_get_transfer' => [
                'class' => WiseGetTransfer::class,
                'type' => 'read',
                'name' => 'Get Transfer',
                'description' => 'Get details of a specific transfer.',
                'icon' => 'ph:arrows-left-right',
            ],
            'wise_create_transfer' => [
                'class' => WiseCreateTransfer::class,
                'type' => 'write',
                'name' => 'Create Transfer',
                'description' => 'Create a new money transfer between accounts.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'wise_get_current_user' => [
                'class' => WiseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get details of the currently authenticated Wise user.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     *
     * @return string|null
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/wise.md';
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    /**
     * Indicate that this class represents an integration.
     *
     * @return bool
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account.
     *
     * Resolves credentials from CredentialResolver when an account context
     * is provided, supporting multi-account usage.
     *
     * @param string $class   Fully-qualified tool class name.
     * @param array  $context Optional context with 'account' key for multi-account.
     * @return Tool
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new WiseService(
                apiKey: $creds->get('wise', 'api_key', '', $account),
                baseUrl: $creds->get('wise', 'url', 'https://api.wise.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(WiseService::class));
    }
}
