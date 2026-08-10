<?php

namespace OpenCompany\Integrations\Brandfetch;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides Brandfetch tools and integration metadata.
 *
 * Exposes Brand API, Brand Search API, Transaction API, Logo API URL helpers,
 * and raw relative helpers for host discovery.
 */
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
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token', 'client_id'],
                'notes' => ['Brand API uses a bearer token. Brand Search and Logo API use a client ID.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
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
            'description' => 'Brand, logo, and merchant enrichment data',
            'icon' => 'ph:palette',
            'logo' => 'simple-icons:brandfetch',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Brandfetch',
            'description' => 'Brand API, Brand Search, Logo API URLs, and Transaction API merchant enrichment',
            'icon' => 'ph:palette',
            'logo' => 'simple-icons:brandfetch',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.brandfetch.com/reference',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Brand API Token',
                'placeholder' => 'Enter your Brandfetch Brand API token',
                'hint' => 'Required for Brand API and Transaction API endpoints.',
                'required' => false,
            ],
            [
                'key' => 'client_id',
                'type' => 'secret',
                'label' => 'Client ID',
                'placeholder' => 'Enter your Brandfetch client ID',
                'hint' => 'Required for Brand Search API and Logo API CDN URLs.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.brandfetch.io',
                'hint' => 'Defaults to https://api.brandfetch.io. Change only for a compatible proxy.',
                'default' => 'https://api.brandfetch.io',
                'required' => false,
            ],
            [
                'key' => 'cdn_url',
                'type' => 'url',
                'label' => 'Logo CDN URL',
                'placeholder' => 'https://cdn.brandfetch.io',
                'hint' => 'Defaults to https://cdn.brandfetch.io.',
                'default' => 'https://cdn.brandfetch.io',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the Brand API token with the free Brandfetch test brand.
     *
     * @param  array<string, mixed>  $config  Configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $clientId = (string) ($config['client_id'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.brandfetch.io'), '/');

        if ($accessToken === '' && $clientId === '') {
            return ['success' => false, 'error' => 'Provide a Brand API token or client ID.'];
        }

        if ($accessToken === '') {
            return ['success' => true, 'message' => 'Client ID configured for Brand Search and Logo API URLs.'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/v2/brands/brandfetch.com');

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? "HTTP {$response->status()}";

                return ['success' => false, 'error' => 'Brandfetch API rejected the credentials: ' . (is_string($error) ? $error : json_encode($error))];
            }

            return ['success' => true, 'message' => 'Connected to Brandfetch Brand API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'client_id' => 'nullable|string',
            'url' => 'nullable|url',
            'cdn_url' => 'nullable|url',
        ];
    }

    /**
     * Return all available Brandfetch tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'brandfetch_get_brand' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchGetBrand', 'type' => 'read', 'name' => 'Get Brand', 'description' => 'Get brand data by generic identifier.', 'icon' => 'ph:buildings'],
            'brandfetch_get_brand_by_domain' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchGetBrandByDomain', 'type' => 'read', 'name' => 'Get Brand by Domain', 'description' => 'Get brand data by explicit domain route.', 'icon' => 'ph:globe'],
            'brandfetch_get_brand_by_ticker' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchGetBrandByTicker', 'type' => 'read', 'name' => 'Get Brand by Ticker', 'description' => 'Get brand data by explicit ticker route.', 'icon' => 'ph:chart-line'],
            'brandfetch_get_brand_by_isin' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchGetBrandByIsin', 'type' => 'read', 'name' => 'Get Brand by ISIN', 'description' => 'Get brand data by explicit ISIN route.', 'icon' => 'ph:identification-card'],
            'brandfetch_get_brand_by_crypto' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchGetBrandByCrypto', 'type' => 'read', 'name' => 'Get Brand by Crypto', 'description' => 'Get brand data by explicit crypto route.', 'icon' => 'ph:currency-btc'],
            'brandfetch_search_brands' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchSearchBrands', 'type' => 'read', 'name' => 'Search Brands', 'description' => 'Search brands by name or domain.', 'icon' => 'ph:magnifying-glass'],
            'brandfetch_enrich_transaction' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchEnrichTransaction', 'type' => 'write', 'name' => 'Enrich Transaction', 'description' => 'Turn raw payment transaction text into merchant brand data.', 'icon' => 'ph:receipt'],
            'brandfetch_logo_url' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchLogoUrl', 'type' => 'read', 'name' => 'Logo URL', 'description' => 'Build a Logo API CDN URL with transformations.', 'icon' => 'ph:image'],
            'brandfetch_list_logos' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchListLogos', 'type' => 'read', 'name' => 'List Logos', 'description' => 'Fetch a brand and return logos.', 'icon' => 'ph:image'],
            'brandfetch_get_logo' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchGetLogo', 'type' => 'read', 'name' => 'Get Logo', 'description' => 'Legacy logo URL helper.', 'icon' => 'ph:image'],
            'brandfetch_list_colors' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchListColors', 'type' => 'read', 'name' => 'List Colors', 'description' => 'Fetch a brand and return colors.', 'icon' => 'ph:palette'],
            'brandfetch_list_fonts' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchListFonts', 'type' => 'read', 'name' => 'List Fonts', 'description' => 'Fetch a brand and return fonts.', 'icon' => 'ph:text-aa'],
            'brandfetch_get_current_user' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchGetCurrentUser', 'type' => 'read', 'name' => 'Verify Credentials', 'description' => 'Verify Brand API credentials with the Brandfetch test brand.', 'icon' => 'ph:user'],
            'brandfetch_api_get' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchApiGet', 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Brandfetch API path with GET.', 'icon' => 'ph:code'],
            'brandfetch_api_post' => ['class' => 'OpenCompany\\Integrations\\Brandfetch\\Tools\\BrandfetchApiPost', 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative Brandfetch API path with POST.', 'icon' => 'ph:code'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/brandfetch.md';
    }

    /**
     * Credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Brand API Token', 'required' => false],
            ['key' => 'client_id', 'type' => 'secret', 'label' => 'Client ID', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.brandfetch.io'],
            ['key' => 'cdn_url', 'type' => 'url', 'label' => 'Logo CDN URL', 'required' => false, 'default' => 'https://cdn.brandfetch.io'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional account-specific credentials.
     *
     * @param  string  $class  Tool class name.
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): BrandfetchService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BrandfetchService(
                accessToken: $creds->get('brandfetch', 'access_token', '', $account),
                baseUrl: $creds->get('brandfetch', 'url', 'https://api.brandfetch.io', $account),
                clientId: $creds->get('brandfetch', 'client_id', '', $account),
                cdnUrl: $creds->get('brandfetch', 'cdn_url', 'https://cdn.brandfetch.io', $account),
            );
        }

        return app(BrandfetchService::class);
    }
}
