<?php

namespace OpenCompany\Integrations\Productboard;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Productboard\Tools\ProductboardListFeatures;
use OpenCompany\Integrations\Productboard\Tools\ProductboardGetFeature;
use OpenCompany\Integrations\Productboard\Tools\ProductboardCreateFeature;
use OpenCompany\Integrations\Productboard\Tools\ProductboardListNotes;
use OpenCompany\Integrations\Productboard\Tools\ProductboardCreateNote;
use OpenCompany\Integrations\Productboard\Tools\ProductboardListProducts;
use OpenCompany\Integrations\Productboard\Tools\ProductboardListCompanies;
use OpenCompany\Integrations\Productboard\Tools\ProductboardGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ProductboardToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'productboard';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'features, notes, products, companies',
            'description' => 'Product management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:productboard',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Productboard',
            'description' => 'Product management platform for prioritizing features and capturing customer feedback',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:productboard',
            'category' => 'product-management',
            'badge' => 'verified',
            'docs_url' => 'https://developer.productboard.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Productboard access token',
                'hint' => 'Generate a Personal Access Token in Productboard under Settings → API Access',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.productboard.com',
                'hint' => 'Use <code>https://api.productboard.com</code> for the default Productboard API',
                'default' => 'https://api.productboard.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.productboard.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Productboard API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            $userName = ($json['firstName'] ?? '') . ' ' . ($json['lastName'] ?? '');
            $userEmail = $json['email'] ?? '';

            return [
                'success' => true,
                'message' => "Connected to Productboard as {$userName} ({$userEmail}).",
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
            'productboard_list_features' => [
                'class' => ProductboardListFeatures::class,
                'type' => 'read',
                'name' => 'List Features',
                'description' => 'List features from Productboard.',
                'icon' => 'ph:list-bullets',
            ],
            'productboard_get_feature' => [
                'class' => ProductboardGetFeature::class,
                'type' => 'read',
                'name' => 'Get Feature',
                'description' => 'Get details of a specific feature.',
                'icon' => 'ph:eye',
            ],
            'productboard_create_feature' => [
                'class' => ProductboardCreateFeature::class,
                'type' => 'write',
                'name' => 'Create Feature',
                'description' => 'Create a new feature in Productboard.',
                'icon' => 'ph:plus-circle',
            ],
            'productboard_list_notes' => [
                'class' => ProductboardListNotes::class,
                'type' => 'read',
                'name' => 'List Notes',
                'description' => 'List notes (customer feedback) from Productboard.',
                'icon' => 'ph:note',
            ],
            'productboard_create_note' => [
                'class' => ProductboardCreateNote::class,
                'type' => 'write',
                'name' => 'Create Note',
                'description' => 'Create a new note in Productboard.',
                'icon' => 'ph:note-pencil',
            ],
            'productboard_list_products' => [
                'class' => ProductboardListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List products from Productboard.',
                'icon' => 'ph:package',
            ],
            'productboard_list_companies' => [
                'class' => ProductboardListCompanies::class,
                'type' => 'read',
                'name' => 'List Companies',
                'description' => 'List companies from Productboard.',
                'icon' => 'ph:buildings',
            ],
            'productboard_get_current_user' => [
                'class' => ProductboardGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Productboard user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/productboard.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.productboard.com'],
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

            $service = new ProductboardService(
                accessToken: $creds->get('productboard', 'access_token', '', $account),
                baseUrl: $creds->get('productboard', 'url', 'https://api.productboard.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(ProductboardService::class));
    }
}
