<?php

namespace OpenCompany\Integrations\Fathom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Fathom\Tools\FathomListSites;
use OpenCompany\Integrations\Fathom\Tools\FathomGetSite;
use OpenCompany\Integrations\Fathom\Tools\FathomListPageviews;
use OpenCompany\Integrations\Fathom\Tools\FathomGetAggregate;
use OpenCompany\Integrations\Fathom\Tools\FathomListEvents;
use OpenCompany\Integrations\Fathom\Tools\FathomGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class FathomToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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




/**
     * Get the application identifier for this integration.
     */
    public function appName(): string
    {
        return 'fathom';
    }

/**
     * Get metadata for display in the OpenCompany UI.
     *
     * @return array{label: string, description: string, icon: string, logo: string}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'sites, pageviews, aggregates, events',
            'description' => 'Website analytics',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:fathomanalytics',
        ];
    }

/**
     * Get integration metadata for display and categorization.
     *
     * @return array{name: string, description: string, icon: string, logo: string, category: string, badge: string, docs_url: string}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Fathom Analytics',
            'description' => 'Simple, privacy-first website analytics',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:fathomanalytics',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://usefathom.com/docs/api',
        ];
    }/**
     * Get the configuration schema for the Fathom integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Fathom API access token',
                'hint' => 'Generate an access token in your Fathom account settings under "API Access"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.usefathom.com/v1',
                'hint' => 'Use the default <code>https://api.usefathom.com/v1</code> for Fathom Cloud, or your self-hosted URL',
                'default' => 'https://api.usefathom.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Fathom API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.usefathom.com/v1', '/');

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
                    'error' => "Could not reach Fathom API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = ($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? '');
            $userName = trim($userName) ?: ($json['email'] ?? 'Unknown user');

            return [
                'success' => true,
                'message' => "Connected to Fathom API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'fathom_list_sites' => [
                'class' => FathomListSites::class,
                'type' => 'read',
                'name' => 'List Sites',
                'description' => 'List all websites tracked in Fathom Analytics.',
                'icon' => 'ph:globe',
            ],
            'fathom_get_site' => [
                'class' => FathomGetSite::class,
                'type' => 'read',
                'name' => 'Get Site',
                'description' => 'Get details for a specific Fathom site.',
                'icon' => 'ph:globe',
            ],
            'fathom_list_pageviews' => [
                'class' => FathomListPageviews::class,
                'type' => 'read',
                'name' => 'List Pageviews',
                'description' => 'List pageviews for a site with date filtering and pagination.',
                'icon' => 'ph:eye',
            ],
            'fathom_get_aggregate' => [
                'class' => FathomGetAggregate::class,
                'type' => 'read',
                'name' => 'Get Aggregate',
                'description' => 'Get aggregated analytics data (pageviews, visits, visitors, bounce rate).',
                'icon' => 'ph:chart-bar',
            ],
            'fathom_list_events' => [
                'class' => FathomListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List custom events tracked for a site.',
                'icon' => 'ph:lightning',
            ],
            'fathom_get_current_user' => [
                'class' => FathomGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Fathom user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/fathom.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.usefathom.com/v1'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional account-specific credentials.
     *
     * Supports multi-account usage by resolving per-account credentials from the CredentialResolver.
     *
     * @param  string  $class  The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Optional context with 'account' key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new FathomService(
                accessToken: $creds->get('fathom', 'access_token', '', $account),
                baseUrl: $creds->get('fathom', 'url', 'https://api.usefathom.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(FathomService::class));
    }
}
