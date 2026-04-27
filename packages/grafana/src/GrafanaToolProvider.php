<?php

namespace OpenCompany\Integrations\Grafana;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Grafana\Tools\GrafanaListDashboards;
use OpenCompany\Integrations\Grafana\Tools\GrafanaGetDashboard;
use OpenCompany\Integrations\Grafana\Tools\GrafanaCreateDashboard;
use OpenCompany\Integrations\Grafana\Tools\GrafanaListDatasources;
use OpenCompany\Integrations\Grafana\Tools\GrafanaListAlerts;
use OpenCompany\Integrations\Grafana\Tools\GrafanaListTeams;
use OpenCompany\Integrations\Grafana\Tools\GrafanaGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class GrafanaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
     * {@inheritDoc}
     */
    public function appName(): string
    {
        return 'grafana';
    }

    /**
     * {@inheritDoc}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'dashboards, datasources, teams, alerts',
            'description' => 'Analytics & monitoring dashboards',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:grafana',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Grafana',
            'description' => 'Open-source analytics and monitoring platform',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:grafana',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://grafana.com/docs/grafana/latest/developers/http_api/',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Grafana API token',
                'hint' => 'Generate a Service Account token or Personal Access Token in Grafana under Configuration → API Keys or Service Accounts',
                'required' => true,
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.grafana.com/v1/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach Grafana API. Check your API token.',
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Grafana API error: {$message}",
                ];
            }

            $userName = $json['name'] ?? $json['login'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Grafana as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function tools(): array
    {
        return [
            'grafana_list_dashboards' => [
                'class' => GrafanaListDashboards::class,
                'type' => 'read',
                'name' => 'List Dashboards',
                'description' => 'Search and list Grafana dashboards.',
                'icon' => 'ph:squares-four',
            ],
            'grafana_get_dashboard' => [
                'class' => GrafanaGetDashboard::class,
                'type' => 'read',
                'name' => 'Get Dashboard',
                'description' => 'Get a Grafana dashboard by UID.',
                'icon' => 'ph:squares-four',
            ],
            'grafana_create_dashboard' => [
                'class' => GrafanaCreateDashboard::class,
                'type' => 'write',
                'name' => 'Create Dashboard',
                'description' => 'Create or update a Grafana dashboard.',
                'icon' => 'ph:plus-square',
            ],
            'grafana_list_datasources' => [
                'class' => GrafanaListDatasources::class,
                'type' => 'read',
                'name' => 'List Datasources',
                'description' => 'List all configured datasources.',
                'icon' => 'ph:database',
            ],
            'grafana_list_alerts' => [
                'class' => GrafanaListAlerts::class,
                'type' => 'read',
                'name' => 'List Alerts',
                'description' => 'List Grafana alerts.',
                'icon' => 'ph:bell',
            ],
            'grafana_list_teams' => [
                'class' => GrafanaListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all Grafana teams.',
                'icon' => 'ph:users-three',
            ],
            'grafana_get_current_user' => [
                'class' => GrafanaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Grafana user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/grafana.md';
    }

    /**
     * {@inheritDoc}
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new GrafanaService(
                apiToken: $creds->get('grafana', 'api_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(GrafanaService::class));
    }
}
