<?php

namespace OpenCompany\Integrations\Zuora;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Zuora\Tools\ZuoraListAccounts;
use OpenCompany\Integrations\Zuora\Tools\ZuoraGetAccount;
use OpenCompany\Integrations\Zuora\Tools\ZuoraListSubscriptions;
use OpenCompany\Integrations\Zuora\Tools\ZuoraGetSubscription;
use OpenCompany\Integrations\Zuora\Tools\ZuoraListInvoices;
use OpenCompany\Integrations\Zuora\Tools\ZuoraListPayments;
use OpenCompany\Integrations\Zuora\Tools\ZuoraGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class ZuoraToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Get the integration app name identifier.
     */
    public function appName(): string
    {
        return 'zuora';
    }

/**
     * Get metadata for the app switcher / integration card.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Zuora',
            'description' => 'Subscription billing',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:zuora',
        ];
    }

/**
     * Get integration metadata for the marketplace / settings page.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Zuora',
            'description' => 'Subscription management and billing platform',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:zuora',
            'category' => 'billing',
            'badge' => 'verified',
            'docs_url' => 'https://developer.zuora.com/api-reference/',
        ];
    }/**
     * Get the configuration schema for the settings UI.
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
                'placeholder' => 'Enter your Zuora OAuth 2.0 access token',
                'hint' => 'Generate an OAuth 2.0 token in your Zuora tenant under <strong>Administration → API Keys</strong> or via the OAuth token endpoint',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://rest.zuora.com/v2',
                'hint' => 'Use <code>https://rest.zuora.com/v2</code> for US production, <code>https://rest.eu.zuora.com/v2</code> for EU, or your sandbox URL',
                'default' => 'https://rest.zuora.com/v2',
            ],
        ];
    }

    /**
     * Test the connection to Zuora using the provided configuration.
     *
     * @param  array<string, mixed> $config Configuration values to test
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://rest.zuora.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $user = $response->json('first_name') ?? 'User';

                return [
                    'success' => true,
                    'message' => "Connected to Zuora API as {$user}.",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Zuora API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Get all available Zuora tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'zuora_list_accounts' => [
                'class' => ZuoraListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List Zuora customer accounts.',
                'icon' => 'ph:users',
            ],
            'zuora_get_account' => [
                'class' => ZuoraGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Get details of a specific Zuora account.',
                'icon' => 'ph:user',
            ],
            'zuora_list_subscriptions' => [
                'class' => ZuoraListSubscriptions::class,
                'type' => 'read',
                'name' => 'List Subscriptions',
                'description' => 'List Zuora subscriptions.',
                'icon' => 'ph:repeat',
            ],
            'zuora_get_subscription' => [
                'class' => ZuoraGetSubscription::class,
                'type' => 'read',
                'name' => 'Get Subscription',
                'description' => 'Get details of a specific Zuora subscription.',
                'icon' => 'ph:clipboard-text',
            ],
            'zuora_list_invoices' => [
                'class' => ZuoraListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List Zuora invoices.',
                'icon' => 'ph:file-text',
            ],
            'zuora_list_payments' => [
                'class' => ZuoraListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List Zuora payments.',
                'icon' => 'ph:money',
            ],
            'zuora_get_current_user' => [
                'class' => ZuoraGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Zuora user profile.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zuora.md';
    }

    /**
     * Get the credential fields for quick-connect setup.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://rest.zuora.com/v2'],
        ];
    }

    /**
     * Indicate this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * Supports multi-account setups by resolving credentials for a specific account
     * from the CredentialResolver, or falling back to the app container default.
     *
     * @param  class-string<Tool> $class   The tool class to instantiate
     * @param  array<string, mixed> $context Optional context with 'account' key for multi-account
     * @return Tool The instantiated tool
     */
    public function createTool(string $class, array $context = []): Tool
    {        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ZuoraService, with optional account-specific credentials.
     *
     * @param  array<string, mixed> $context Optional context with 'account' key for multi-account
     * @return ZuoraService The resolved service instance
     */
    private function resolveService(array $context = []): ZuoraService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ZuoraService(
                accessToken: $creds->get('zuora', 'access_token', '', $account),
                baseUrl: $creds->get('zuora', 'base_url', 'https://rest.zuora.com/v2', $account),
            );
        }

        return app(ZuoraService::class);
    }
}
