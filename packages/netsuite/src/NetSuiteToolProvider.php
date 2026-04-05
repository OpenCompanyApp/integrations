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

class NetSuiteToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'netsuite';
    }

    /**
     * Get metadata for the application display.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'customers, invoices, sales orders, items',
            'description' => 'ERP & financial management',
            'icon' => 'ph:buildings',
            'logo' => 'simple-icons:oracle',
        ];
    }

    /**
     * Get integration metadata for display in the UI.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'NetSuite',
            'description' => 'Cloud ERP — customers, invoices, sales orders, and inventory management',
            'icon' => 'ph:buildings',
            'logo' => 'simple-icons:oracle',
            'category' => 'erp',
            'badge' => 'verified',
            'docs_url' => 'https://docs.oracle.com/en/cloud/saas/netsuite/ns-online-help/chapter_1540391674.html',
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
