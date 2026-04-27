<?php

namespace OpenCompany\Integrations\Aircall;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Aircall\Tools\AircallListCalls;
use OpenCompany\Integrations\Aircall\Tools\AircallGetCall;
use OpenCompany\Integrations\Aircall\Tools\AircallListContacts;
use OpenCompany\Integrations\Aircall\Tools\AircallCreateContact;
use OpenCompany\Integrations\Aircall\Tools\AircallUpdateContact;
use OpenCompany\Integrations\Aircall\Tools\AircallListUsers;
use OpenCompany\Integrations\Aircall\Tools\AircallListNumbers;
use OpenCompany\Integrations\Aircall\Tools\AircallGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class AircallToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'aircall';
    }

/**
     * Get application metadata for UI rendering.
     *
     * @return array{label: string, description: string, icon: string, logo: string}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'calls, contacts, users, numbers',
            'description' => 'Cloud phone system',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:aircall',
        ];
    }

/**
     * Get integration metadata for the integrations catalog.
     *
     * @return array{name: string, description: string, icon: string, logo: string, category: string, badge: string, docs_url: string}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Aircall',
            'description' => 'Cloud-based phone and communication platform',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:aircall',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developer.aircall.io/api-references/',
        ];
    }/**
     * Define the configuration schema for the Aircall integration.
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
                'placeholder' => 'Enter your Aircall OAuth access token',
                'hint' => 'Generate an access token in your Aircall dashboard under "Integrations & API" or via OAuth',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.aircall.io/v1',
                'hint' => 'Use <code>https://api.aircall.io/v1</code> for the standard Aircall API',
                'default' => 'https://api.aircall.io/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Aircall API using the provided configuration.
     *
     * @param  array  $config  Configuration array containing `access_token` and optionally `url`.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.aircall.io/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Aircall API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Aircall API error: {$error}",
                ];
            }

            $userName = ($json['user']['first_name'] ?? '') . ' ' . ($json['user']['last_name'] ?? '');
            $userName = trim($userName) ?: 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Aircall API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the Aircall configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get all available Aircall tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'aircall_list_calls' => [
                'class' => AircallListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List calls with optional filters and pagination.',
                'icon' => 'ph:phone-call',
            ],
            'aircall_get_call' => [
                'class' => AircallGetCall::class,
                'type' => 'read',
                'name' => 'Get Call',
                'description' => 'Retrieve details of a specific call.',
                'icon' => 'ph:phone-call',
            ],
            'aircall_list_contacts' => [
                'class' => AircallListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts with optional search and pagination.',
                'icon' => 'ph:address-book',
            ],
            'aircall_create_contact' => [
                'class' => AircallCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Aircall.',
                'icon' => 'ph:user-plus',
            ],
            'aircall_update_contact' => [
                'class' => AircallUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing contact in Aircall.',
                'icon' => 'ph:pencil-simple',
            ],
            'aircall_list_users' => [
                'class' => AircallListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List all users in the Aircall account.',
                'icon' => 'ph:users',
            ],
            'aircall_list_numbers' => [
                'class' => AircallListNumbers::class,
                'type' => 'read',
                'name' => 'List Numbers',
                'description' => 'List all phone numbers in the Aircall account.',
                'icon' => 'ph:hash',
            ],
            'aircall_get_current_user' => [
                'class' => AircallGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Retrieve the currently authenticated user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/aircall.md';
    }

    /**
     * Get credential field definitions for the Aircall integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.aircall.io/v1'],
        ];
    }

    /**
     * Confirm this class represents an integration provider.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance with optional multi-account context.
     *
     * When an account context is provided, credentials are resolved for that
     * specific account. Otherwise, the default container-bound service is used.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array  $context  Optional context containing an `account` key for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new AircallService(
                accessToken: $creds->get('aircall', 'access_token', '', $account),
                baseUrl: $creds->get('aircall', 'url', 'https://api.aircall.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(AircallService::class));
    }
}
