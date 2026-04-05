<?php

namespace OpenCompany\Integrations\WooCommerce;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceCreateCustomer;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceCreateProduct;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceDeleteProduct;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceGetCustomer;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceGetCurrentUser;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceGetOrder;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceGetProduct;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceListCustomers;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceListOrders;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceListProducts;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceUpdateOrder;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceUpdateProduct;

/**
 * Tool provider for the WooCommerce integration.
 *
 * Implements {@see ConfigurableIntegration} for multi-account support,
 * config schema, connection testing, and validation rules.
 */
class WooCommerceToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Machine name used for namespacing tools and resolving credentials.
     */
    public function appName(): string
    {
        return 'woocommerce';
    }

    /**
     * Metadata shown in tool listings and UI.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'products, orders, customers',
            'description' => 'E-commerce platform',
            'icon'        => 'ph:shopping-bag',
            'logo'        => 'simple-icons:woocommerce',
        ];
    }

    /**
     * Integration metadata for the integrations catalogue.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'WooCommerce',
            'description' => 'Manage products, orders, and customers on your WooCommerce store',
            'icon'        => 'ph:shopping-bag',
            'logo'        => 'simple-icons:woocommerce',
            'category'    => 'ecommerce',
            'badge'       => 'verified',
            'docs_url'    => 'https://woocommerce.github.io/woocommerce-rest-api-docs/',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'url',
                'type'        => 'url',
                'label'       => 'Store URL',
                'placeholder' => 'https://example.com',
                'hint'        => 'The base URL of your WooCommerce store (no trailing slash)',
                'required'    => true,
            ],
            [
                'key'         => 'consumer_key',
                'type'        => 'secret',
                'label'       => 'Consumer Key',
                'placeholder' => 'ck_xxxxxxxx',
                'hint'        => 'Generate API keys in <strong>WooCommerce → Settings → Advanced → REST API</strong>',
                'required'    => true,
            ],
            [
                'key'         => 'consumer_secret',
                'type'        => 'secret',
                'label'       => 'Consumer Secret',
                'placeholder' => 'cs_xxxxxxxx',
                'hint'        => 'Shown once when you create the API key — store it securely',
                'required'    => true,
            ],
        ];
    }

    /**
     * Test the WooCommerce connection using the provided configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $consumerKey    = $config['consumer_key'] ?? '';
        $consumerSecret = $config['consumer_secret'] ?? '';
        $baseUrl        = rtrim($config['url'] ?? '', '/');

        if (empty($consumerKey) || empty($consumerSecret) || empty($baseUrl)) {
            return ['success' => false, 'error' => 'Store URL, consumer key, and consumer secret are required.'];
        }

        try {
            $response = Http::withBasicAuth($consumerKey, $consumerSecret)
                ->timeout(10)
                ->get($baseUrl . '/wp-json/wc/v3/system_status');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to WooCommerce at {$baseUrl}.",
                ];
            }

            return [
                'success' => false,
                'error'   => "WooCommerce returned HTTP {$response->status()}: " . ($response->json('message') ?? $response->body()),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for stored configuration.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'url'             => 'nullable|url',
            'consumer_key'    => 'nullable|string',
            'consumer_secret' => 'nullable|string',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'woocommerce_list_products' => [
                'class'       => WooCommerceListProducts::class,
                'type'        => 'read',
                'name'        => 'List Products',
                'description' => 'List products from your WooCommerce store.',
                'icon'        => 'ph:package',
            ],
            'woocommerce_get_product' => [
                'class'       => WooCommerceGetProduct::class,
                'type'        => 'read',
                'name'        => 'Get Product',
                'description' => 'Get details for a single product.',
                'icon'        => 'ph:package',
            ],
            'woocommerce_create_product' => [
                'class'       => WooCommerceCreateProduct::class,
                'type'        => 'write',
                'name'        => 'Create Product',
                'description' => 'Create a new product in your WooCommerce store.',
                'icon'        => 'ph:plus-circle',
            ],
            'woocommerce_update_product' => [
                'class'       => WooCommerceUpdateProduct::class,
                'type'        => 'write',
                'name'        => 'Update Product',
                'description' => 'Update an existing product.',
                'icon'        => 'ph:pencil',
            ],
            'woocommerce_delete_product' => [
                'class'       => WooCommerceDeleteProduct::class,
                'type'        => 'write',
                'name'        => 'Delete Product',
                'description' => 'Delete a product from your WooCommerce store.',
                'icon'        => 'ph:trash',
            ],
            'woocommerce_list_orders' => [
                'class'       => WooCommerceListOrders::class,
                'type'        => 'read',
                'name'        => 'List Orders',
                'description' => 'List orders from your WooCommerce store.',
                'icon'        => 'ph:receipt',
            ],
            'woocommerce_get_order' => [
                'class'       => WooCommerceGetOrder::class,
                'type'        => 'read',
                'name'        => 'Get Order',
                'description' => 'Get details for a single order.',
                'icon'        => 'ph:receipt',
            ],
            'woocommerce_update_order' => [
                'class'       => WooCommerceUpdateOrder::class,
                'type'        => 'write',
                'name'        => 'Update Order',
                'description' => 'Update an existing order.',
                'icon'        => 'ph:pencil',
            ],
            'woocommerce_list_customers' => [
                'class'       => WooCommerceListCustomers::class,
                'type'        => 'read',
                'name'        => 'List Customers',
                'description' => 'List customers from your WooCommerce store.',
                'icon'        => 'ph:users',
            ],
            'woocommerce_get_customer' => [
                'class'       => WooCommerceGetCustomer::class,
                'type'        => 'read',
                'name'        => 'Get Customer',
                'description' => 'Get details for a single customer.',
                'icon'        => 'ph:user',
            ],
            'woocommerce_create_customer' => [
                'class'       => WooCommerceCreateCustomer::class,
                'type'        => 'write',
                'name'        => 'Create Customer',
                'description' => 'Create a new customer in your WooCommerce store.',
                'icon'        => 'ph:user-plus',
            ],
            'woocommerce_get_current_user' => [
                'class'       => WooCommerceGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get System Status',
                'description' => 'Get WooCommerce system status (verifies credentials).',
                'icon'        => 'ph:info',
            ],
        ];
    }

    /**
     * Path to the Lua documentation file for agent tool descriptions.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/woocommerce.md';
    }

    /**
     * Credential fields used when resolving per-account credentials.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'url', 'type' => 'url', 'label' => 'Store URL', 'required' => true],
            ['key' => 'consumer_key', 'type' => 'secret', 'label' => 'Consumer Key', 'required' => true],
            ['key' => 'consumer_secret', 'type' => 'secret', 'label' => 'Consumer Secret', 'required' => true],
        ];
    }

    /**
     * Confirm this is an integration provider (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new WooCommerceService(
                consumerKey: $creds->get('woocommerce', 'consumer_key', '', $account),
                consumerSecret: $creds->get('woocommerce', 'consumer_secret', '', $account),
                baseUrl: $creds->get('woocommerce', 'url', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(WooCommerceService::class));
    }
}
