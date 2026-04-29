<?php

namespace OpenCompany\Integrations\Woocommerce;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Woocommerce\Tools\WoocommerceListProducts;
use OpenCompany\Integrations\Woocommerce\Tools\WoocommerceGetProduct;
use OpenCompany\Integrations\Woocommerce\Tools\WoocommerceCreateProduct;
use OpenCompany\Integrations\Woocommerce\Tools\WoocommerceListOrders;
use OpenCompany\Integrations\Woocommerce\Tools\WoocommerceGetOrder;
use OpenCompany\Integrations\Woocommerce\Tools\WoocommerceListCustomers;
use OpenCompany\Integrations\Woocommerce\Tools\WoocommerceGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class WoocommerceToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'woocommerce';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'WooCommerce',
            'description' => 'WooCommerce e-commerce',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:woocommerce',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'WooCommerce',
            'description' => 'WooCommerce e-commerce platform — manage products, orders, and customers',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:woocommerce',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://woocommerce.github.io/woocommerce-rest-api-docs/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your WooCommerce API access token',
                'hint' => 'Generate an API key in your WooCommerce store under WooCommerce > Settings > Advanced > REST API',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.woocommerce.com/v3',
                'hint' => 'WooCommerce API base URL. Change only if using a proxy or custom endpoint.',
                'default' => 'https://api.woocommerce.com/v3',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.woocommerce.com/v3', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'Access token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/system_status');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to WooCommerce API.',
                ];
            }

            $error = $response->json('message', $response->body());

            return [
                'success' => false,
                'error' => "WooCommerce returned HTTP {$response->status()}: " . (is_string($error) ? $error : json_encode($error)),
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
            'woocommerce_list_products' => [
                'class' => WoocommerceListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List products from the WooCommerce catalog.',
                'icon' => 'ph:package',
            ],
            'woocommerce_get_product' => [
                'class' => WoocommerceGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get a single product by ID.',
                'icon' => 'ph:package',
            ],
            'woocommerce_create_product' => [
                'class' => WoocommerceCreateProduct::class,
                'type' => 'write',
                'name' => 'Create Product',
                'description' => 'Create a new product in the catalog.',
                'icon' => 'ph:plus-circle',
            ],
            'woocommerce_list_orders' => [
                'class' => WoocommerceListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List orders from the store.',
                'icon' => 'ph:receipt',
            ],
            'woocommerce_get_order' => [
                'class' => WoocommerceGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get a single order by ID.',
                'icon' => 'ph:receipt',
            ],
            'woocommerce_list_customers' => [
                'class' => WoocommerceListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers from the store.',
                'icon' => 'ph:users',
            ],
            'woocommerce_get_current_user' => [
                'class' => WoocommerceGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get system status and verify API connection.',
                'icon' => 'ph:storefront',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/woocommerce.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.woocommerce.com/v3'],
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

            $service = new WoocommerceService(
                accessToken: $creds->get('woocommerce', 'access_token', '', $account),
                baseUrl: $creds->get('woocommerce', 'base_url', 'https://api.woocommerce.com/v3', $account),
            );

            return new $class($service);
        }

        return new $class(app(WoocommerceService::class));
    }
}
