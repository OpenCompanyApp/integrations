<?php

namespace OpenCompany\Integrations\Podia;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Podia\Tools\PodiaListProducts;
use OpenCompany\Integrations\Podia\Tools\PodiaGetProduct;
use OpenCompany\Integrations\Podia\Tools\PodiaListCustomers;
use OpenCompany\Integrations\Podia\Tools\PodiaGetCustomer;
use OpenCompany\Integrations\Podia\Tools\PodiaListSales;
use OpenCompany\Integrations\Podia\Tools\PodiaGetSale;
use OpenCompany\Integrations\Podia\Tools\PodiaGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class PodiaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'podia';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Podia',
            'description' => 'Online courses & digital downloads',
            'icon' => 'ph:graduation-cap',
            'logo' => 'simple-icons:podia',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Podia',
            'description' => 'Sell online courses, digital downloads, and coaching',
            'icon' => 'ph:graduation-cap',
            'logo' => 'simple-icons:podia',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://support.podia.com/en/articles/9181971-podia-api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Podia API access token',
                'hint' => 'Generate an API token in your Podia account under <strong>Settings → Integrations → API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.podia.com/v2',
                'hint' => 'Use the default Podia API URL. Only change if using a custom endpoint.',
                'default' => 'https://api.podia.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.podia.com/v2', '/');

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
                    'error' => "Could not reach Podia API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Podia API error: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Podia API as @" . ($json['user']['name'] ?? 'unknown') . ".",
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
            'podia_list_products' => [
                'class' => PodiaListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List all online courses and digital downloads.',
                'icon' => 'ph:package',
            ],
            'podia_get_product' => [
                'class' => PodiaGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get details for a single product.',
                'icon' => 'ph:package',
            ],
            'podia_list_customers' => [
                'class' => PodiaListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List all customers.',
                'icon' => 'ph:users',
            ],
            'podia_get_customer' => [
                'class' => PodiaGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get details for a single customer.',
                'icon' => 'ph:user',
            ],
            'podia_list_sales' => [
                'class' => PodiaListSales::class,
                'type' => 'read',
                'name' => 'List Sales',
                'description' => 'List sales with optional filters.',
                'icon' => 'ph:receipt',
            ],
            'podia_get_sale' => [
                'class' => PodiaGetSale::class,
                'type' => 'read',
                'name' => 'Get Sale',
                'description' => 'Get details for a single sale.',
                'icon' => 'ph:receipt',
            ],
            'podia_get_current_user' => [
                'class' => PodiaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/podia.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.podia.com/v2'],
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

            $service = new PodiaService(
                accessToken: $creds->get('podia', 'access_token', '', $account),
                baseUrl: $creds->get('podia', 'url', 'https://api.podia.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(PodiaService::class));
    }
}
