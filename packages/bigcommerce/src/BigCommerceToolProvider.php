<?php

namespace OpenCompany\Integrations\BigCommerce;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use Throwable;

/**
 * Provides BigCommerce tools, metadata, configuration, and connection checks.
 */
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
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['BigCommerce Admin REST calls use X-Auth-Token and a store-scoped API URL.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
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
            'description' => 'BigCommerce store operations',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:bigcommerce',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'BigCommerce',
            'description' => 'Manage BigCommerce catalog, orders, customers, carts, channels, sites, webhooks, and content.',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:bigcommerce',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.bigcommerce.com/developer/api-reference/rest/admin/overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'BigCommerce API access token',
                'hint' => 'Create a store API account in Advanced Settings > API Accounts.',
                'required' => true,
            ],
            [
                'key' => 'store_hash',
                'type' => 'string',
                'label' => 'Store Hash',
                'placeholder' => 'abc123defg',
                'hint' => 'Used to build https://api.bigcommerce.com/stores/{store_hash}.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.bigcommerce.com/stores/abc123defg',
                'hint' => 'Optional override for proxies or tests. Leave blank to use the store hash.',
                'required' => false,
            ],
        ];
    }

    /**
     * Verify BigCommerce credentials with a lightweight storefront status request.
     *
     * @param  array<string, mixed>  $config  Access token, store hash, and optional base URL.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $storeHash = (string) ($config['store_hash'] ?? '');
        $baseUrl = $this->normalizeBaseUrl($storeHash, (string) ($config['base_url'] ?? ''));

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'Access token is required.'];
        }

        if ($baseUrl === '') {
            return ['success' => false, 'error' => 'Store hash or base URL is required.'];
        }

        try {
            $response = Http::withHeaders([
                'X-Auth-Token' => $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v3/storefront/status');

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
        } catch (Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'store_hash' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'bigcommerce_list_products' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListProducts',
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List catalog products with BigCommerce v3 filters.',
                'icon' => 'ph:package',
            ],
            'bigcommerce_get_product' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetProduct',
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get one catalog product by ID.',
                'icon' => 'ph:package',
            ],
            'bigcommerce_create_product' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateProduct',
                'type' => 'write',
                'name' => 'Create Product',
                'description' => 'Create a catalog product.',
                'icon' => 'ph:plus-circle',
            ],
            'bigcommerce_update_product' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateProduct',
                'type' => 'write',
                'name' => 'Update Product',
                'description' => 'Update a catalog product.',
                'icon' => 'ph:pencil',
            ],
            'bigcommerce_delete_product' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteProduct',
                'type' => 'write',
                'name' => 'Delete Product',
                'description' => 'Delete a catalog product.',
                'icon' => 'ph:trash',
            ],
            'bigcommerce_list_product_variants' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListProductVariants',
                'type' => 'read',
                'name' => 'List Product Variants',
                'description' => 'List variants for a catalog product.',
                'icon' => 'ph:git-branch',
            ],
            'bigcommerce_get_product_variant' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetProductVariant',
                'type' => 'read',
                'name' => 'Get Product Variant',
                'description' => 'Get one product Variant.',
                'icon' => 'ph:git-branch',
            ],
            'bigcommerce_create_product_variant' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateProductVariant',
                'type' => 'write',
                'name' => 'Create Product Variant',
                'description' => 'Create a product Variant.',
                'icon' => 'ph:git-branch',
            ],
            'bigcommerce_update_product_variant' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateProductVariant',
                'type' => 'write',
                'name' => 'Update Product Variant',
                'description' => 'Update a product Variant.',
                'icon' => 'ph:git-branch',
            ],
            'bigcommerce_delete_product_variant' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteProductVariant',
                'type' => 'write',
                'name' => 'Delete Product Variant',
                'description' => 'Delete a product Variant.',
                'icon' => 'ph:git-branch',
            ],
            'bigcommerce_list_product_images' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListProductImages',
                'type' => 'read',
                'name' => 'List Product Images',
                'description' => 'List images for a catalog product.',
                'icon' => 'ph:image',
            ],
            'bigcommerce_get_product_image' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetProductImage',
                'type' => 'read',
                'name' => 'Get Product Image',
                'description' => 'Get one product Image.',
                'icon' => 'ph:image',
            ],
            'bigcommerce_create_product_image' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateProductImage',
                'type' => 'write',
                'name' => 'Create Product Image',
                'description' => 'Create a product Image.',
                'icon' => 'ph:image',
            ],
            'bigcommerce_update_product_image' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateProductImage',
                'type' => 'write',
                'name' => 'Update Product Image',
                'description' => 'Update a product Image.',
                'icon' => 'ph:image',
            ],
            'bigcommerce_delete_product_image' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteProductImage',
                'type' => 'write',
                'name' => 'Delete Product Image',
                'description' => 'Delete a product Image.',
                'icon' => 'ph:image',
            ],
            'bigcommerce_list_product_custom_fields' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListProductCustomFields',
                'type' => 'read',
                'name' => 'List Product Custom Fields',
                'description' => 'List custom-fields for a catalog product.',
                'icon' => 'ph:list-plus',
            ],
            'bigcommerce_get_product_custom_field' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetProductCustomField',
                'type' => 'read',
                'name' => 'Get Product Custom Field',
                'description' => 'Get one product Custom Field.',
                'icon' => 'ph:list-plus',
            ],
            'bigcommerce_create_product_custom_field' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateProductCustomField',
                'type' => 'write',
                'name' => 'Create Product Custom Field',
                'description' => 'Create a product Custom Field.',
                'icon' => 'ph:list-plus',
            ],
            'bigcommerce_update_product_custom_field' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateProductCustomField',
                'type' => 'write',
                'name' => 'Update Product Custom Field',
                'description' => 'Update a product Custom Field.',
                'icon' => 'ph:list-plus',
            ],
            'bigcommerce_delete_product_custom_field' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteProductCustomField',
                'type' => 'write',
                'name' => 'Delete Product Custom Field',
                'description' => 'Delete a product Custom Field.',
                'icon' => 'ph:list-plus',
            ],
            'bigcommerce_list_product_modifiers' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListProductModifiers',
                'type' => 'read',
                'name' => 'List Product Modifiers',
                'description' => 'List modifiers for a catalog product.',
                'icon' => 'ph:sliders-horizontal',
            ],
            'bigcommerce_get_product_modifier' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetProductModifier',
                'type' => 'read',
                'name' => 'Get Product Modifier',
                'description' => 'Get one product Modifier.',
                'icon' => 'ph:sliders-horizontal',
            ],
            'bigcommerce_create_product_modifier' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateProductModifier',
                'type' => 'write',
                'name' => 'Create Product Modifier',
                'description' => 'Create a product Modifier.',
                'icon' => 'ph:sliders-horizontal',
            ],
            'bigcommerce_update_product_modifier' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateProductModifier',
                'type' => 'write',
                'name' => 'Update Product Modifier',
                'description' => 'Update a product Modifier.',
                'icon' => 'ph:sliders-horizontal',
            ],
            'bigcommerce_delete_product_modifier' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteProductModifier',
                'type' => 'write',
                'name' => 'Delete Product Modifier',
                'description' => 'Delete a product Modifier.',
                'icon' => 'ph:sliders-horizontal',
            ],
            'bigcommerce_list_product_options' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListProductOptions',
                'type' => 'read',
                'name' => 'List Product Options',
                'description' => 'List options for a catalog product.',
                'icon' => 'ph:list-checks',
            ],
            'bigcommerce_get_product_option' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetProductOption',
                'type' => 'read',
                'name' => 'Get Product Option',
                'description' => 'Get one product Option.',
                'icon' => 'ph:list-checks',
            ],
            'bigcommerce_create_product_option' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateProductOption',
                'type' => 'write',
                'name' => 'Create Product Option',
                'description' => 'Create a product Option.',
                'icon' => 'ph:list-checks',
            ],
            'bigcommerce_update_product_option' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateProductOption',
                'type' => 'write',
                'name' => 'Update Product Option',
                'description' => 'Update a product Option.',
                'icon' => 'ph:list-checks',
            ],
            'bigcommerce_delete_product_option' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteProductOption',
                'type' => 'write',
                'name' => 'Delete Product Option',
                'description' => 'Delete a product Option.',
                'icon' => 'ph:list-checks',
            ],
            'bigcommerce_list_product_videos' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListProductVideos',
                'type' => 'read',
                'name' => 'List Product Videos',
                'description' => 'List videos for a catalog product.',
                'icon' => 'ph:video',
            ],
            'bigcommerce_get_product_video' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetProductVideo',
                'type' => 'read',
                'name' => 'Get Product Video',
                'description' => 'Get one product Video.',
                'icon' => 'ph:video',
            ],
            'bigcommerce_create_product_video' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateProductVideo',
                'type' => 'write',
                'name' => 'Create Product Video',
                'description' => 'Create a product Video.',
                'icon' => 'ph:video',
            ],
            'bigcommerce_update_product_video' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateProductVideo',
                'type' => 'write',
                'name' => 'Update Product Video',
                'description' => 'Update a product Video.',
                'icon' => 'ph:video',
            ],
            'bigcommerce_delete_product_video' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteProductVideo',
                'type' => 'write',
                'name' => 'Delete Product Video',
                'description' => 'Delete a product Video.',
                'icon' => 'ph:video',
            ],
            'bigcommerce_list_categories' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListCategories',
                'type' => 'read',
                'name' => 'List Categorys',
                'description' => 'List BigCommerce Categorys.',
                'icon' => 'ph:tree-structure',
            ],
            'bigcommerce_get_category' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetCategory',
                'type' => 'read',
                'name' => 'Get Category',
                'description' => 'Get one BigCommerce Category.',
                'icon' => 'ph:tree-structure',
            ],
            'bigcommerce_create_category' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateCategory',
                'type' => 'write',
                'name' => 'Create Category',
                'description' => 'Create a BigCommerce Category.',
                'icon' => 'ph:tree-structure',
            ],
            'bigcommerce_update_category' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateCategory',
                'type' => 'write',
                'name' => 'Update Category',
                'description' => 'Update a BigCommerce Category.',
                'icon' => 'ph:tree-structure',
            ],
            'bigcommerce_delete_category' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteCategory',
                'type' => 'write',
                'name' => 'Delete Category',
                'description' => 'Delete a BigCommerce Category.',
                'icon' => 'ph:tree-structure',
            ],
            'bigcommerce_list_brands' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListBrands',
                'type' => 'read',
                'name' => 'List Brands',
                'description' => 'List BigCommerce Brands.',
                'icon' => 'ph:tag',
            ],
            'bigcommerce_get_brand' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetBrand',
                'type' => 'read',
                'name' => 'Get Brand',
                'description' => 'Get one BigCommerce Brand.',
                'icon' => 'ph:tag',
            ],
            'bigcommerce_create_brand' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateBrand',
                'type' => 'write',
                'name' => 'Create Brand',
                'description' => 'Create a BigCommerce Brand.',
                'icon' => 'ph:tag',
            ],
            'bigcommerce_update_brand' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateBrand',
                'type' => 'write',
                'name' => 'Update Brand',
                'description' => 'Update a BigCommerce Brand.',
                'icon' => 'ph:tag',
            ],
            'bigcommerce_delete_brand' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteBrand',
                'type' => 'write',
                'name' => 'Delete Brand',
                'description' => 'Delete a BigCommerce Brand.',
                'icon' => 'ph:tag',
            ],
            'bigcommerce_list_category_trees' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListCategoryTrees',
                'type' => 'read',
                'name' => 'List Category Trees',
                'description' => 'List BigCommerce Category Trees.',
                'icon' => 'ph:tree',
            ],
            'bigcommerce_get_category_tree' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetCategoryTree',
                'type' => 'read',
                'name' => 'Get Category Tree',
                'description' => 'Get one BigCommerce Category Tree.',
                'icon' => 'ph:tree',
            ],
            'bigcommerce_create_category_tree' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateCategoryTree',
                'type' => 'write',
                'name' => 'Create Category Tree',
                'description' => 'Create a BigCommerce Category Tree.',
                'icon' => 'ph:tree',
            ],
            'bigcommerce_update_category_tree' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateCategoryTree',
                'type' => 'write',
                'name' => 'Update Category Tree',
                'description' => 'Update a BigCommerce Category Tree.',
                'icon' => 'ph:tree',
            ],
            'bigcommerce_delete_category_tree' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteCategoryTree',
                'type' => 'write',
                'name' => 'Delete Category Tree',
                'description' => 'Delete a BigCommerce Category Tree.',
                'icon' => 'ph:tree',
            ],
            'bigcommerce_list_price_lists' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListPriceLists',
                'type' => 'read',
                'name' => 'List Price Lists',
                'description' => 'List BigCommerce Price Lists.',
                'icon' => 'ph:currency-dollar',
            ],
            'bigcommerce_get_price_list' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetPriceList',
                'type' => 'read',
                'name' => 'Get Price List',
                'description' => 'Get one BigCommerce Price List.',
                'icon' => 'ph:currency-dollar',
            ],
            'bigcommerce_create_price_list' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreatePriceList',
                'type' => 'write',
                'name' => 'Create Price List',
                'description' => 'Create a BigCommerce Price List.',
                'icon' => 'ph:currency-dollar',
            ],
            'bigcommerce_update_price_list' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdatePriceList',
                'type' => 'write',
                'name' => 'Update Price List',
                'description' => 'Update a BigCommerce Price List.',
                'icon' => 'ph:currency-dollar',
            ],
            'bigcommerce_delete_price_list' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeletePriceList',
                'type' => 'write',
                'name' => 'Delete Price List',
                'description' => 'Delete a BigCommerce Price List.',
                'icon' => 'ph:currency-dollar',
            ],
            'bigcommerce_list_price_list_records' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListPriceListRecords',
                'type' => 'read',
                'name' => 'List Price List Records',
                'description' => 'List records for a BigCommerce price list.',
                'icon' => 'ph:currency-dollar',
            ],
            'bigcommerce_set_price_list_records' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceSetPriceListRecords',
                'type' => 'write',
                'name' => 'Set Price List Records',
                'description' => 'Create or update records for a BigCommerce price list.',
                'icon' => 'ph:currency-dollar',
            ],
            'bigcommerce_delete_price_list_records' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeletePriceListRecords',
                'type' => 'write',
                'name' => 'Delete Price List Records',
                'description' => 'Delete price list records by query filters.',
                'icon' => 'ph:trash',
            ],
            'bigcommerce_list_orders' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListOrders',
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List store orders with BigCommerce v2 filters.',
                'icon' => 'ph:receipt',
            ],
            'bigcommerce_get_order' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetOrder',
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get one order by ID.',
                'icon' => 'ph:receipt',
            ],
            'bigcommerce_create_order' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateOrder',
                'type' => 'write',
                'name' => 'Create Order',
                'description' => 'Create an order.',
                'icon' => 'ph:plus-circle',
            ],
            'bigcommerce_update_order' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateOrder',
                'type' => 'write',
                'name' => 'Update Order',
                'description' => 'Update an order.',
                'icon' => 'ph:pencil',
            ],
            'bigcommerce_delete_order' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteOrder',
                'type' => 'write',
                'name' => 'Delete Order',
                'description' => 'Delete an order.',
                'icon' => 'ph:trash',
            ],
            'bigcommerce_list_order_products' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListOrderProducts',
                'type' => 'read',
                'name' => 'List Order Products',
                'description' => 'List products for a BigCommerce order.',
                'icon' => 'ph:package',
            ],
            'bigcommerce_list_shipping_addresses' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListShippingAddresses',
                'type' => 'read',
                'name' => 'List Order Shipping Addresses',
                'description' => 'List Order Shipping Addresses for an order.',
                'icon' => 'ph:map-pin',
            ],
            'bigcommerce_list_coupons' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListCoupons',
                'type' => 'read',
                'name' => 'List Order Coupons',
                'description' => 'List Order Coupons for an order.',
                'icon' => 'ph:ticket',
            ],
            'bigcommerce_list_transactions' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListTransactions',
                'type' => 'read',
                'name' => 'List Order Transactions',
                'description' => 'List Order Transactions for an order.',
                'icon' => 'ph:credit-card',
            ],
            'bigcommerce_list_order_shipments' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListOrderShipments',
                'type' => 'read',
                'name' => 'List Order Shipments',
                'description' => 'List shipments for an order.',
                'icon' => 'ph:truck',
            ],
            'bigcommerce_get_order_shipment' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetOrderShipment',
                'type' => 'read',
                'name' => 'Get Order Shipment',
                'description' => 'Get one shipment for an order.',
                'icon' => 'ph:truck',
            ],
            'bigcommerce_create_order_shipment' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateOrderShipment',
                'type' => 'write',
                'name' => 'Create Order Shipment',
                'description' => 'Create a shipment for an order.',
                'icon' => 'ph:truck',
            ],
            'bigcommerce_update_order_shipment' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateOrderShipment',
                'type' => 'write',
                'name' => 'Update Order Shipment',
                'description' => 'Update a shipment for an order.',
                'icon' => 'ph:truck',
            ],
            'bigcommerce_delete_order_shipment' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteOrderShipment',
                'type' => 'write',
                'name' => 'Delete Order Shipment',
                'description' => 'Delete a shipment for an order.',
                'icon' => 'ph:truck',
            ],
            'bigcommerce_list_customers' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListCustomers',
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers with BigCommerce v3 filters.',
                'icon' => 'ph:users',
            ],
            'bigcommerce_get_customer' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetCustomer',
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get one customer by ID using the v3 customers filter.',
                'icon' => 'ph:user',
            ],
            'bigcommerce_create_customers' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateCustomers',
                'type' => 'write',
                'name' => 'Create Customers',
                'description' => 'Create one or more customers.',
                'icon' => 'ph:user-plus',
            ],
            'bigcommerce_update_customers' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateCustomers',
                'type' => 'write',
                'name' => 'Update Customers',
                'description' => 'Update one or more customers.',
                'icon' => 'ph:pencil',
            ],
            'bigcommerce_delete_customers' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteCustomers',
                'type' => 'write',
                'name' => 'Delete Customers',
                'description' => 'Delete customers by comma-separated IDs.',
                'icon' => 'ph:trash',
            ],
            'bigcommerce_list_customer_addresses' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListCustomerAddresses',
                'type' => 'read',
                'name' => 'List Customer Addresses',
                'description' => 'List Customer Addresses.',
                'icon' => 'ph:map-pin',
            ],
            'bigcommerce_get_customer_address' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetCustomerAddress',
                'type' => 'read',
                'name' => 'Get Customer Address',
                'description' => 'Get one record from Customer Addresses.',
                'icon' => 'ph:map-pin',
            ],
            'bigcommerce_create_customer_addresses' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateCustomerAddresses',
                'type' => 'write',
                'name' => 'Create Customer Addresses',
                'description' => 'Create Customer Addresses.',
                'icon' => 'ph:map-pin',
            ],
            'bigcommerce_update_customer_addresses' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateCustomerAddresses',
                'type' => 'write',
                'name' => 'Update Customer Addresses',
                'description' => 'Update Customer Addresses.',
                'icon' => 'ph:map-pin',
            ],
            'bigcommerce_delete_customer_addresses' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteCustomerAddresses',
                'type' => 'write',
                'name' => 'Delete Customer Addresses',
                'description' => 'Delete Customer Addresses by comma-separated IDs.',
                'icon' => 'ph:map-pin',
            ],
            'bigcommerce_list_customer_form_field_values' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListCustomerFormFieldValues',
                'type' => 'read',
                'name' => 'List Customer Form Field Values',
                'description' => 'List Customer Form Field Values.',
                'icon' => 'ph:textbox',
            ],
            'bigcommerce_get_customer_form_field_value' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetCustomerFormFieldValue',
                'type' => 'read',
                'name' => 'Get Customer Form Field Value',
                'description' => 'Get one record from Customer Form Field Values.',
                'icon' => 'ph:textbox',
            ],
            'bigcommerce_create_customer_form_field_values' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateCustomerFormFieldValues',
                'type' => 'write',
                'name' => 'Create Customer Form Field Values',
                'description' => 'Create Customer Form Field Values.',
                'icon' => 'ph:textbox',
            ],
            'bigcommerce_update_customer_form_field_values' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateCustomerFormFieldValues',
                'type' => 'write',
                'name' => 'Update Customer Form Field Values',
                'description' => 'Update Customer Form Field Values.',
                'icon' => 'ph:textbox',
            ],
            'bigcommerce_delete_customer_form_field_values' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteCustomerFormFieldValues',
                'type' => 'write',
                'name' => 'Delete Customer Form Field Values',
                'description' => 'Delete Customer Form Field Values by comma-separated IDs.',
                'icon' => 'ph:textbox',
            ],
            'bigcommerce_list_customer_groups' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListCustomerGroups',
                'type' => 'read',
                'name' => 'List Customer Groups',
                'description' => 'List v2 customer groups.',
                'icon' => 'ph:users-three',
            ],
            'bigcommerce_get_customer_group' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetCustomerGroup',
                'type' => 'read',
                'name' => 'Get Customer Group',
                'description' => 'Get one v2 customer group.',
                'icon' => 'ph:users-three',
            ],
            'bigcommerce_create_customer_group' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateCustomerGroup',
                'type' => 'write',
                'name' => 'Create Customer Group',
                'description' => 'Create a v2 customer group.',
                'icon' => 'ph:users-three',
            ],
            'bigcommerce_update_customer_group' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateCustomerGroup',
                'type' => 'write',
                'name' => 'Update Customer Group',
                'description' => 'Update a v2 customer group.',
                'icon' => 'ph:users-three',
            ],
            'bigcommerce_delete_customer_group' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteCustomerGroup',
                'type' => 'write',
                'name' => 'Delete Customer Group',
                'description' => 'Delete a v2 customer group.',
                'icon' => 'ph:users-three',
            ],
            'bigcommerce_list_carts' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListCarts',
                'type' => 'read',
                'name' => 'List Carts',
                'description' => 'List carts.',
                'icon' => 'ph:shopping-cart',
            ],
            'bigcommerce_get_cart' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetCart',
                'type' => 'read',
                'name' => 'Get Cart',
                'description' => 'Get one cart.',
                'icon' => 'ph:shopping-cart',
            ],
            'bigcommerce_create_cart' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateCart',
                'type' => 'write',
                'name' => 'Create Cart',
                'description' => 'Create a cart.',
                'icon' => 'ph:shopping-cart-simple',
            ],
            'bigcommerce_delete_cart' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteCart',
                'type' => 'write',
                'name' => 'Delete Cart',
                'description' => 'Delete a cart.',
                'icon' => 'ph:trash',
            ],
            'bigcommerce_get_checkout' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetCheckout',
                'type' => 'read',
                'name' => 'Get Checkout',
                'description' => 'Get checkout details.',
                'icon' => 'ph:shopping-bag',
            ],
            'bigcommerce_update_checkout' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateCheckout',
                'type' => 'write',
                'name' => 'Update Checkout',
                'description' => 'Update checkout details.',
                'icon' => 'ph:shopping-bag',
            ],
            'bigcommerce_update_checkout_billing_address' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateCheckoutBillingAddress',
                'type' => 'write',
                'name' => 'Update Checkout Billing Address',
                'description' => 'Update checkout billing address.',
                'icon' => 'ph:map-pin-line',
            ],
            'bigcommerce_create_checkout_consignments' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateCheckoutConsignments',
                'type' => 'write',
                'name' => 'Create Checkout Consignments',
                'description' => 'Create checkout consignments.',
                'icon' => 'ph:truck',
            ],
            'bigcommerce_update_checkout_consignment' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateCheckoutConsignment',
                'type' => 'write',
                'name' => 'Update Checkout Consignment',
                'description' => 'Update a checkout consignment.',
                'icon' => 'ph:truck',
            ],
            'bigcommerce_delete_checkout_consignment' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteCheckoutConsignment',
                'type' => 'write',
                'name' => 'Delete Checkout Consignment',
                'description' => 'Delete a checkout consignment.',
                'icon' => 'ph:trash',
            ],
            'bigcommerce_get_store' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetStore',
                'type' => 'read',
                'name' => 'Get Store',
                'description' => 'Get store information.',
                'icon' => 'ph:storefront',
            ],
            'bigcommerce_get_storefront_status' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetStorefrontStatus',
                'type' => 'read',
                'name' => 'Get Storefront Status',
                'description' => 'Get storefront status and verify API access.',
                'icon' => 'ph:pulse',
            ],
            'bigcommerce_get_current_user' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetCurrentUser',
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Compatibility alias that returns storefront status.',
                'icon' => 'ph:pulse',
            ],
            'bigcommerce_list_channels' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListChannels',
                'type' => 'read',
                'name' => 'List Channels',
                'description' => 'List BigCommerce Channels.',
                'icon' => 'ph:broadcast',
            ],
            'bigcommerce_get_channel' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetChannel',
                'type' => 'read',
                'name' => 'Get Channel',
                'description' => 'Get one BigCommerce Channel.',
                'icon' => 'ph:broadcast',
            ],
            'bigcommerce_create_channel' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateChannel',
                'type' => 'write',
                'name' => 'Create Channel',
                'description' => 'Create a BigCommerce Channel.',
                'icon' => 'ph:broadcast',
            ],
            'bigcommerce_update_channel' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateChannel',
                'type' => 'write',
                'name' => 'Update Channel',
                'description' => 'Update a BigCommerce Channel.',
                'icon' => 'ph:broadcast',
            ],
            'bigcommerce_delete_channel' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteChannel',
                'type' => 'write',
                'name' => 'Delete Channel',
                'description' => 'Delete a BigCommerce Channel.',
                'icon' => 'ph:broadcast',
            ],
            'bigcommerce_list_sites' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListSites',
                'type' => 'read',
                'name' => 'List Sites',
                'description' => 'List BigCommerce Sites.',
                'icon' => 'ph:globe',
            ],
            'bigcommerce_get_site' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetSite',
                'type' => 'read',
                'name' => 'Get Site',
                'description' => 'Get one BigCommerce Site.',
                'icon' => 'ph:globe',
            ],
            'bigcommerce_create_site' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateSite',
                'type' => 'write',
                'name' => 'Create Site',
                'description' => 'Create a BigCommerce Site.',
                'icon' => 'ph:globe',
            ],
            'bigcommerce_update_site' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateSite',
                'type' => 'write',
                'name' => 'Update Site',
                'description' => 'Update a BigCommerce Site.',
                'icon' => 'ph:globe',
            ],
            'bigcommerce_delete_site' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteSite',
                'type' => 'write',
                'name' => 'Delete Site',
                'description' => 'Delete a BigCommerce Site.',
                'icon' => 'ph:globe',
            ],
            'bigcommerce_list_webhooks' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListWebhooks',
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List BigCommerce Webhooks.',
                'icon' => 'ph:webhooks-logo',
            ],
            'bigcommerce_get_webhook' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetWebhook',
                'type' => 'read',
                'name' => 'Get Webhook',
                'description' => 'Get one BigCommerce Webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'bigcommerce_create_webhook' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateWebhook',
                'type' => 'write',
                'name' => 'Create Webhook',
                'description' => 'Create a BigCommerce Webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'bigcommerce_update_webhook' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateWebhook',
                'type' => 'write',
                'name' => 'Update Webhook',
                'description' => 'Update a BigCommerce Webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'bigcommerce_delete_webhook' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteWebhook',
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete a BigCommerce Webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'bigcommerce_list_content_pages' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListContentPages',
                'type' => 'read',
                'name' => 'List Content Pages',
                'description' => 'List BigCommerce Content Pages.',
                'icon' => 'ph:file-text',
            ],
            'bigcommerce_get_content_page' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetContentPage',
                'type' => 'read',
                'name' => 'Get Content Page',
                'description' => 'Get one BigCommerce Content Page.',
                'icon' => 'ph:file-text',
            ],
            'bigcommerce_create_content_page' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateContentPage',
                'type' => 'write',
                'name' => 'Create Content Page',
                'description' => 'Create a BigCommerce Content Page.',
                'icon' => 'ph:file-text',
            ],
            'bigcommerce_update_content_page' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateContentPage',
                'type' => 'write',
                'name' => 'Update Content Page',
                'description' => 'Update a BigCommerce Content Page.',
                'icon' => 'ph:file-text',
            ],
            'bigcommerce_delete_content_page' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteContentPage',
                'type' => 'write',
                'name' => 'Delete Content Page',
                'description' => 'Delete a BigCommerce Content Page.',
                'icon' => 'ph:file-text',
            ],
            'bigcommerce_list_widgets' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListWidgets',
                'type' => 'read',
                'name' => 'List Widgets',
                'description' => 'List BigCommerce Widgets.',
                'icon' => 'ph:squares-four',
            ],
            'bigcommerce_get_widget' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetWidget',
                'type' => 'read',
                'name' => 'Get Widget',
                'description' => 'Get one BigCommerce Widget.',
                'icon' => 'ph:squares-four',
            ],
            'bigcommerce_create_widget' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateWidget',
                'type' => 'write',
                'name' => 'Create Widget',
                'description' => 'Create a BigCommerce Widget.',
                'icon' => 'ph:squares-four',
            ],
            'bigcommerce_update_widget' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateWidget',
                'type' => 'write',
                'name' => 'Update Widget',
                'description' => 'Update a BigCommerce Widget.',
                'icon' => 'ph:squares-four',
            ],
            'bigcommerce_delete_widget' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteWidget',
                'type' => 'write',
                'name' => 'Delete Widget',
                'description' => 'Delete a BigCommerce Widget.',
                'icon' => 'ph:squares-four',
            ],
            'bigcommerce_list_widget_templates' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListWidgetTemplates',
                'type' => 'read',
                'name' => 'List Widget Templates',
                'description' => 'List BigCommerce Widget Templates.',
                'icon' => 'ph:layout',
            ],
            'bigcommerce_get_widget_template' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetWidgetTemplate',
                'type' => 'read',
                'name' => 'Get Widget Template',
                'description' => 'Get one BigCommerce Widget Template.',
                'icon' => 'ph:layout',
            ],
            'bigcommerce_create_widget_template' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateWidgetTemplate',
                'type' => 'write',
                'name' => 'Create Widget Template',
                'description' => 'Create a BigCommerce Widget Template.',
                'icon' => 'ph:layout',
            ],
            'bigcommerce_update_widget_template' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateWidgetTemplate',
                'type' => 'write',
                'name' => 'Update Widget Template',
                'description' => 'Update a BigCommerce Widget Template.',
                'icon' => 'ph:layout',
            ],
            'bigcommerce_delete_widget_template' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteWidgetTemplate',
                'type' => 'write',
                'name' => 'Delete Widget Template',
                'description' => 'Delete a BigCommerce Widget Template.',
                'icon' => 'ph:layout',
            ],
            'bigcommerce_list_redirects' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListRedirects',
                'type' => 'read',
                'name' => 'List Redirects',
                'description' => 'List BigCommerce Redirects.',
                'icon' => 'ph:arrow-elbow-down-right',
            ],
            'bigcommerce_get_redirect' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceGetRedirect',
                'type' => 'read',
                'name' => 'Get Redirect',
                'description' => 'Get one BigCommerce Redirect.',
                'icon' => 'ph:arrow-elbow-down-right',
            ],
            'bigcommerce_create_redirect' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceCreateRedirect',
                'type' => 'write',
                'name' => 'Create Redirect',
                'description' => 'Create a BigCommerce Redirect.',
                'icon' => 'ph:arrow-elbow-down-right',
            ],
            'bigcommerce_update_redirect' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceUpdateRedirect',
                'type' => 'write',
                'name' => 'Update Redirect',
                'description' => 'Update a BigCommerce Redirect.',
                'icon' => 'ph:arrow-elbow-down-right',
            ],
            'bigcommerce_delete_redirect' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceDeleteRedirect',
                'type' => 'write',
                'name' => 'Delete Redirect',
                'description' => 'Delete a BigCommerce Redirect.',
                'icon' => 'ph:arrow-elbow-down-right',
            ],
            'bigcommerce_list_regions' => [
                'class' => 'OpenCompany\\Integrations\\BigCommerce\\Tools\\BigCommerceListRegions',
                'type' => 'read',
                'name' => 'List Regions',
                'description' => 'List content regions for widget placement.',
                'icon' => 'ph:selection-background',
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
            ['key' => 'store_hash', 'type' => 'string', 'label' => 'Store Hash', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a BigCommerce service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Optional host runtime context.
     */
    private function resolveService(array $context = []): BigCommerceService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BigCommerceService(
                accessToken: (string) $creds->get('bigcommerce', 'access_token', '', $account),
                storeHash: (string) $creds->get('bigcommerce', 'store_hash', '', $account),
                baseUrl: (string) $creds->get('bigcommerce', 'base_url', '', $account),
            );
        }

        return app(BigCommerceService::class);
    }

    private function normalizeBaseUrl(string $storeHash, string $baseUrl = ''): string
    {
        if ($baseUrl === '' && $storeHash !== '') {
            $baseUrl = 'https://api.bigcommerce.com/stores/' . $storeHash;
        }

        $baseUrl = rtrim($baseUrl, '/');

        return preg_replace('~/v[23]$~', '', $baseUrl) ?? $baseUrl;
    }
}