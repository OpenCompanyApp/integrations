<?php

namespace OpenCompany\Integrations\Etsy;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Etsy\Tools\EtsyListListings;
use OpenCompany\Integrations\Etsy\Tools\EtsyGetListing;
use OpenCompany\Integrations\Etsy\Tools\EtsyCreateListing;
use OpenCompany\Integrations\Etsy\Tools\EtsyListOrders;
use OpenCompany\Integrations\Etsy\Tools\EtsyGetListingInventory;
use OpenCompany\Integrations\Etsy\Tools\EtsyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class EtsyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'etsy';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'listings, orders, inventory',
            'description' => 'Etsy e-commerce',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:etsy',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Etsy',
            'description' => 'Manage Etsy shop listings, orders, and inventory',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:etsy',
            'category' => 'ecommerce',
            'badge' => 'New',
            'docs_url' => 'https://developers.etsy.com/documentation/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Etsy OAuth access token',
                'hint' => 'Generate an access token in your <a href="https://www.etsy.com/developers/register" target="_blank">Etsy developer console</a> via OAuth 2.0',
                'required' => true,
            ],
            [
                'key' => 'shop_id',
                'type' => 'string',
                'label' => 'Shop ID',
                'placeholder' => '123456789',
                'hint' => 'Your Etsy shop ID. Find it in your Etsy shop URL or via the <code>users/me</code> API endpoint.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://openapi.etsy.com/v3/application',
                'hint' => 'Etsy Open API base URL. Change only if using a proxy or mock server.',
                'default' => 'https://openapi.etsy.com/v3/application',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://openapi.etsy.com/v3/application', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'x-api-key' => $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Etsy API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Etsy API returned an error: {$error}",
                ];
            }

            $userId = $json['user_id'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Etsy API as user ID {$userId}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'shop_id' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'etsy_list_listings' => [
                'class' => EtsyListListings::class,
                'type' => 'read',
                'name' => 'List Listings',
                'description' => 'List all listings in the Etsy shop.',
                'icon' => 'ph:list',
            ],
            'etsy_get_listing' => [
                'class' => EtsyGetListing::class,
                'type' => 'read',
                'name' => 'Get Listing',
                'description' => 'Get details for a specific Etsy listing.',
                'icon' => 'ph:package',
            ],
            'etsy_create_listing' => [
                'class' => EtsyCreateListing::class,
                'type' => 'write',
                'name' => 'Create Listing',
                'description' => 'Create a new listing in the Etsy shop.',
                'icon' => 'ph:plus-circle',
            ],
            'etsy_list_orders' => [
                'class' => EtsyListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List orders (receipts) for the Etsy shop.',
                'icon' => 'ph:receipt',
            ],
            'etsy_get_listing_inventory' => [
                'class' => EtsyGetListingInventory::class,
                'type' => 'read',
                'name' => 'Get Listing Inventory',
                'description' => 'Get the inventory (products, offerings) for a listing.',
                'icon' => 'ph:warehouse',
            ],
            'etsy_get_current_user' => [
                'class' => EtsyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Etsy user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/etsy.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'shop_id', 'type' => 'string', 'label' => 'Shop ID', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://openapi.etsy.com/v3/application'],
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

            $service = new EtsyService(
                accessToken: $creds->get('etsy', 'access_token', '', $account),
                shopId: $creds->get('etsy', 'shop_id', '', $account),
                baseUrl: $creds->get('etsy', 'base_url', 'https://openapi.etsy.com/v3/application', $account),
            );

            return new $class($service);
        }

        return new $class(app(EtsyService::class));
    }
}
