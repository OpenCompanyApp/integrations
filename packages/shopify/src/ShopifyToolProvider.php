<?php

namespace OpenCompany\Integrations\Shopify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Shopify\Tools\ShopifyCancelOrder;
use OpenCompany\Integrations\Shopify\Tools\ShopifyCreateCustomCollection;
use OpenCompany\Integrations\Shopify\Tools\ShopifyCreateCustomer;
use OpenCompany\Integrations\Shopify\Tools\ShopifyCreateDraftOrder;
use OpenCompany\Integrations\Shopify\Tools\ShopifyCreateOrder;
use OpenCompany\Integrations\Shopify\Tools\ShopifyCreateProduct;
use OpenCompany\Integrations\Shopify\Tools\ShopifyDeleteProduct;
use OpenCompany\Integrations\Shopify\Tools\ShopifyGetCustomer;
use OpenCompany\Integrations\Shopify\Tools\ShopifyGetOrder;
use OpenCompany\Integrations\Shopify\Tools\ShopifyGetProduct;
use OpenCompany\Integrations\Shopify\Tools\ShopifyListCustomers;
use OpenCompany\Integrations\Shopify\Tools\ShopifyListFulfillments;
use OpenCompany\Integrations\Shopify\Tools\ShopifyListInventoryItems;
use OpenCompany\Integrations\Shopify\Tools\ShopifyListLocations;
use OpenCompany\Integrations\Shopify\Tools\ShopifyListOrders;
use OpenCompany\Integrations\Shopify\Tools\ShopifyListProducts;
use OpenCompany\Integrations\Shopify\Tools\ShopifyUpdateCustomer;
use OpenCompany\Integrations\Shopify\Tools\ShopifyUpdateInventoryLevel;
use OpenCompany\Integrations\Shopify\Tools\ShopifyUpdateOrder;
use OpenCompany\Integrations\Shopify\Tools\ShopifyUpdateProduct;

/**
 * Registers all Shopify tools and provides integration metadata.
 *
 * Implements ToolProvider for tool registration and ConfigurableIntegration
 * for connection testing and credential management.
 */
class ShopifyToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'shopify';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'e-commerce, products, orders, customers',
            'description' => 'E-commerce platform',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:shopify',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Shopify',
            'description' => 'E-commerce platform for products, orders, customers, and inventory management',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:shopify',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://shopify.dev/docs/api/admin-rest',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'shpat_...',
                'hint' => 'Shopify access token from an OAuth flow or custom app. Find in Shopify Admin → Apps → Develop apps.',
                'required' => true,
            ],
            [
                'key' => 'shop_name',
                'type' => 'text',
                'label' => 'Shop Name',
                'placeholder' => 'my-store',
                'hint' => 'Your Shopify store subdomain (the part before .myshopify.com).',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $shopName = $config['shop_name'] ?? '';

        if (empty($accessToken) || empty($shopName)) {
            return ['success' => false, 'error' => 'Access token and shop name are required.'];
        }

        try {
            $response = Http::withHeaders([
                'X-Shopify-Access-Token' => $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)
              ->get("https://{$shopName}.myshopify.com/admin/api/2025-01/shop.json");

            if ($response->successful()) {
                $shop = $response->json('shop', []);
                $name = $shop['name'] ?? $shopName;

                return [
                    'success' => true,
                    'message' => "Connected to Shopify store: {$name}",
                ];
            }

            $errors = $response->json('errors') ?? $response->body();
            return [
                'success' => false,
                'error' => 'Shopify API error (' . $response->status() . '): ' . (is_string($errors) ? $errors : json_encode($errors)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'shop_name' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Products
            'shopify_create_product' => [
                'class' => ShopifyCreateProduct::class,
                'type' => 'write',
                'name' => 'Create Product',
                'description' => 'Create a new Shopify product.',
                'icon' => 'ph:package',
            ],
            'shopify_get_product' => [
                'class' => ShopifyGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Retrieve a Shopify product by ID.',
                'icon' => 'ph:package',
            ],
            'shopify_update_product' => [
                'class' => ShopifyUpdateProduct::class,
                'type' => 'write',
                'name' => 'Update Product',
                'description' => 'Update an existing Shopify product.',
                'icon' => 'ph:package',
            ],
            'shopify_list_products' => [
                'class' => ShopifyListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List Shopify products with optional filters.',
                'icon' => 'ph:package',
            ],
            'shopify_delete_product' => [
                'class' => ShopifyDeleteProduct::class,
                'type' => 'write',
                'name' => 'Delete Product',
                'description' => 'Delete a Shopify product by ID.',
                'icon' => 'ph:package',
            ],

            // Orders
            'shopify_create_order' => [
                'class' => ShopifyCreateOrder::class,
                'type' => 'write',
                'name' => 'Create Order',
                'description' => 'Create a new Shopify order.',
                'icon' => 'ph:receipt',
            ],
            'shopify_get_order' => [
                'class' => ShopifyGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Retrieve a Shopify order by ID.',
                'icon' => 'ph:receipt',
            ],
            'shopify_list_orders' => [
                'class' => ShopifyListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List Shopify orders with optional filters.',
                'icon' => 'ph:receipt',
            ],
            'shopify_update_order' => [
                'class' => ShopifyUpdateOrder::class,
                'type' => 'write',
                'name' => 'Update Order',
                'description' => 'Update an existing Shopify order.',
                'icon' => 'ph:receipt',
            ],
            'shopify_cancel_order' => [
                'class' => ShopifyCancelOrder::class,
                'type' => 'write',
                'name' => 'Cancel Order',
                'description' => 'Cancel a Shopify order.',
                'icon' => 'ph:receipt',
            ],

            // Customers
            'shopify_create_customer' => [
                'class' => ShopifyCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new Shopify customer.',
                'icon' => 'ph:user-plus',
            ],
            'shopify_get_customer' => [
                'class' => ShopifyGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Retrieve a Shopify customer by ID.',
                'icon' => 'ph:user',
            ],
            'shopify_list_customers' => [
                'class' => ShopifyListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List Shopify customers with optional filters.',
                'icon' => 'ph:users',
            ],
            'shopify_update_customer' => [
                'class' => ShopifyUpdateCustomer::class,
                'type' => 'write',
                'name' => 'Update Customer',
                'description' => 'Update an existing Shopify customer.',
                'icon' => 'ph:user',
            ],

            // Other
            'shopify_create_draft_order' => [
                'class' => ShopifyCreateDraftOrder::class,
                'type' => 'write',
                'name' => 'Create Draft Order',
                'description' => 'Create a Shopify draft order.',
                'icon' => 'ph:notebook',
            ],
            'shopify_list_inventory_items' => [
                'class' => ShopifyListInventoryItems::class,
                'type' => 'read',
                'name' => 'List Inventory Items',
                'description' => 'List Shopify inventory items.',
                'icon' => 'ph:warehouse',
            ],
            'shopify_update_inventory_level' => [
                'class' => ShopifyUpdateInventoryLevel::class,
                'type' => 'write',
                'name' => 'Update Inventory Level',
                'description' => 'Set the available inventory level for an item at a location.',
                'icon' => 'ph:warehouse',
            ],
            'shopify_list_locations' => [
                'class' => ShopifyListLocations::class,
                'type' => 'read',
                'name' => 'List Locations',
                'description' => 'List all Shopify locations.',
                'icon' => 'ph:map-pin',
            ],
            'shopify_create_custom_collection' => [
                'class' => ShopifyCreateCustomCollection::class,
                'type' => 'write',
                'name' => 'Create Custom Collection',
                'description' => 'Create a Shopify custom collection.',
                'icon' => 'ph:folder',
            ],
            'shopify_list_fulfillments' => [
                'class' => ShopifyListFulfillments::class,
                'type' => 'read',
                'name' => 'List Fulfillments',
                'description' => 'List fulfillments for a Shopify order.',
                'icon' => 'ph:truck',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/shopify.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'shop_name', 'type' => 'text', 'label' => 'Shop Name', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ShopifyService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ShopifyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);
            return new ShopifyService(
                accessToken: $creds->get('shopify', 'access_token', '', $account),
                shopName: $creds->get('shopify', 'shop_name', '', $account),
            );
        }

        return app(ShopifyService::class);
    }
}
