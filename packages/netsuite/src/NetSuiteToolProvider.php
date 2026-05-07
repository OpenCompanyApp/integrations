<?php

namespace OpenCompany\Integrations\NetSuite;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\NetSuite\Tools\NetSuiteCreateCustomer;
use OpenCompany\Integrations\NetSuite\Tools\NetSuiteGetCurrentUser;
use OpenCompany\Integrations\NetSuite\Tools\NetSuiteGetCustomer;
use OpenCompany\Integrations\NetSuite\Tools\NetSuiteListCustomers;
use OpenCompany\Integrations\NetSuite\Tools\NetSuiteListInvoices;
use OpenCompany\Integrations\NetSuite\Tools\NetSuiteListItems;
use OpenCompany\Integrations\NetSuite\Tools\NetSuiteListSalesOrders;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class NetSuiteToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'netsuite';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Netsuite',
            'description' => 'NetSuite ERP integration for Laravel — manage customers, invoices, sales orders, and…',
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
            'name' => 'Netsuite',
            'description' => 'NetSuite ERP integration for Laravel — manage customers, invoices, sales orders, and items.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'data',
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
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your NetSuite OAuth 2.0 access token',
                'hint' => 'Generate an OAuth 2.0 access token in your NetSuite account under Setup → Integration → OAuth 2.0',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'REST API Base URL',
                'placeholder' => 'https://1234567.suitetalk.api.netsuite.com/services/rest/record/v1',
                'hint' => 'Your NetSuite SuiteTalk REST API base URL: <code>https://{account_id}.suitetalk.api.netsuite.com/services/rest/record/v1</code>',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the NetSuite API with the given configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? '', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No REST API base URL provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/customers', [
                'limit' => 1,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach NetSuite API at {$baseUrl}. Check the URL and account ID.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to NetSuite API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the integration configuration.
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
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'netsuite_list_customers' => [
                'class' => NetSuiteListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers from NetSuite.',
                'icon' => 'ph:users',
            ],
            'netsuite_get_customer' => [
                'class' => NetSuiteGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get a single customer by ID.',
                'icon' => 'ph:user',
            ],
            'netsuite_create_customer' => [
                'class' => NetSuiteCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new customer in NetSuite.',
                'icon' => 'ph:user-plus',
            ],
            'netsuite_list_invoices' => [
                'class' => NetSuiteListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices from NetSuite.',
                'icon' => 'ph:invoice',
            ],
            'netsuite_list_sales_orders' => [
                'class' => NetSuiteListSalesOrders::class,
                'type' => 'read',
                'name' => 'List Sales Orders',
                'description' => 'List sales orders from NetSuite.',
                'icon' => 'ph:file-text',
            ],
            'netsuite_list_items' => [
                'class' => NetSuiteListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List items (products) from NetSuite.',
                'icon' => 'ph:package',
            ],
            'netsuite_get_current_user' => [
                'class' => NetSuiteGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated NetSuite user profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/netsuite.md';
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'REST API Base URL', 'required' => true],
        ];
    }

    /**
     * Confirm this is an integration (not just a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with account key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the NetSuiteService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): NetSuiteService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new NetSuiteService(
                accessToken: $creds->get('netsuite', 'access_token', '', $account),
                baseUrl: $creds->get('netsuite', 'url', '', $account),
            );
        }

        return app(NetSuiteService::class);
    }
}
