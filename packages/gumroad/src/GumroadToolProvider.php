<?php

namespace OpenCompany\Integrations\Gumroad;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Gumroad\Tools\GumroadListProducts;
use OpenCompany\Integrations\Gumroad\Tools\GumroadGetProduct;
use OpenCompany\Integrations\Gumroad\Tools\GumroadListSales;
use OpenCompany\Integrations\Gumroad\Tools\GumroadListSubscribers;
use OpenCompany\Integrations\Gumroad\Tools\GumroadGetSubscriber;
use OpenCompany\Integrations\Gumroad\Tools\GumroadListOffers;
use OpenCompany\Integrations\Gumroad\Tools\GumroadGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GumroadToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'gumroad';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Gumroad',
            'description' => 'Digital commerce',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:gumroad',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Gumroad',
            'description' => 'Sell digital products, memberships, and more',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:gumroad',
            'category' => 'ecommerce',
            'badge' => 'verified',
            'docs_url' => 'https://help.gumroad.com/article/280-gumroad-api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Gumroad access token',
                'hint' => 'Generate an access token in your Gumroad account under <strong>Settings → Advanced → API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.gumroad.com/v2',
                'hint' => 'Use the default Gumroad API URL. Only change if using a custom endpoint.',
                'default' => 'https://api.gumroad.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.gumroad.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Gumroad API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Gumroad API error: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Gumroad API as @" . ($json['user']['name'] ?? 'unknown') . ".",
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
            'gumroad_list_products' => [
                'class' => GumroadListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List all digital products.',
                'icon' => 'ph:package',
            ],
            'gumroad_get_product' => [
                'class' => GumroadGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get details for a single product.',
                'icon' => 'ph:package',
            ],
            'gumroad_list_sales' => [
                'class' => GumroadListSales::class,
                'type' => 'read',
                'name' => 'List Sales',
                'description' => 'List sales with optional filters.',
                'icon' => 'ph:receipt',
            ],
            'gumroad_list_subscribers' => [
                'class' => GumroadListSubscribers::class,
                'type' => 'read',
                'name' => 'List Subscribers',
                'description' => 'List all subscribers.',
                'icon' => 'ph:users',
            ],
            'gumroad_get_subscriber' => [
                'class' => GumroadGetSubscriber::class,
                'type' => 'read',
                'name' => 'Get Subscriber',
                'description' => 'Get details for a single subscriber.',
                'icon' => 'ph:user',
            ],
            'gumroad_list_offers' => [
                'class' => GumroadListOffers::class,
                'type' => 'read',
                'name' => 'List Offers',
                'description' => 'List all offers (discount codes).',
                'icon' => 'ph:tag',
            ],
            'gumroad_get_current_user' => [
                'class' => GumroadGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/gumroad.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.gumroad.com/v2'],
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

            $service = new GumroadService(
                accessToken: $creds->get('gumroad', 'access_token', '', $account),
                baseUrl: $creds->get('gumroad', 'url', 'https://api.gumroad.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(GumroadService::class));
    }
}
