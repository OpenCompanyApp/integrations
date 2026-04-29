<?php

namespace OpenCompany\Integrations\Brandfetch;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchGetBrand;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchSearchBrands;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchListLogos;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchGetLogo;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchListColors;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchListFonts;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class BrandfetchToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'brandfetch';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Brandfetch',
            'description' => 'Brand asset lookup',
            'icon' => 'ph:palette',
            'logo' => 'simple-icons:brandfetch',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Brandfetch',
            'description' => 'Look up brand logos, colors, fonts, and other assets',
            'icon' => 'ph:palette',
            'logo' => 'simple-icons:brandfetch',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://docs.brandfetch.com',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Brandfetch access token',
                'hint' => 'Generate an access token in your Brandfetch account settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.brandfetch.com',
                'hint' => 'Use <code>https://api.brandfetch.com</code> for the default API, or your custom endpoint',
                'default' => 'https://api.brandfetch.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.brandfetch.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Brandfetch API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Brandfetch API at {$baseUrl}.",
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
            'brandfetch_get_brand' => [
                'class' => BrandfetchGetBrand::class,
                'type' => 'read',
                'name' => 'Get Brand',
                'description' => 'Look up a brand by domain to get logos, colors, fonts, and other assets.',
                'icon' => 'ph:buildings',
            ],
            'brandfetch_search_brands' => [
                'class' => BrandfetchSearchBrands::class,
                'type' => 'read',
                'name' => 'Search Brands',
                'description' => 'Search for brands by name or domain.',
                'icon' => 'ph:magnifying-glass',
            ],
            'brandfetch_list_logos' => [
                'class' => BrandfetchListLogos::class,
                'type' => 'read',
                'name' => 'List Logos',
                'description' => 'List logos available for a brand.',
                'icon' => 'ph:image',
            ],
            'brandfetch_get_logo' => [
                'class' => BrandfetchGetLogo::class,
                'type' => 'read',
                'name' => 'Get Logo',
                'description' => 'Get a single logo by its ID.',
                'icon' => 'ph:image',
            ],
            'brandfetch_list_colors' => [
                'class' => BrandfetchListColors::class,
                'type' => 'read',
                'name' => 'List Colors',
                'description' => 'List brand colors (hex, type, usage).',
                'icon' => 'ph:palette',
            ],
            'brandfetch_list_fonts' => [
                'class' => BrandfetchListFonts::class,
                'type' => 'read',
                'name' => 'List Fonts',
                'description' => 'List fonts used by a brand.',
                'icon' => 'ph:text-aa',
            ],
            'brandfetch_get_current_user' => [
                'class' => BrandfetchGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account details.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/brandfetch.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.brandfetch.com'],
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

            $service = new BrandfetchService(
                accessToken: $creds->get('brandfetch', 'access_token', '', $account),
                baseUrl: $creds->get('brandfetch', 'url', 'https://api.brandfetch.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(BrandfetchService::class));
    }
}
