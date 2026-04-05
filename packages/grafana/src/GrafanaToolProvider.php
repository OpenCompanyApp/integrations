<?php

namespace OpenCompany\Integrations\Grafana;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Grafana\Tools\GrafanaListDashboards;
use OpenCompany\Integrations\Grafana\Tools\GrafanaGetDashboard;
use OpenCompany\Integrations\Grafana\Tools\GrafanaCreateDashboard;
use OpenCompany\Integrations\Grafana\Tools\GrafanaListDatasources;
use OpenCompany\Integrations\Grafana\Tools\GrafanaGetDatasource;
use OpenCompany\Integrations\Grafana\Tools\GrafanaListTeams;
use OpenCompany\Integrations\Grafana\Tools\GrafanaGetTeam;
use OpenCompany\Integrations\Grafana\Tools\GrafanaListUsers;
use OpenCompany\Integrations\Grafana\Tools\GrafanaListAlerts;
use OpenCompany\Integrations\Grafana\Tools\GrafanaGetCurrentUser;

/**
 * Tool provider for the Grafana integration.
 *
 * Registers 10 tools for interacting with a Grafana instance:
 * dashboards, datasources, teams, users, alerts, and organization info.
 * Supports multi-account via resolveService().
 */
class GrafanaToolProvider implements ToolProvider, ConfigurableIntegration
{
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
            'label' => 'dashboards, datasources, teams, users, alerts',
            'description' => 'Observability & monitoring',
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
            'category' => 'monitoring',
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
            [
                'key' => 'hostname',
                'type' => 'string',
                'label' => 'Hostname',
                'placeholder' => 'grafana.example.com',
                'hint' => 'Your Grafana instance hostname (e.g., <code>grafana.example.com</code>). Do not include https://',
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
        $hostname = rtrim($config['hostname'] ?? '', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        if (empty($hostname)) {
            return ['success' => false, 'error' => 'No hostname provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://' . $hostname . '/api/org');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Grafana API at {$hostname}. Check the hostname.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Grafana API error: {$message}",
                ];
            }

            $orgName = $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Grafana ({$orgName}) at {$hostname}.",
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
            'hostname' => 'nullable|string',
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
            'grafana_get_datasource' => [
                'class' => GrafanaGetDatasource::class,
                'type' => 'read',
                'name' => 'Get Datasource',
                'description' => 'Get a datasource by ID.',
                'icon' => 'ph:database',
            ],
            'grafana_list_teams' => [
                'class' => GrafanaListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all Grafana teams.',
                'icon' => 'ph:users-three',
            ],
            'grafana_get_team' => [
                'class' => GrafanaGetTeam::class,
                'type' => 'read',
                'name' => 'Get Team',
                'description' => 'Get a team by ID.',
                'icon' => 'ph:users-three',
            ],
            'grafana_list_users' => [
                'class' => GrafanaListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List organization users.',
                'icon' => 'ph:user',
            ],
            'grafana_list_alerts' => [
                'class' => GrafanaListAlerts::class,
                'type' => 'read',
                'name' => 'List Alerts',
                'description' => 'List Grafana alerts.',
                'icon' => 'ph:bell',
            ],
            'grafana_get_current_user' => [
                'class' => GrafanaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current Org',
                'description' => 'Get the current organization info (verify auth).',
                'icon' => 'ph:building',
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
            ['key' => 'hostname', 'type' => 'string', 'label' => 'Grafana Hostname', 'required' => true],
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
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new GrafanaService(
                apiToken: $creds->get('grafana', 'api_token', '', $account),
                hostname: $creds->get('grafana', 'hostname', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(GrafanaService::class));
    }
}
