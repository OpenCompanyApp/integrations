<?php

namespace OpenCompany\Integrations\GoogleSearchConsole;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GscListSites;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GscGetSite;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GscListSitemaps;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GscGetSitemap;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GscListSearchAnalytics;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GscListUrlInspection;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GscGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoogleSearchConsoleToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'google-search-console';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'sites, sitemaps, search analytics, url inspection',
            'description' => 'SEO & search performance',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'logos:google-search-console',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Search Console',
            'description' => 'Monitor and maintain your site\'s presence in Google Search results',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'logos:google-search-console',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://developers.google.com/webmaster-tools/search-console-api-original/v3/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Google OAuth access token',
                'hint' => 'Provide a Google OAuth 2.0 access token with <code>https://www.googleapis.com/auth/webmasters.readonly</code> scope',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://searchconsole.googleapis.com',
                'hint' => 'Override only if using a proxy or alternative endpoint',
                'default' => 'https://searchconsole.googleapis.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://searchconsole.googleapis.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v3/users/me');

            if ($response->successful()) {
                $data = $response->json();

                return [
                    'success' => true,
                    'message' => "Connected to Google Search Console as " . ($data['email'] ?? 'unknown user') . ".",
                ];
            }

            $error = $response->json('error.message') ?? $response->body();

            return [
                'success' => false,
                'error' => "API returned HTTP {$response->status()}: " . (is_string($error) ? $error : json_encode($error)),
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
            'gsc_list_sites' => [
                'class' => GscListSites::class,
                'type' => 'read',
                'name' => 'List Sites',
                'description' => 'List sites the user has access to in Google Search Console.',
                'icon' => 'ph:globe',
            ],
            'gsc_get_site' => [
                'class' => GscGetSite::class,
                'type' => 'read',
                'name' => 'Get Site',
                'description' => 'Get details for a specific site in Google Search Console.',
                'icon' => 'ph:globe',
            ],
            'gsc_list_sitemaps' => [
                'class' => GscListSitemaps::class,
                'type' => 'read',
                'name' => 'List Sitemaps',
                'description' => 'List sitemaps submitted for a site.',
                'icon' => 'ph:map-trifold',
            ],
            'gsc_get_sitemap' => [
                'class' => GscGetSitemap::class,
                'type' => 'read',
                'name' => 'Get Sitemap',
                'description' => 'Get details for a specific sitemap.',
                'icon' => 'ph:map-trifold',
            ],
            'gsc_list_search_analytics' => [
                'class' => GscListSearchAnalytics::class,
                'type' => 'read',
                'name' => 'Search Analytics',
                'description' => 'Query search performance data (clicks, impressions, CTR, position).',
                'icon' => 'ph:chart-line-up',
            ],
            'gsc_list_url_inspection' => [
                'class' => GscListUrlInspection::class,
                'type' => 'read',
                'name' => 'URL Inspection',
                'description' => 'Inspect URL indexing status and issues.',
                'icon' => 'ph:magnifying-glass',
            ],
            'gsc_get_current_user' => [
                'class' => GscGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-search-console.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://searchconsole.googleapis.com'],
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

            $service = new GoogleSearchConsoleService(
                accessToken: $creds->get('google-search-console', 'access_token', '', $account),
                baseUrl: $creds->get('google-search-console', 'url', 'https://searchconsole.googleapis.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoogleSearchConsoleService::class));
    }
}
