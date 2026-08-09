<?php

namespace OpenCompany\Integrations\Shopify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use Throwable;

/**
 * Provides Shopify Admin REST tools, metadata, configuration, and connection checks.
 */
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
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Shopify Admin REST calls use X-Shopify-Access-Token on a shop-domain Admin API URL.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
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
        return 'shopify';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Shopify',
            'description' => 'Shopify store operations',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:shopify',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Shopify',
            'description' => 'Manage Shopify Admin REST products, orders, customers, inventory, discounts, webhooks, themes, and content.',
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
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'shpat_...', 'hint' => 'Admin API access token from a custom Shopify app.', 'required' => true],
            ['key' => 'shop_domain', 'type' => 'string', 'label' => 'Shop Domain', 'placeholder' => 'example.myshopify.com', 'hint' => 'Used to build https://{shop_domain}/admin/api/{api_version}.', 'required' => true],
            ['key' => 'api_version', 'type' => 'string', 'label' => 'API Version', 'placeholder' => '2025-10', 'hint' => 'Shopify Admin REST API version.', 'required' => false, 'default' => '2025-10'],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'placeholder' => 'https://example.myshopify.com/admin/api/2025-10', 'hint' => 'Optional override for proxies or tests.', 'required' => false],
        ];
    }

    /**
     * Verify Shopify credentials with a lightweight shop request.
     *
     * @param  array<string, mixed>  $config  Access token, shop domain, API version, and optional base URL.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = $this->normalizeBaseUrl((string) ($config['shop_domain'] ?? ''), (string) ($config['api_version'] ?? '2025-10'), (string) ($config['base_url'] ?? ''));

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'Access token is required.'];
        }

        if ($baseUrl === '') {
            return ['success' => false, 'error' => 'Shop domain or base URL is required.'];
        }

        try {
            $response = Http::withHeaders([
                'X-Shopify-Access-Token' => $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/shop.json');

            if ($response->successful()) {
                return ['success' => true, 'message' => 'Connected to Shopify Admin REST API.'];
            }

            $error = $response->json('errors', $response->body());

            return ['success' => false, 'error' => "Shopify returned HTTP {$response->status()}: " . (is_string($error) ? $error : json_encode($error))];
        } catch (Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'shop_domain' => 'nullable|string',
            'api_version' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'shopify_api_get' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyApiGet',
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call any Shopify Admin REST GET endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'shopify_api_post' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyApiPost',
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call any Shopify Admin REST POST endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'shopify_api_put' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyApiPut',
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call any Shopify Admin REST PUT endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'shopify_api_delete' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyApiDelete',
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call any Shopify Admin REST DELETE endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'shopify_get_shop' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetShop',
                'type' => 'read',
                'name' => 'Get Shop',
                'description' => 'Get shop metadata and verify Admin REST access.',
                'icon' => 'ph:storefront',
            ],
            'shopify_get_current_user' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetCurrentUser',
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Compatibility alias for shop metadata.',
                'icon' => 'ph:storefront',
            ],
            'shopify_list_products' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListProducts',
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List Shopify Products.',
                'icon' => 'ph:package',
            ],
            'shopify_get_product' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetProduct',
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get one Shopify Product.',
                'icon' => 'ph:package',
            ],
            'shopify_create_product' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateProduct',
                'type' => 'write',
                'name' => 'Create Product',
                'description' => 'Create a Shopify Product.',
                'icon' => 'ph:package',
            ],
            'shopify_update_product' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateProduct',
                'type' => 'write',
                'name' => 'Update Product',
                'description' => 'Update a Shopify Product.',
                'icon' => 'ph:package',
            ],
            'shopify_delete_product' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteProduct',
                'type' => 'write',
                'name' => 'Delete Product',
                'description' => 'Delete a Shopify Product.',
                'icon' => 'ph:package',
            ],
            'shopify_list_orders' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListOrders',
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List Shopify Orders.',
                'icon' => 'ph:receipt',
            ],
            'shopify_get_order' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetOrder',
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get one Shopify Order.',
                'icon' => 'ph:receipt',
            ],
            'shopify_create_order' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateOrder',
                'type' => 'write',
                'name' => 'Create Order',
                'description' => 'Create a Shopify Order.',
                'icon' => 'ph:receipt',
            ],
            'shopify_update_order' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateOrder',
                'type' => 'write',
                'name' => 'Update Order',
                'description' => 'Update a Shopify Order.',
                'icon' => 'ph:receipt',
            ],
            'shopify_delete_order' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteOrder',
                'type' => 'write',
                'name' => 'Delete Order',
                'description' => 'Delete a Shopify Order.',
                'icon' => 'ph:receipt',
            ],
            'shopify_list_customers' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListCustomers',
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List Shopify Customers.',
                'icon' => 'ph:users',
            ],
            'shopify_get_customer' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetCustomer',
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get one Shopify Customer.',
                'icon' => 'ph:users',
            ],
            'shopify_create_customer' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateCustomer',
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a Shopify Customer.',
                'icon' => 'ph:users',
            ],
            'shopify_update_customer' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateCustomer',
                'type' => 'write',
                'name' => 'Update Customer',
                'description' => 'Update a Shopify Customer.',
                'icon' => 'ph:users',
            ],
            'shopify_delete_customer' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteCustomer',
                'type' => 'write',
                'name' => 'Delete Customer',
                'description' => 'Delete a Shopify Customer.',
                'icon' => 'ph:users',
            ],
            'shopify_list_custom_collections' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListCustomCollections',
                'type' => 'read',
                'name' => 'List Custom Collections',
                'description' => 'List Shopify Custom Collections.',
                'icon' => 'ph:folders',
            ],
            'shopify_get_custom_collection' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetCustomCollection',
                'type' => 'read',
                'name' => 'Get Custom Collection',
                'description' => 'Get one Shopify Custom Collection.',
                'icon' => 'ph:folders',
            ],
            'shopify_create_custom_collection' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateCustomCollection',
                'type' => 'write',
                'name' => 'Create Custom Collection',
                'description' => 'Create a Shopify Custom Collection.',
                'icon' => 'ph:folders',
            ],
            'shopify_update_custom_collection' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateCustomCollection',
                'type' => 'write',
                'name' => 'Update Custom Collection',
                'description' => 'Update a Shopify Custom Collection.',
                'icon' => 'ph:folders',
            ],
            'shopify_delete_custom_collection' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteCustomCollection',
                'type' => 'write',
                'name' => 'Delete Custom Collection',
                'description' => 'Delete a Shopify Custom Collection.',
                'icon' => 'ph:folders',
            ],
            'shopify_list_smart_collections' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListSmartCollections',
                'type' => 'read',
                'name' => 'List Smart Collections',
                'description' => 'List Shopify Smart Collections.',
                'icon' => 'ph:folders',
            ],
            'shopify_get_smart_collection' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetSmartCollection',
                'type' => 'read',
                'name' => 'Get Smart Collection',
                'description' => 'Get one Shopify Smart Collection.',
                'icon' => 'ph:folders',
            ],
            'shopify_create_smart_collection' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateSmartCollection',
                'type' => 'write',
                'name' => 'Create Smart Collection',
                'description' => 'Create a Shopify Smart Collection.',
                'icon' => 'ph:folders',
            ],
            'shopify_update_smart_collection' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateSmartCollection',
                'type' => 'write',
                'name' => 'Update Smart Collection',
                'description' => 'Update a Shopify Smart Collection.',
                'icon' => 'ph:folders',
            ],
            'shopify_delete_smart_collection' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteSmartCollection',
                'type' => 'write',
                'name' => 'Delete Smart Collection',
                'description' => 'Delete a Shopify Smart Collection.',
                'icon' => 'ph:folders',
            ],
            'shopify_list_collects' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListCollects',
                'type' => 'read',
                'name' => 'List Collects',
                'description' => 'List Shopify Collects.',
                'icon' => 'ph:link',
            ],
            'shopify_get_collect' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetCollect',
                'type' => 'read',
                'name' => 'Get Collect',
                'description' => 'Get one Shopify Collect.',
                'icon' => 'ph:link',
            ],
            'shopify_create_collect' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateCollect',
                'type' => 'write',
                'name' => 'Create Collect',
                'description' => 'Create a Shopify Collect.',
                'icon' => 'ph:link',
            ],
            'shopify_update_collect' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateCollect',
                'type' => 'write',
                'name' => 'Update Collect',
                'description' => 'Update a Shopify Collect.',
                'icon' => 'ph:link',
            ],
            'shopify_delete_collect' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteCollect',
                'type' => 'write',
                'name' => 'Delete Collect',
                'description' => 'Delete a Shopify Collect.',
                'icon' => 'ph:link',
            ],
            'shopify_list_price_rules' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListPriceRules',
                'type' => 'read',
                'name' => 'List Price Rules',
                'description' => 'List Shopify Price Rules.',
                'icon' => 'ph:ticket',
            ],
            'shopify_get_price_rule' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetPriceRule',
                'type' => 'read',
                'name' => 'Get Price Rule',
                'description' => 'Get one Shopify Price Rule.',
                'icon' => 'ph:ticket',
            ],
            'shopify_create_price_rule' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreatePriceRule',
                'type' => 'write',
                'name' => 'Create Price Rule',
                'description' => 'Create a Shopify Price Rule.',
                'icon' => 'ph:ticket',
            ],
            'shopify_update_price_rule' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdatePriceRule',
                'type' => 'write',
                'name' => 'Update Price Rule',
                'description' => 'Update a Shopify Price Rule.',
                'icon' => 'ph:ticket',
            ],
            'shopify_delete_price_rule' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeletePriceRule',
                'type' => 'write',
                'name' => 'Delete Price Rule',
                'description' => 'Delete a Shopify Price Rule.',
                'icon' => 'ph:ticket',
            ],
            'shopify_list_webhooks' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListWebhooks',
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List Shopify Webhooks.',
                'icon' => 'ph:webhooks-logo',
            ],
            'shopify_get_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetWebhook',
                'type' => 'read',
                'name' => 'Get Webhook',
                'description' => 'Get one Shopify Webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'shopify_create_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateWebhook',
                'type' => 'write',
                'name' => 'Create Webhook',
                'description' => 'Create a Shopify Webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'shopify_update_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateWebhook',
                'type' => 'write',
                'name' => 'Update Webhook',
                'description' => 'Update a Shopify Webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'shopify_delete_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteWebhook',
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete a Shopify Webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'shopify_list_script_tags' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListScriptTags',
                'type' => 'read',
                'name' => 'List Script Tags',
                'description' => 'List Shopify Script Tags.',
                'icon' => 'ph:code',
            ],
            'shopify_get_script_tag' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetScriptTag',
                'type' => 'read',
                'name' => 'Get Script Tag',
                'description' => 'Get one Shopify Script Tag.',
                'icon' => 'ph:code',
            ],
            'shopify_create_script_tag' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateScriptTag',
                'type' => 'write',
                'name' => 'Create Script Tag',
                'description' => 'Create a Shopify Script Tag.',
                'icon' => 'ph:code',
            ],
            'shopify_update_script_tag' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateScriptTag',
                'type' => 'write',
                'name' => 'Update Script Tag',
                'description' => 'Update a Shopify Script Tag.',
                'icon' => 'ph:code',
            ],
            'shopify_delete_script_tag' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteScriptTag',
                'type' => 'write',
                'name' => 'Delete Script Tag',
                'description' => 'Delete a Shopify Script Tag.',
                'icon' => 'ph:code',
            ],
            'shopify_list_themes' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListThemes',
                'type' => 'read',
                'name' => 'List Themes',
                'description' => 'List Shopify Themes.',
                'icon' => 'ph:paint-brush',
            ],
            'shopify_get_theme' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetTheme',
                'type' => 'read',
                'name' => 'Get Theme',
                'description' => 'Get one Shopify Theme.',
                'icon' => 'ph:paint-brush',
            ],
            'shopify_create_theme' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateTheme',
                'type' => 'write',
                'name' => 'Create Theme',
                'description' => 'Create a Shopify Theme.',
                'icon' => 'ph:paint-brush',
            ],
            'shopify_update_theme' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateTheme',
                'type' => 'write',
                'name' => 'Update Theme',
                'description' => 'Update a Shopify Theme.',
                'icon' => 'ph:paint-brush',
            ],
            'shopify_delete_theme' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteTheme',
                'type' => 'write',
                'name' => 'Delete Theme',
                'description' => 'Delete a Shopify Theme.',
                'icon' => 'ph:paint-brush',
            ],
            'shopify_list_pages' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListPages',
                'type' => 'read',
                'name' => 'List Pages',
                'description' => 'List Shopify Pages.',
                'icon' => 'ph:file-text',
            ],
            'shopify_get_page' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetPage',
                'type' => 'read',
                'name' => 'Get Page',
                'description' => 'Get one Shopify Page.',
                'icon' => 'ph:file-text',
            ],
            'shopify_create_page' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreatePage',
                'type' => 'write',
                'name' => 'Create Page',
                'description' => 'Create a Shopify Page.',
                'icon' => 'ph:file-text',
            ],
            'shopify_update_page' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdatePage',
                'type' => 'write',
                'name' => 'Update Page',
                'description' => 'Update a Shopify Page.',
                'icon' => 'ph:file-text',
            ],
            'shopify_delete_page' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeletePage',
                'type' => 'write',
                'name' => 'Delete Page',
                'description' => 'Delete a Shopify Page.',
                'icon' => 'ph:file-text',
            ],
            'shopify_list_blogs' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListBlogs',
                'type' => 'read',
                'name' => 'List Blogs',
                'description' => 'List Shopify Blogs.',
                'icon' => 'ph:newspaper',
            ],
            'shopify_get_blog' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetBlog',
                'type' => 'read',
                'name' => 'Get Blog',
                'description' => 'Get one Shopify Blog.',
                'icon' => 'ph:newspaper',
            ],
            'shopify_create_blog' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateBlog',
                'type' => 'write',
                'name' => 'Create Blog',
                'description' => 'Create a Shopify Blog.',
                'icon' => 'ph:newspaper',
            ],
            'shopify_update_blog' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateBlog',
                'type' => 'write',
                'name' => 'Update Blog',
                'description' => 'Update a Shopify Blog.',
                'icon' => 'ph:newspaper',
            ],
            'shopify_delete_blog' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteBlog',
                'type' => 'write',
                'name' => 'Delete Blog',
                'description' => 'Delete a Shopify Blog.',
                'icon' => 'ph:newspaper',
            ],
            'shopify_list_fulfillment_services' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListFulfillmentServices',
                'type' => 'read',
                'name' => 'List Fulfillment Services',
                'description' => 'List Shopify Fulfillment Services.',
                'icon' => 'ph:truck',
            ],
            'shopify_get_fulfillment_service' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetFulfillmentService',
                'type' => 'read',
                'name' => 'Get Fulfillment Service',
                'description' => 'Get one Shopify Fulfillment Service.',
                'icon' => 'ph:truck',
            ],
            'shopify_create_fulfillment_service' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateFulfillmentService',
                'type' => 'write',
                'name' => 'Create Fulfillment Service',
                'description' => 'Create a Shopify Fulfillment Service.',
                'icon' => 'ph:truck',
            ],
            'shopify_update_fulfillment_service' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateFulfillmentService',
                'type' => 'write',
                'name' => 'Update Fulfillment Service',
                'description' => 'Update a Shopify Fulfillment Service.',
                'icon' => 'ph:truck',
            ],
            'shopify_delete_fulfillment_service' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteFulfillmentService',
                'type' => 'write',
                'name' => 'Delete Fulfillment Service',
                'description' => 'Delete a Shopify Fulfillment Service.',
                'icon' => 'ph:truck',
            ],
            'shopify_list_locations' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListLocations',
                'type' => 'read',
                'name' => 'List Locations',
                'description' => 'List Shopify Locations.',
                'icon' => 'ph:map-pin',
            ],
            'shopify_get_location' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetLocation',
                'type' => 'read',
                'name' => 'Get Location',
                'description' => 'Get one Shopify Location.',
                'icon' => 'ph:map-pin',
            ],
            'shopify_list_inventory_items' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListInventoryItems',
                'type' => 'read',
                'name' => 'List Inventory Items',
                'description' => 'List Shopify Inventory Items.',
                'icon' => 'ph:barcode',
            ],
            'shopify_get_inventory_item' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetInventoryItem',
                'type' => 'read',
                'name' => 'Get Inventory Item',
                'description' => 'Get one Shopify Inventory Item.',
                'icon' => 'ph:barcode',
            ],
            'shopify_update_inventory_item' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateInventoryItem',
                'type' => 'write',
                'name' => 'Update Inventory Item',
                'description' => 'Update a Shopify inventory item.',
                'icon' => 'ph:barcode',
            ],
            'shopify_list_product_variants' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListProductVariants',
                'type' => 'read',
                'name' => 'List Product Variants',
                'description' => 'List Variants for a Shopify product.',
                'icon' => 'ph:git-branch',
            ],
            'shopify_get_product_variant' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetProductVariant',
                'type' => 'read',
                'name' => 'Get Product Variant',
                'description' => 'Get one product Variant.',
                'icon' => 'ph:git-branch',
            ],
            'shopify_create_product_variant' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateProductVariant',
                'type' => 'write',
                'name' => 'Create Product Variant',
                'description' => 'Create a product Variant.',
                'icon' => 'ph:git-branch',
            ],
            'shopify_update_product_variant' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateProductVariant',
                'type' => 'write',
                'name' => 'Update Product Variant',
                'description' => 'Update a product Variant.',
                'icon' => 'ph:git-branch',
            ],
            'shopify_delete_product_variant' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteProductVariant',
                'type' => 'write',
                'name' => 'Delete Product Variant',
                'description' => 'Delete a product Variant.',
                'icon' => 'ph:git-branch',
            ],
            'shopify_list_product_images' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListProductImages',
                'type' => 'read',
                'name' => 'List Product Images',
                'description' => 'List Images for a Shopify product.',
                'icon' => 'ph:image',
            ],
            'shopify_get_product_image' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetProductImage',
                'type' => 'read',
                'name' => 'Get Product Image',
                'description' => 'Get one product Image.',
                'icon' => 'ph:image',
            ],
            'shopify_create_product_image' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateProductImage',
                'type' => 'write',
                'name' => 'Create Product Image',
                'description' => 'Create a product Image.',
                'icon' => 'ph:image',
            ],
            'shopify_update_product_image' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateProductImage',
                'type' => 'write',
                'name' => 'Update Product Image',
                'description' => 'Update a product Image.',
                'icon' => 'ph:image',
            ],
            'shopify_delete_product_image' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteProductImage',
                'type' => 'write',
                'name' => 'Delete Product Image',
                'description' => 'Delete a product Image.',
                'icon' => 'ph:image',
            ],
            'shopify_list_product_metafields' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListProductMetafields',
                'type' => 'read',
                'name' => 'List Product Metafields',
                'description' => 'List Metafields for a Shopify product.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_get_product_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetProductMetafield',
                'type' => 'read',
                'name' => 'Get Product Metafield',
                'description' => 'Get one product Metafield.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_create_product_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateProductMetafield',
                'type' => 'write',
                'name' => 'Create Product Metafield',
                'description' => 'Create a product Metafield.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_update_product_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateProductMetafield',
                'type' => 'write',
                'name' => 'Update Product Metafield',
                'description' => 'Update a product Metafield.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_delete_product_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteProductMetafield',
                'type' => 'write',
                'name' => 'Delete Product Metafield',
                'description' => 'Delete a product Metafield.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_close_order' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCloseOrder',
                'type' => 'write',
                'name' => 'Close Order',
                'description' => 'Close a Shopify order.',
                'icon' => 'ph:archive',
            ],
            'shopify_reopen_order' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyReopenOrder',
                'type' => 'write',
                'name' => 'Reopen Order',
                'description' => 'Reopen a Shopify order.',
                'icon' => 'ph:arrow-counter-clockwise',
            ],
            'shopify_cancel_order' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCancelOrder',
                'type' => 'write',
                'name' => 'Cancel Order',
                'description' => 'Cancel a Shopify order.',
                'icon' => 'ph:x-circle',
            ],
            'shopify_list_order_transactions' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListOrderTransactions',
                'type' => 'read',
                'name' => 'List Order Transactions',
                'description' => 'List Transactions for a Shopify order.',
                'icon' => 'ph:credit-card',
            ],
            'shopify_get_order_transaction' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetOrderTransaction',
                'type' => 'read',
                'name' => 'Get Order Transaction',
                'description' => 'Get one order Transaction.',
                'icon' => 'ph:credit-card',
            ],
            'shopify_create_order_transaction' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateOrderTransaction',
                'type' => 'write',
                'name' => 'Create Order Transaction',
                'description' => 'Create an order Transaction.',
                'icon' => 'ph:credit-card',
            ],
            'shopify_update_order_transaction' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateOrderTransaction',
                'type' => 'write',
                'name' => 'Update Order Transaction',
                'description' => 'Update an order Transaction.',
                'icon' => 'ph:credit-card',
            ],
            'shopify_delete_order_transaction' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteOrderTransaction',
                'type' => 'write',
                'name' => 'Delete Order Transaction',
                'description' => 'Delete an order Transaction.',
                'icon' => 'ph:credit-card',
            ],
            'shopify_list_order_fulfillments' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListOrderFulfillments',
                'type' => 'read',
                'name' => 'List Order Fulfillments',
                'description' => 'List Fulfillments for a Shopify order.',
                'icon' => 'ph:truck',
            ],
            'shopify_get_order_fulfillment' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetOrderFulfillment',
                'type' => 'read',
                'name' => 'Get Order Fulfillment',
                'description' => 'Get one order Fulfillment.',
                'icon' => 'ph:truck',
            ],
            'shopify_create_order_fulfillment' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateOrderFulfillment',
                'type' => 'write',
                'name' => 'Create Order Fulfillment',
                'description' => 'Create an order Fulfillment.',
                'icon' => 'ph:truck',
            ],
            'shopify_update_order_fulfillment' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateOrderFulfillment',
                'type' => 'write',
                'name' => 'Update Order Fulfillment',
                'description' => 'Update an order Fulfillment.',
                'icon' => 'ph:truck',
            ],
            'shopify_delete_order_fulfillment' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteOrderFulfillment',
                'type' => 'write',
                'name' => 'Delete Order Fulfillment',
                'description' => 'Delete an order Fulfillment.',
                'icon' => 'ph:truck',
            ],
            'shopify_list_order_refunds' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListOrderRefunds',
                'type' => 'read',
                'name' => 'List Order Refunds',
                'description' => 'List Refunds for a Shopify order.',
                'icon' => 'ph:receipt-x',
            ],
            'shopify_get_order_refund' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetOrderRefund',
                'type' => 'read',
                'name' => 'Get Order Refund',
                'description' => 'Get one order Refund.',
                'icon' => 'ph:receipt-x',
            ],
            'shopify_create_order_refund' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateOrderRefund',
                'type' => 'write',
                'name' => 'Create Order Refund',
                'description' => 'Create an order Refund.',
                'icon' => 'ph:receipt-x',
            ],
            'shopify_list_order_risks' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListOrderRisks',
                'type' => 'read',
                'name' => 'List Order Risks',
                'description' => 'List Risks for a Shopify order.',
                'icon' => 'ph:warning',
            ],
            'shopify_get_order_risk' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetOrderRisk',
                'type' => 'read',
                'name' => 'Get Order Risk',
                'description' => 'Get one order Risk.',
                'icon' => 'ph:warning',
            ],
            'shopify_create_order_risk' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateOrderRisk',
                'type' => 'write',
                'name' => 'Create Order Risk',
                'description' => 'Create an order Risk.',
                'icon' => 'ph:warning',
            ],
            'shopify_update_order_risk' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateOrderRisk',
                'type' => 'write',
                'name' => 'Update Order Risk',
                'description' => 'Update an order Risk.',
                'icon' => 'ph:warning',
            ],
            'shopify_delete_order_risk' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteOrderRisk',
                'type' => 'write',
                'name' => 'Delete Order Risk',
                'description' => 'Delete an order Risk.',
                'icon' => 'ph:warning',
            ],
            'shopify_calculate_order_refund' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCalculateOrderRefund',
                'type' => 'write',
                'name' => 'Calculate Order Refund',
                'description' => 'Calculate refund transactions for an order.',
                'icon' => 'ph:calculator',
            ],
            'shopify_list_fulfillment_orders' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListFulfillmentOrders',
                'type' => 'read',
                'name' => 'List Fulfillment Orders',
                'description' => 'List assigned fulfillment orders.',
                'icon' => 'ph:truck',
            ],
            'shopify_list_order_fulfillment_orders' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListOrderFulfillmentOrders',
                'type' => 'read',
                'name' => 'List Order Fulfillment Orders',
                'description' => 'List fulfillment orders for an order.',
                'icon' => 'ph:truck',
            ],
            'shopify_get_fulfillment_order' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetFulfillmentOrder',
                'type' => 'read',
                'name' => 'Get Fulfillment Order',
                'description' => 'Get one fulfillment order.',
                'icon' => 'ph:truck',
            ],
            'shopify_search_customers' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifySearchCustomers',
                'type' => 'read',
                'name' => 'Search Customers',
                'description' => 'Search Shopify customers.',
                'icon' => 'ph:magnifying-glass',
            ],
            'shopify_list_customer_addresses' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListCustomerAddresses',
                'type' => 'read',
                'name' => 'List Customer Addresses',
                'description' => 'List Addresses for a Shopify customer.',
                'icon' => 'ph:map-pin',
            ],
            'shopify_get_customer_address' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetCustomerAddress',
                'type' => 'read',
                'name' => 'Get Customer Address',
                'description' => 'Get one customer Address.',
                'icon' => 'ph:map-pin',
            ],
            'shopify_create_customer_address' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateCustomerAddress',
                'type' => 'write',
                'name' => 'Create Customer Address',
                'description' => 'Create a customer Address.',
                'icon' => 'ph:map-pin',
            ],
            'shopify_update_customer_address' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateCustomerAddress',
                'type' => 'write',
                'name' => 'Update Customer Address',
                'description' => 'Update a customer Address.',
                'icon' => 'ph:map-pin',
            ],
            'shopify_delete_customer_address' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteCustomerAddress',
                'type' => 'write',
                'name' => 'Delete Customer Address',
                'description' => 'Delete a customer Address.',
                'icon' => 'ph:map-pin',
            ],
            'shopify_list_customer_metafields' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListCustomerMetafields',
                'type' => 'read',
                'name' => 'List Customer Metafields',
                'description' => 'List Metafields for a Shopify customer.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_get_customer_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetCustomerMetafield',
                'type' => 'read',
                'name' => 'Get Customer Metafield',
                'description' => 'Get one customer Metafield.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_create_customer_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateCustomerMetafield',
                'type' => 'write',
                'name' => 'Create Customer Metafield',
                'description' => 'Create a customer Metafield.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_update_customer_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateCustomerMetafield',
                'type' => 'write',
                'name' => 'Update Customer Metafield',
                'description' => 'Update a customer Metafield.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_delete_customer_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteCustomerMetafield',
                'type' => 'write',
                'name' => 'Delete Customer Metafield',
                'description' => 'Delete a customer Metafield.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_set_default_customer_address' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifySetDefaultCustomerAddress',
                'type' => 'write',
                'name' => 'Set Default Customer Address',
                'description' => 'Set the default address for a customer.',
                'icon' => 'ph:map-pin-line',
            ],
            'shopify_list_discount_codes' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListDiscountCodes',
                'type' => 'read',
                'name' => 'List Discount Codes',
                'description' => 'List discount codes for a price rule.',
                'icon' => 'ph:ticket',
            ],
            'shopify_get_discount_code' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetDiscountCode',
                'type' => 'read',
                'name' => 'Get Discount Code',
                'description' => 'Get one discount code.',
                'icon' => 'ph:ticket',
            ],
            'shopify_create_discount_code' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateDiscountCode',
                'type' => 'write',
                'name' => 'Create Discount Code',
                'description' => 'Create a discount code for a price rule.',
                'icon' => 'ph:ticket',
            ],
            'shopify_update_discount_code' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateDiscountCode',
                'type' => 'write',
                'name' => 'Update Discount Code',
                'description' => 'Update a discount code.',
                'icon' => 'ph:ticket',
            ],
            'shopify_delete_discount_code' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteDiscountCode',
                'type' => 'write',
                'name' => 'Delete Discount Code',
                'description' => 'Delete a discount code.',
                'icon' => 'ph:ticket',
            ],
            'shopify_lookup_discount_code' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyLookupDiscountCode',
                'type' => 'read',
                'name' => 'Lookup Discount Code',
                'description' => 'Look up a discount code by code string.',
                'icon' => 'ph:magnifying-glass',
            ],
            'shopify_list_inventory_levels' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListInventoryLevels',
                'type' => 'read',
                'name' => 'List Inventory Levels',
                'description' => 'List Shopify inventory levels.',
                'icon' => 'ph:warehouse',
            ],
            'shopify_connect_inventory_level' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyConnectInventoryLevel',
                'type' => 'write',
                'name' => 'Connect Inventory Level',
                'description' => 'Connect an inventory item to a location.',
                'icon' => 'ph:link',
            ],
            'shopify_set_inventory_level' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifySetInventoryLevel',
                'type' => 'write',
                'name' => 'Set Inventory Level',
                'description' => 'Set available inventory at a location.',
                'icon' => 'ph:sliders',
            ],
            'shopify_adjust_inventory_level' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyAdjustInventoryLevel',
                'type' => 'write',
                'name' => 'Adjust Inventory Level',
                'description' => 'Adjust available inventory at a location.',
                'icon' => 'ph:plus-minus',
            ],
            'shopify_delete_inventory_level' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteInventoryLevel',
                'type' => 'write',
                'name' => 'Delete Inventory Level',
                'description' => 'Delete an inventory level.',
                'icon' => 'ph:trash',
            ],
            'shopify_list_assets' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListAssets',
                'type' => 'read',
                'name' => 'List Assets',
                'description' => 'List assets for a theme.',
                'icon' => 'ph:file-code',
            ],
            'shopify_get_asset' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetAsset',
                'type' => 'read',
                'name' => 'Get Asset',
                'description' => 'Get a theme asset by key.',
                'icon' => 'ph:file-code',
            ],
            'shopify_put_asset' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyPutAsset',
                'type' => 'write',
                'name' => 'Put Asset',
                'description' => 'Create or update a theme asset.',
                'icon' => 'ph:file-code',
            ],
            'shopify_delete_asset' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteAsset',
                'type' => 'write',
                'name' => 'Delete Asset',
                'description' => 'Delete a theme asset by key.',
                'icon' => 'ph:trash',
            ],
            'shopify_list_articles' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListArticles',
                'type' => 'read',
                'name' => 'List Articles',
                'description' => 'List articles for a blog.',
                'icon' => 'ph:article',
            ],
            'shopify_get_article' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetArticle',
                'type' => 'read',
                'name' => 'Get Article',
                'description' => 'Get one blog article.',
                'icon' => 'ph:article',
            ],
            'shopify_create_article' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateArticle',
                'type' => 'write',
                'name' => 'Create Article',
                'description' => 'Create a blog article.',
                'icon' => 'ph:article',
            ],
            'shopify_update_article' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateArticle',
                'type' => 'write',
                'name' => 'Update Article',
                'description' => 'Update a blog article.',
                'icon' => 'ph:article',
            ],
            'shopify_delete_article' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteArticle',
                'type' => 'write',
                'name' => 'Delete Article',
                'description' => 'Delete a blog article.',
                'icon' => 'ph:trash',
            ],
            'shopify_list_metafields' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyListMetafields',
                'type' => 'read',
                'name' => 'List Metafields',
                'description' => 'List shop-level metafields.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_get_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyGetMetafield',
                'type' => 'read',
                'name' => 'Get Metafield',
                'description' => 'Get one shop-level metafield.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_create_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyCreateMetafield',
                'type' => 'write',
                'name' => 'Create Metafield',
                'description' => 'Create a shop-level metafield.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_update_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyUpdateMetafield',
                'type' => 'write',
                'name' => 'Update Metafield',
                'description' => 'Update a shop-level metafield.',
                'icon' => 'ph:list-plus',
            ],
            'shopify_delete_metafield' => [
                'class' => 'OpenCompany\\Integrations\\Shopify\\Tools\\ShopifyDeleteMetafield',
                'type' => 'write',
                'name' => 'Delete Metafield',
                'description' => 'Delete a shop-level metafield.',
                'icon' => 'ph:trash',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/shopify.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'shop_domain', 'type' => 'string', 'label' => 'Shop Domain', 'required' => true],
            ['key' => 'api_version', 'type' => 'string', 'label' => 'API Version', 'required' => false, 'default' => '2025-10'],
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
     * Resolve a Shopify service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Optional host runtime context.
     */
    private function resolveService(array $context = []): ShopifyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ShopifyService(
                accessToken: (string) $creds->get('shopify', 'access_token', '', $account),
                shopDomain: (string) $creds->get('shopify', 'shop_domain', '', $account),
                apiVersion: (string) $creds->get('shopify', 'api_version', '2025-10', $account),
                baseUrl: (string) $creds->get('shopify', 'base_url', '', $account),
            );
        }

        return app(ShopifyService::class);
    }

    private function normalizeBaseUrl(string $shopDomain, string $apiVersion, string $baseUrl = ''): string
    {
        if ($baseUrl !== '') {
            return rtrim($baseUrl, '/');
        }

        if ($shopDomain === '') {
            return '';
        }

        $shopDomain = preg_replace('~^https?://~', '', $shopDomain) ?? $shopDomain;
        $shopDomain = rtrim($shopDomain, '/');

        return "https://{$shopDomain}/admin/api/{$apiVersion}";
    }
}