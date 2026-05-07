<?php

namespace OpenCompany\Integrations\AuthZero;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\AuthZero\Tools\AuthZeroCreateUser;
use OpenCompany\Integrations\AuthZero\Tools\AuthZeroGetCurrentUser;
use OpenCompany\Integrations\AuthZero\Tools\AuthZeroGetTenantSettings;
use OpenCompany\Integrations\AuthZero\Tools\AuthZeroGetUser;
use OpenCompany\Integrations\AuthZero\Tools\AuthZeroListConnections;
use OpenCompany\Integrations\AuthZero\Tools\AuthZeroListRoles;
use OpenCompany\Integrations\AuthZero\Tools\AuthZeroListUsers;

/**
 * Tool provider for the Auth0 identity platform integration.
 *
 * Implements {@see ToolProvider} for tool registration and
 * {@see ConfigurableIntegration} for connection testing and config schema.
 */
class AuthZeroToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'auth-zero';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Auth0',
            'description' => 'Identity & authentication platform',
            'icon' => 'ph:shield-check',
            'logo' => 'simple-icons:auth0',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Auth0',
            'description' => 'Identity and authentication platform — manage users, connections, roles, and tenant settings.',
            'icon' => 'ph:shield-check',
            'logo' => 'simple-icons:auth0',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://auth0.com/docs/api/management/v2',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Auth0 Management API access token',
                'hint' => 'Create a token in Auth0 Dashboard → Applications → APIs → Auth0 Management API → "API Explorer" or use a Machine-to-Machine application.',
                'required' => true,
            ],
            [
                'key' => 'domain',
                'type' => 'text',
                'label' => 'Tenant Domain',
                'placeholder' => 'tenant.us.auth0.com',
                'hint' => 'Your Auth0 tenant domain (e.g. <code>my-tenant.us.auth0.com</code>). Do not include <code>https://</code>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Verify the configured Auth0 Management API token against tenant settings.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $domain = $this->normalizeDomain((string) ($config['domain'] ?? ''));

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($domain)) {
            return ['success' => false, 'error' => 'No tenant domain provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://' . $domain . '/api/v2/tenants/settings');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Auth0 tenant at {$domain}.",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => "Auth0 API returned {$response->status()}: " . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'domain' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'auth_zero_list_users' => [
                'class' => AuthZeroListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in the Auth0 tenant with optional search and pagination.',
                'icon' => 'ph:users',
            ],
            'auth_zero_get_user' => [
                'class' => AuthZeroGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Retrieve a single Auth0 user by their ID.',
                'icon' => 'ph:user',
            ],
            'auth_zero_create_user' => [
                'class' => AuthZeroCreateUser::class,
                'type' => 'write',
                'name' => 'Create User',
                'description' => 'Create a new user in Auth0.',
                'icon' => 'ph:user-plus',
            ],
            'auth_zero_list_connections' => [
                'class' => AuthZeroListConnections::class,
                'type' => 'read',
                'name' => 'List Connections',
                'description' => 'List identity connections configured in the Auth0 tenant.',
                'icon' => 'ph:link',
            ],
            'auth_zero_list_roles' => [
                'class' => AuthZeroListRoles::class,
                'type' => 'read',
                'name' => 'List Roles',
                'description' => 'List roles defined in the Auth0 tenant.',
                'icon' => 'ph:shield-check',
            ],
            'auth_zero_get_tenant_settings' => [
                'class' => AuthZeroGetTenantSettings::class,
                'type' => 'read',
                'name' => 'Get Tenant Settings',
                'description' => 'Retrieve the Auth0 tenant settings.',
                'icon' => 'ph:gear',
            ],
            'auth_zero_get_current_user' => [
                'class' => AuthZeroGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Health Check',
                'description' => 'Verify the Auth0 Management API token by retrieving tenant settings.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/auth-zero.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'domain', 'type' => 'text', 'label' => 'Tenant Domain', 'required' => true],
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
            $creds = app(CredentialResolver::class);

            $service = new AuthZeroService(
                accessToken: $creds->get('auth-zero', 'access_token', '', $account),
                domain: $creds->get('auth-zero', 'domain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(AuthZeroService::class));
    }

    /**
     * Normalize configured tenant domains to host-only form.
     */
    private function normalizeDomain(string $domain): string
    {
        $domain = trim($domain);
        if ($domain === '') {
            return '';
        }

        if (str_contains($domain, '://')) {
            $host = parse_url($domain, PHP_URL_HOST);

            return is_string($host) ? rtrim($host, '/') : '';
        }

        return rtrim(explode('/', $domain, 2)[0], '/');
    }
}
