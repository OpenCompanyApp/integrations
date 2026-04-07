<?php

namespace OpenCompany\Integrations\Sellfy;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Sellfy\Tools\SellfyListProducts;
use OpenCompany\Integrations\Sellfy\Tools\SellfyGetProduct;
use OpenCompany\Integrations\Sellfy\Tools\SellfyCreateProduct;
use OpenCompany\Integrations\Sellfy\Tools\SellfyListOrders;
use OpenCompany\Integrations\Sellfy\Tools\SellfyGetOrder;
use OpenCompany\Integrations\Sellfy\Tools\SellfyListCustomers;
use OpenCompany\Integrations\Sellfy\Tools\SellfyGetCurrentUser;

class SellfyToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'sellfy';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'products, orders, customers',
            'description' => 'E-commerce platform',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:sellfy',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Sellfy',
            'description' => 'E-commerce platform for selling digital products, subscriptions, and physical goods',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:sellfy',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://sellfy.com/api/documentation/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Sellfy API key',
                'hint' => 'Generate an API key in your Sellfy dashboard under Settings > Advanced > API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.sellfy.com/v1',
                'hint' => 'The Sellfy API base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.sellfy.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.sellfy.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Sellfy API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your API key.",
                ];
            }

            $userName = $json['name'] ?? 'Unknown';
            $userEmail = $json['email'] ?? '';

            return [
                'success' => true,
                'message' => "Connected to Sellfy as {$userName}" . ($userEmail ? " ({$userEmail})" : '') . ".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'sellfy_list_products' => [
                'class' => SellfyListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List all products in your Sellfy store.',
                'icon' => 'ph:package',
            ],
            'sellfy_get_product' => [
                'class' => SellfyGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get details for a specific product.',
                'icon' => 'ph:package',
            ],
            'sellfy_create_product' => [
                'class' => SellfyCreateProduct::class,
                'type' => 'write',
                'name' => 'Create Product',
                'description' => 'Create a new product in your Sellfy store.',
                'icon' => 'ph:plus-circle',
            ],
            'sellfy_list_orders' => [
                'class' => SellfyListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List all orders in your Sellfy store.',
                'icon' => 'ph:receipt',
            ],
            'sellfy_get_order' => [
                'class' => SellfyGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get details for a specific order.',
                'icon' => 'ph:receipt',
            ],
            'sellfy_list_customers' => [
                'class' => SellfyListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List all customers in your Sellfy store.',
                'icon' => 'ph:users',
            ],
            'sellfy_get_current_user' => [
                'class' => SellfyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/sellfy.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.sellfy.com/v1'],
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

            $service = new SellfyService(
                apiKey: $creds->get('sellfy', 'api_key', '', $account),
                baseUrl: $creds->get('sellfy', 'url', 'https://api.sellfy.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(SellfyService::class));
    }
}
