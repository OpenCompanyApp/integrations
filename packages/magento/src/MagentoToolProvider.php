<?php

namespace OpenCompany\Integrations\Magento;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Magento\Tools\MagentoListProducts;
use OpenCompany\Integrations\Magento\Tools\MagentoGetProduct;
use OpenCompany\Integrations\Magento\Tools\MagentoCreateProduct;
use OpenCompany\Integrations\Magento\Tools\MagentoListOrders;
use OpenCompany\Integrations\Magento\Tools\MagentoGetOrder;
use OpenCompany\Integrations\Magento\Tools\MagentoListCustomers;
use OpenCompany\Integrations\Magento\Tools\MagentoGetCurrentUser;

/**
 * Magento tool provider.
 *
 * Registers all Magento integration tools and provides configuration
 * schema for access token and base URL.
 */
class MagentoToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * {@inheritDoc}
     */
    public function appName(): string
    {
        return 'magento';
    }

    /**
     * {@inheritDoc}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'products, orders, customers',
            'description' => 'E-commerce platform',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:magento',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Magento',
            'description' => 'Open-source e-commerce platform for online merchants — manage products, orders, and customers.',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:magento',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developer.adobe.com/commerce/webapi/rest/',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Magento API access token',
                'hint' => 'Generate a token in Magento Admin under System → Integrations or via OAuth',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.magento.com/v1',
                'hint' => 'The base URL of your Magento REST API instance',
                'default' => 'https://api.magento.com/v1',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.magento.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Magento API at {$baseUrl}. Check the URL.",
                ];
            }

            if (! $response->successful()) {
                $error = $json['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Magento API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Magento API successfully.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function tools(): array
    {
        return [
            'magento_list_products' => [
                'class' => MagentoListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List products from the Magento catalog.',
                'icon' => 'ph:package',
            ],
            'magento_get_product' => [
                'class' => MagentoGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get details of a specific product by SKU.',
                'icon' => 'ph:barcode',
            ],
            'magento_create_product' => [
                'class' => MagentoCreateProduct::class,
                'type' => 'write',
                'name' => 'Create Product',
                'description' => 'Create a new product in the Magento catalog.',
                'icon' => 'ph:plus-circle',
            ],
            'magento_list_orders' => [
                'class' => MagentoListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List orders from the Magento store.',
                'icon' => 'ph:list',
            ],
            'magento_get_order' => [
                'class' => MagentoGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get details of a specific order by ID.',
                'icon' => 'ph:receipt',
            ],
            'magento_list_customers' => [
                'class' => MagentoListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers from the Magento store.',
                'icon' => 'ph:users',
            ],
            'magento_get_current_user' => [
                'class' => MagentoGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Verify Magento API connectivity and get current user info.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/magento.md';
    }

    /**
     * {@inheritDoc}
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.magento.com/v1'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new MagentoService(
                accessToken: $creds->get('magento', 'access_token', '', $account),
                baseUrl: $creds->get('magento', 'url', 'https://api.magento.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(MagentoService::class));
    }
}
