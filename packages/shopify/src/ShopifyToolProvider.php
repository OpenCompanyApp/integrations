<?php

namespace OpenCompany\Integrations\Shopify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Shopify\Tools\ShopifyListProducts;
use OpenCompany\Integrations\Shopify\Tools\ShopifyGetProduct;
use OpenCompany\Integrations\Shopify\Tools\ShopifyCreateProduct;
use OpenCompany\Integrations\Shopify\Tools\ShopifyListOrders;
use OpenCompany\Integrations\Shopify\Tools\ShopifyGetOrder;
use OpenCompany\Integrations\Shopify\Tools\ShopifyListCustomers;
use OpenCompany\Integrations\Shopify\Tools\ShopifyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ShopifyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'shopify';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Shopify',
            'description' => 'Shopify e-commerce',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:shopify',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Shopify',
            'description' => 'Shopify e-commerce platform — manage products, orders, and customers',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:shopify',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://shopify.dev/docs/api/admin-rest',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Shopify API access token',
                'hint' => 'Generate an API token in your Shopify Admin under Apps → Develop apps.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.shopify.com/v1',
                'hint' => 'Shopify API base URL. Change only if using a proxy or mock server.',
                'default' => 'https://api.shopify.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.shopify.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'Access token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/shop');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Shopify API.',
                ];
            }

            $error = $response->json('title', $response->body());

            return [
                'success' => false,
                'error' => "Shopify returned HTTP {$response->status()}: " . (is_string($error) ? $error : json_encode($error)),
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
            'shopify_list_products' => [
                'class' => ShopifyListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List products from the Shopify store.',
                'icon' => 'ph:package',
            ],
            'shopify_get_product' => [
                'class' => ShopifyGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get a single product by ID.',
                'icon' => 'ph:package',
            ],
            'shopify_create_product' => [
                'class' => ShopifyCreateProduct::class,
                'type' => 'write',
                'name' => 'Create Product',
                'description' => 'Create a new product in the Shopify store.',
                'icon' => 'ph:plus-circle',
            ],
            'shopify_list_orders' => [
                'class' => ShopifyListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List orders from the Shopify store.',
                'icon' => 'ph:receipt',
            ],
            'shopify_get_order' => [
                'class' => ShopifyGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get a single order by ID.',
                'icon' => 'ph:receipt',
            ],
            'shopify_list_customers' => [
                'class' => ShopifyListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers from the Shopify store.',
                'icon' => 'ph:users',
            ],
            'shopify_get_current_user' => [
                'class' => ShopifyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get shop info and verify API connection.',
                'icon' => 'ph:storefront',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/shopify.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.shopify.com/v1'],
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

            $service = new ShopifyService(
                accessToken: $creds->get('shopify', 'access_token', '', $account),
                baseUrl: $creds->get('shopify', 'base_url', 'https://api.shopify.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ShopifyService::class));
    }
}
