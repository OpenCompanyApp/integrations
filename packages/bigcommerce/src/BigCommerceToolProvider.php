<?php

namespace OpenCompany\Integrations\BigCommerce;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListProducts;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceGetProduct;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceCreateProduct;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceUpdateProduct;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceDeleteProduct;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListOrders;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceGetOrder;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceUpdateOrder;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListCustomers;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceGetCustomer;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceCreateCustomer;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListCategories;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceGetCurrentUser;

class BigCommerceToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'bigcommerce';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'products, orders, customers, categories',
            'description' => 'E-commerce platform',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:bigcommerce',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'BigCommerce',
            'description' => 'E-commerce platform for growing businesses — manage products, orders, customers, and categories',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:bigcommerce',
            'category' => 'ecommerce',
            'badge' => 'verified',
            'docs_url' => 'https://developer.bigcommerce.com/docs/rest',
        ];
    }

    public function configSchema(): array
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
                'key' => 'store_id',
                'type' => 'string',
                'label' => 'Store ID',
                'placeholder' => 'e.g., abc12345',
                'hint' => 'Your BigCommerce store hash / ID, found in the store URL or API Accounts settings',
                'required' => true,
            ],
            [
                'key' => 'client_id',
                'type' => 'string',
                'label' => 'Client ID',
                'placeholder' => 'Enter your BigCommerce API client ID',
                'hint' => 'The Client ID associated with your API account, found alongside the Access Token',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $storeId = $config['store_id'] ?? '';
        $clientId = $config['client_id'] ?? '';

        if (empty($accessToken) || empty($storeId) || empty($clientId)) {
            return ['success' => false, 'error' => 'Access token, store ID, and client ID are required.'];
        }

        try {
            $response = Http::withHeaders([
                'X-Auth-Token' => $accessToken,
                'X-Auth-Client' => $clientId,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get("https://api.bigcommerce.com/stores/{$storeId}/v3/storefront/status");

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to BigCommerce store {$storeId}.",
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
            'store_id' => 'nullable|string',
            'client_id' => 'nullable|string',
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
            'bigcommerce_update_product' => [
                'class' => BigCommerceUpdateProduct::class,
                'type' => 'write',
                'name' => 'Update Product',
                'description' => 'Update an existing product.',
                'icon' => 'ph:pencil',
            ],
            'bigcommerce_delete_product' => [
                'class' => BigCommerceDeleteProduct::class,
                'type' => 'write',
                'name' => 'Delete Product',
                'description' => 'Delete a product from the catalog.',
                'icon' => 'ph:trash',
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
            'bigcommerce_update_order' => [
                'class' => BigCommerceUpdateOrder::class,
                'type' => 'write',
                'name' => 'Update Order',
                'description' => 'Update an existing order.',
                'icon' => 'ph:pencil',
            ],
            'bigcommerce_list_customers' => [
                'class' => BigCommerceListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers from the store.',
                'icon' => 'ph:users',
            ],
            'bigcommerce_get_customer' => [
                'class' => BigCommerceGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get a single customer by ID.',
                'icon' => 'ph:user',
            ],
            'bigcommerce_create_customer' => [
                'class' => BigCommerceCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new customer.',
                'icon' => 'ph:user-plus',
            ],
            'bigcommerce_list_categories' => [
                'class' => BigCommerceListCategories::class,
                'type' => 'read',
                'name' => 'List Categories',
                'description' => 'List catalog categories.',
                'icon' => 'ph:folders',
            ],
            'bigcommerce_get_current_user' => [
                'class' => BigCommerceGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Store Status',
                'description' => 'Get storefront status and verify connection.',
                'icon' => 'ph:storefront',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/bigcommerce.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'store_id', 'type' => 'string', 'label' => 'Store ID', 'required' => true],
            ['key' => 'client_id', 'type' => 'string', 'label' => 'Client ID', 'required' => true],
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
                storeId: $creds->get('bigcommerce', 'store_id', '', $account),
                clientId: $creds->get('bigcommerce', 'client_id', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(BigCommerceService::class));
    }
}
