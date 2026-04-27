<?php

namespace OpenCompany\Integrations\ShipBob;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ShipBob\Tools\ShipBobCreateOrder;
use OpenCompany\Integrations\ShipBob\Tools\ShipBobGetCurrentUser;
use OpenCompany\Integrations\ShipBob\Tools\ShipBobGetOrder;
use OpenCompany\Integrations\ShipBob\Tools\ShipBobGetProduct;
use OpenCompany\Integrations\ShipBob\Tools\ShipBobListOrders;
use OpenCompany\Integrations\ShipBob\Tools\ShipBobListProducts;
use OpenCompany\Integrations\ShipBob\Tools\ShipBobListShipments;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ShipBobToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'shipbob';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'orders, products, shipments',
            'description' => 'E-commerce fulfillment',
            'icon' => 'ph:package',
            'logo' => 'simple-icons:shipbob',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'ShipBob',
            'description' => 'E-commerce fulfillment and order management',
            'icon' => 'ph:package',
            'logo' => 'simple-icons:shipbob',
            'category' => 'ecommerce',
            'badge' => 'verified',
            'docs_url' => 'https://developer.shipbob.com',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your ShipBob access token',
                'hint' => 'Generate an access token in your ShipBob developer settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.shipbob.com',
                'hint' => 'Use <code>https://api.shipbob.com</code> for production, or a custom URL for sandbox/testing',
                'default' => 'https://api.shipbob.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.shipbob.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/user');

            if ($response->successful()) {
                $user = $response->json();

                return [
                    'success' => true,
                    'message' => "Connected to ShipBob API as {$user['email']}.",
                ];
            }

            return [
                'success' => false,
                'error' => "ShipBob API returned HTTP {$response->status()}. Check your access token.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'shipbob_list_orders' => [
                'class' => ShipBobListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List fulfillment orders with pagination and status filtering.',
                'icon' => 'ph:package',
            ],
            'shipbob_get_order' => [
                'class' => ShipBobGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get details for a specific order.',
                'icon' => 'ph:package',
            ],
            'shipbob_create_order' => [
                'class' => ShipBobCreateOrder::class,
                'type' => 'write',
                'name' => 'Create Order',
                'description' => 'Create a new fulfillment order.',
                'icon' => 'ph:plus-circle',
            ],
            'shipbob_list_products' => [
                'class' => ShipBobListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List products in your ShipBob inventory.',
                'icon' => 'ph:cube',
            ],
            'shipbob_get_product' => [
                'class' => ShipBobGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get details for a specific product.',
                'icon' => 'ph:cube',
            ],
            'shipbob_list_shipments' => [
                'class' => ShipBobListShipments::class,
                'type' => 'read',
                'name' => 'List Shipments',
                'description' => 'List shipments with pagination.',
                'icon' => 'ph:truck',
            ],
            'shipbob_get_current_user' => [
                'class' => ShipBobGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/shipbob.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'ShipBob API URL', 'required' => false, 'default' => 'https://api.shipbob.com'],
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

            $service = new ShipBobService(
                accessToken: $creds->get('shipbob', 'access_token', '', $account),
                baseUrl: $creds->get('shipbob', 'url', 'https://api.shipbob.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(ShipBobService::class));
    }
}
