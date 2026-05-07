<?php

namespace OpenCompany\Integrations\ZohoInventory;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ZohoInventory\Tools\ZohoInventoryListItems;
use OpenCompany\Integrations\ZohoInventory\Tools\ZohoInventoryGetItem;
use OpenCompany\Integrations\ZohoInventory\Tools\ZohoInventoryListOrders;
use OpenCompany\Integrations\ZohoInventory\Tools\ZohoInventoryGetOrder;
use OpenCompany\Integrations\ZohoInventory\Tools\ZohoInventoryListShipments;
use OpenCompany\Integrations\ZohoInventory\Tools\ZohoInventoryListPackages;
use OpenCompany\Integrations\ZohoInventory\Tools\ZohoInventoryGetCurrentUser;

class ZohoInventoryToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
        return 'zoho-inventory';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Zoho Inventory',
            'description' => 'Inventory management',
            'icon' => 'ph:package',
            'logo' => 'simple-icons:zoho',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoho Inventory',
            'description' => 'Inventory management, sales orders, shipments, and packages',
            'icon' => 'ph:package',
            'logo' => 'simple-icons:zoho',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.zoho.com/inventory/api/v1/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Zoho Inventory OAuth access token',
                'hint' => 'Generate an OAuth token from the Zoho API Console with inventory scope',
                'required' => true,
            ],
            [
                'key' => 'organization_id',
                'type' => 'text',
                'label' => 'Organization ID',
                'placeholder' => 'Enter your Zoho organization ID',
                'hint' => 'Find your Organization ID in Zoho Inventory under Settings → Organization Profile',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://www.zohoapis.com/inventory',
                'hint' => 'Use the default URL for most regions. For EU data centers, use <code>https://www.zohoapis.eu/inventory</code>',
                'default' => 'https://www.zohoapis.com/inventory',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $organizationId = $config['organization_id'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://www.zohoapis.com/inventory', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($organizationId)) {
            return ['success' => false, 'error' => 'No organization ID provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v1/users/me', [
                'organization_id' => $organizationId,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Zoho Inventory API at {$baseUrl}. Check the URL.",
                ];
            }

            if (isset($json['code']) && $json['code'] !== 0) {
                return [
                    'success' => false,
                    'error' => $json['message'] ?? 'Authentication failed.',
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Zoho Inventory for organization {$organizationId}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'organization_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'zoho_inventory_list_items' => [
                'class' => ZohoInventoryListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List inventory items (products) from Zoho Inventory.',
                'icon' => 'ph:cube',
            ],
            'zoho_inventory_get_item' => [
                'class' => ZohoInventoryGetItem::class,
                'type' => 'read',
                'name' => 'Get Item',
                'description' => 'Get details of a specific inventory item.',
                'icon' => 'ph:cube',
            ],
            'zoho_inventory_list_orders' => [
                'class' => ZohoInventoryListOrders::class,
                'type' => 'read',
                'name' => 'List Sales Orders',
                'description' => 'List sales orders from Zoho Inventory.',
                'icon' => 'ph:receipt',
            ],
            'zoho_inventory_get_order' => [
                'class' => ZohoInventoryGetOrder::class,
                'type' => 'read',
                'name' => 'Get Sales Order',
                'description' => 'Get details of a specific sales order.',
                'icon' => 'ph:receipt',
            ],
            'zoho_inventory_list_shipments' => [
                'class' => ZohoInventoryListShipments::class,
                'type' => 'read',
                'name' => 'List Shipments',
                'description' => 'List shipments from Zoho Inventory.',
                'icon' => 'ph:truck',
            ],
            'zoho_inventory_list_packages' => [
                'class' => ZohoInventoryListPackages::class,
                'type' => 'read',
                'name' => 'List Packages',
                'description' => 'List packages from Zoho Inventory.',
                'icon' => 'ph:package',
            ],
            'zoho_inventory_get_current_user' => [
                'class' => ZohoInventoryGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Zoho Inventory user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoho-inventory.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'organization_id', 'type' => 'text', 'label' => 'Organization ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://www.zohoapis.com/inventory'],
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
            $creds = app(CredentialResolver::class);
            $get = static function (string $key, mixed $default = '') use ($creds, $account): mixed {
                $value = $creds->get('zoho-inventory', $key, null, $account);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('zoho_inventory', $key, $default, $account);
            };

            $service = new ZohoInventoryService(
                accessToken: $get('access_token'),
                organizationId: $get('organization_id'),
                baseUrl: $get('url', 'https://www.zohoapis.com/inventory'),
            );

            return new $class($service);
        }

        return new $class(app(ZohoInventoryService::class));
    }
}
