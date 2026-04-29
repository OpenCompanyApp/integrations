<?php

namespace OpenCompany\Integrations\LemonSqueezy;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListProducts;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetProduct;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListOrders;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetOrder;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListCustomers;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListSubscriptions;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class LemonSqueezyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
        return 'lemon-squeezy';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Lemon Squeezy',
            'description' => 'E-commerce platform',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:lemonsqueezy',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Lemon Squeezy',
            'description' => 'All-in-one platform for selling digital products, SaaS subscriptions, and licenses',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:lemonsqueezy',
            'category' => 'ecommerce',
            'badge' => 'verified',
            'docs_url' => 'https://docs.lemonsqueezy.com/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Lemon Squeezy API key',
                'hint' => 'Generate an API key in your Lemon Squeezy dashboard under Settings > API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.lemonsqueezy.com',
                'hint' => 'The Lemon Squeezy API base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.lemonsqueezy.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.lemonsqueezy.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/vnd.api+json',
                'Content-Type' => 'application/vnd.api+json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Lemon Squeezy API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your API key.",
                ];
            }

            $userName = $json['data']['attributes']['name'] ?? 'Unknown';
            $userEmail = $json['data']['attributes']['email'] ?? '';

            return [
                'success' => true,
                'message' => "Connected to Lemon Squeezy as {$userName}" . ($userEmail ? " ({$userEmail})" : '') . ".",
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
            'lemonsqueezy_list_products' => [
                'class' => LemonSqueezyListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List all digital products in your Lemon Squeezy store.',
                'icon' => 'ph:package',
            ],
            'lemonsqueezy_get_product' => [
                'class' => LemonSqueezyGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get details for a specific product.',
                'icon' => 'ph:package',
            ],
            'lemonsqueezy_list_orders' => [
                'class' => LemonSqueezyListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List all orders in your Lemon Squeezy store.',
                'icon' => 'ph:receipt',
            ],
            'lemonsqueezy_get_order' => [
                'class' => LemonSqueezyGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get details for a specific order.',
                'icon' => 'ph:receipt',
            ],
            'lemonsqueezy_list_customers' => [
                'class' => LemonSqueezyListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List all customers in your Lemon Squeezy store.',
                'icon' => 'ph:users',
            ],
            'lemonsqueezy_list_subscriptions' => [
                'class' => LemonSqueezyListSubscriptions::class,
                'type' => 'read',
                'name' => 'List Subscriptions',
                'description' => 'List all active and past subscriptions.',
                'icon' => 'ph:arrows-repeat',
            ],
            'lemonsqueezy_get_current_user' => [
                'class' => LemonSqueezyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/lemon-squeezy.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.lemonsqueezy.com'],
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

            $service = new LemonSqueezyService(
                apiKey: $creds->get('lemon-squeezy', 'api_key', '', $account),
                baseUrl: $creds->get('lemon-squeezy', 'url', 'https://api.lemonsqueezy.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(LemonSqueezyService::class));
    }
}
