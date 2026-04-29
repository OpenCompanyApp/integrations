<?php

namespace OpenCompany\Integrations\Clerk;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Clerk\Tools\ClerkCreateUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkDeleteUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkGetCurrentUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkGetUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkListOrganizations;
use OpenCompany\Integrations\Clerk\Tools\ClerkListUsers;
use OpenCompany\Integrations\Clerk\Tools\ClerkUpdateUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ClerkToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'clerk';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Clerk',
            'description' => 'Clerk authentication integration for Laravel — manage users, organizations, and…',
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
            'name' => 'Clerk',
            'description' => 'Clerk authentication integration for Laravel — manage users, organizations, and identity.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for this integration.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'secret_key',
                'type' => 'secret',
                'label' => 'Secret Key',
                'placeholder' => 'sk_live_...',
                'hint' => 'Find your Backend API secret key in the Clerk Dashboard under <strong>API Keys</strong>',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Clerk API using the provided config.
     *
     * @param  array  $config  Configuration containing the secret_key.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $secretKey = $config['secret_key'] ?? '';

        if (empty($secretKey)) {
            return ['success' => false, 'error' => 'No secret key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $secretKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.clerk.com/v1/users', [
                'limit' => 1,
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Clerk API successfully.',
                ];
            }

            $error = $response->json('errors.0.message') ?? "HTTP {$response->status()}";

            return [
                'success' => false,
                'error' => "Clerk API error: {$error}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'secret_key' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'clerk_list_users' => [
                'class' => ClerkListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users from Clerk with optional filtering and pagination.',
                'icon' => 'ph:users',
            ],
            'clerk_get_user' => [
                'class' => ClerkGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Retrieve a single Clerk user by ID.',
                'icon' => 'ph:user',
            ],
            'clerk_create_user' => [
                'class' => ClerkCreateUser::class,
                'type' => 'write',
                'name' => 'Create User',
                'description' => 'Create a new user in Clerk.',
                'icon' => 'ph:user-plus',
            ],
            'clerk_update_user' => [
                'class' => ClerkUpdateUser::class,
                'type' => 'write',
                'name' => 'Update User',
                'description' => 'Update an existing Clerk user profile.',
                'icon' => 'ph:pencil',
            ],
            'clerk_delete_user' => [
                'class' => ClerkDeleteUser::class,
                'type' => 'write',
                'name' => 'Delete User',
                'description' => 'Delete a user from Clerk.',
                'icon' => 'ph:trash',
            ],
            'clerk_list_organizations' => [
                'class' => ClerkListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List organizations from Clerk with optional filtering.',
                'icon' => 'ph:buildings',
            ],
            'clerk_get_current_user' => [
                'class' => ClerkGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Health Check',
                'description' => 'Verify Clerk API connectivity by fetching the first user.',
                'icon' => 'ph:heartbeat',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/clerk.md';
    }

    /**
     * Get the credential fields required for this integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'secret_key', 'type' => 'secret', 'label' => 'Secret Key', 'required' => true],
        ];
    }

    /**
     * Indicate this is a full integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the appropriate service.
     *
     * @param  string  $class   The tool class to instantiate.
     * @param  array  $context  Context containing optional account information.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ClerkService(
                secretKey: $creds->get('clerk', 'secret_key', '', $account),
                baseUrl: $creds->get('clerk', 'url', 'https://api.clerk.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ClerkService::class));
    }
}
