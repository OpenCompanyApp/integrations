<?php

namespace OpenCompany\Integrations\BigCommerce;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListProducts;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceGetProduct;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceCreateProduct;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListOrders;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceGetOrder;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListCustomers;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class BigCommerceToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'bigcommerce';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'BigCommerce',
            'description' => 'BigCommerce e-commerce',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:bigcommerce',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'BigCommerce',
            'description' => 'BigCommerce e-commerce platform — manage products, orders, and customers',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:bigcommerce',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developer.bigcommerce.com/docs/rest',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your BigCommerce API access token',
                'hint' => 'Generate an API token in your BigCommerce store under Advanced Settings > API Accounts',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.bigcommerce.com/v3',
                'hint' => 'BigCommerce API base URL. Change only if using a proxy or mock server.',
                'default' => 'https://api.bigcommerce.com/v3',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.bigcommerce.com/v3', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'Access token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/storefront/status');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to BigCommerce API.',
                ];
            }

            $error = $response->json('title', $response->body());

            return [
                'success' => false,
                'error' => "BigCommerce returned HTTP {$response->status()}: " . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'bigcommerce_list_products' => [
                'class' => BigCommerceListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List products from the BigCommerce catalog.',
                'icon' => 'ph:package',
            ],
            'bigcommerce_get_product' => [
                'class' => BigCommerceGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get a single product by ID.',
                'icon' => 'ph:package',
            ],
            'bigcommerce_create_product' => [
                'class' => BigCommerceCreateProduct::class,
                'type' => 'write',
                'name' => 'Create Product',
                'description' => 'Create a new product in the catalog.',
                'icon' => 'ph:plus-circle',
            ],
            'bigcommerce_list_orders' => [
                'class' => BigCommerceListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List orders from the store.',
                'icon' => 'ph:receipt',
            ],
            'bigcommerce_get_order' => [
                'class' => BigCommerceGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get a single order by ID.',
                'icon' => 'ph:receipt',
            ],
            'bigcommerce_list_customers' => [
                'class' => BigCommerceListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers from the store.',
                'icon' => 'ph:users',
            ],
            'bigcommerce_get_current_user' => [
                'class' => BigCommerceGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get storefront status and verify API connection.',
                'icon' => 'ph:storefront',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/bigcommerce.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.bigcommerce.com/v3'],
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

            $service = new BigCommerceService(
                accessToken: $creds->get('bigcommerce', 'access_token', '', $account),
                baseUrl: $creds->get('bigcommerce', 'base_url', 'https://api.bigcommerce.com/v3', $account),
            );

            return new $class($service);
        }

        return new $class(app(BigCommerceService::class));
    }
}
