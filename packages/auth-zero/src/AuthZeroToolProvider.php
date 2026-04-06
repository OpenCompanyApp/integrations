<?php

namespace OpenCompany\Integrations\AuthZero;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
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
class AuthZeroToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'auth-zero';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'users, connections, roles, settings',
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

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $domain = rtrim($config['domain'] ?? '', '/');

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
                'name' => 'Get Current User',
                'description' => 'Retrieve the profile of the currently authenticated user / health check.',
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
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new AuthZeroService(
                accessToken: $creds->get('auth-zero', 'access_token', '', $account),
                domain: $creds->get('auth-zero', 'domain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(AuthZeroService::class));
    }
}
