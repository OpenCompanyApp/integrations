<?php

namespace OpenCompany\Integrations\Klipfolio;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Klipfolio\Tools\KlipfolioListDashboards;
use OpenCompany\Integrations\Klipfolio\Tools\KlipfolioGetDashboard;
use OpenCompany\Integrations\Klipfolio\Tools\KlipfolioListMetrics;
use OpenCompany\Integrations\Klipfolio\Tools\KlipfolioGetMetric;
use OpenCompany\Integrations\Klipfolio\Tools\KlipfolioListDatasources;
use OpenCompany\Integrations\Klipfolio\Tools\KlipfolioGetDatasource;
use OpenCompany\Integrations\Klipfolio\Tools\KlipfolioGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Tool provider for the Klipfolio analytics integration.
 *
 * Registers all Klipfolio tools and provides integration metadata,
 * configuration schema, and connection testing.
 */
class KlipfolioToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'klipfolio';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Klipfolio',
            'description' => 'Business analytics & dashboards',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:klipfolio',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Klipfolio',
            'description' => 'Business intelligence dashboards and analytics',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:klipfolio',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://support.klipfolio.com/hc/en-us/articles/115004 supplemental-API-docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Klipfolio API access token',
                'hint' => 'Generate an API key in your Klipfolio account under <strong>Account > API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://app.klipfolio.com',
                'hint' => 'Use <code>https://app.klipfolio.com</code> for cloud, or your custom white-label URL',
                'default' => 'https://app.klipfolio.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://app.klipfolio.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Klipfolio API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your access token.",
                ];
            }

            $userName = $json['data']['email'] ?? $json['data']['name'] ?? 'unknown user';

            return [
                'success' => true,
                'message' => "Connected to Klipfolio API as {$userName}.",
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
            'klipfolio_list_dashboards' => [
                'class' => KlipfolioListDashboards::class,
                'type' => 'read',
                'name' => 'List Dashboards',
                'description' => 'List all dashboards accessible to the authenticated user.',
                'icon' => 'ph:squares-four',
            ],
            'klipfolio_get_dashboard' => [
                'class' => KlipfolioGetDashboard::class,
                'type' => 'read',
                'name' => 'Get Dashboard',
                'description' => 'Get details for a specific dashboard.',
                'icon' => 'ph:squares-four',
            ],
            'klipfolio_list_metrics' => [
                'class' => KlipfolioListMetrics::class,
                'type' => 'read',
                'name' => 'List Metrics',
                'description' => 'List all metrics accessible to the authenticated user.',
                'icon' => 'ph:chart-line-up',
            ],
            'klipfolio_get_metric' => [
                'class' => KlipfolioGetMetric::class,
                'type' => 'read',
                'name' => 'Get Metric',
                'description' => 'Get details for a specific metric.',
                'icon' => 'ph:chart-line-up',
            ],
            'klipfolio_list_datasources' => [
                'class' => KlipfolioListDatasources::class,
                'type' => 'read',
                'name' => 'List Data Sources',
                'description' => 'List all data sources accessible to the authenticated user.',
                'icon' => 'ph:database',
            ],
            'klipfolio_get_datasource' => [
                'class' => KlipfolioGetDatasource::class,
                'type' => 'read',
                'name' => 'Get Data Source',
                'description' => 'Get details for a specific data source.',
                'icon' => 'ph:database',
            ],
            'klipfolio_get_current_user' => [
                'class' => KlipfolioGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/klipfolio.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Klipfolio URL', 'required' => false, 'default' => 'https://app.klipfolio.com'],
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

            $service = new KlipfolioService(
                accessToken: $creds->get('klipfolio', 'access_token', '', $account),
                baseUrl: $creds->get('klipfolio', 'url', 'https://app.klipfolio.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(KlipfolioService::class));
    }
}
