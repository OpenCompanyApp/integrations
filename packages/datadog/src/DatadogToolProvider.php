<?php

namespace OpenCompany\Integrations\Datadog;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;
use OpenCompany\Integrations\Datadog\Tools\DatadogListMonitors;
use OpenCompany\Integrations\Datadog\Tools\DatadogGetMonitor;
use OpenCompany\Integrations\Datadog\Tools\DatadogCreateMonitor;
use OpenCompany\Integrations\Datadog\Tools\DatadogUpdateMonitor;
use OpenCompany\Integrations\Datadog\Tools\DatadogDeleteMonitor;
use OpenCompany\Integrations\Datadog\Tools\DatadogQueryMetrics;
use OpenCompany\Integrations\Datadog\Tools\DatadogListDashboards;
use OpenCompany\Integrations\Datadog\Tools\DatadogGetDashboard;
use OpenCompany\Integrations\Datadog\Tools\DatadogPostEvent;
use OpenCompany\Integrations\Datadog\Tools\DatadogGetCurrentUser;
use Illuminate\Support\ServiceProvider;

/**
 * Tool provider for Datadog integration.
 *
 * Registers 10 tools for monitors, metrics, dashboards, events, and user info.
 * Implements ConfigurableIntegration for multi-account support with api_key, app_key, and site fields.
 */
class DatadogToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'datadog';
    }

    /**
     * Get metadata for the app listing.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'monitors, metrics, dashboards, events',
            'description' => 'Infrastructure & application monitoring',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:datadog',
        ];
    }

    /**
     * Get metadata for the integration catalog.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Datadog',
            'description' => 'Cloud monitoring, alerting, and analytics platform',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:datadog',
            'category' => 'monitoring',
            'badge' => 'verified',
            'docs_url' => 'https://docs.datadoghq.com/api/',
        ];
    }

    /**
     * Get the configuration schema for Datadog credentials.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Datadog API key',
                'hint' => 'Find your API key in Datadog under <strong>Organization Settings → API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'app_key',
                'type' => 'secret',
                'label' => 'Application Key',
                'placeholder' => 'Enter your Datadog Application key',
                'hint' => 'Generate an Application key in Datadog under <strong>Organization Settings → Application Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'site',
                'type' => 'select',
                'label' => 'Datadog Site',
                'hint' => 'Choose the region where your Datadog account is hosted',
                'default' => 'us',
                'options' => [
                    ['value' => 'us', 'label' => 'US (datadoghq.com)'],
                    ['value' => 'eu', 'label' => 'EU (datadoghq.eu)'],
                ],
            ],
        ];
    }

    /**
     * Test the connection to Datadog using the /validate endpoint.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_key, app_key, and site
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $appKey = $config['app_key'] ?? '';
        $site = $config['site'] ?? 'us';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($appKey)) {
            return ['success' => false, 'error' => 'No Application key provided'];
        }

        $baseUrl = match ($site) {
            'eu' => 'https://api.datadoghq.eu/api/v1',
            default => 'https://api.datadoghq.com/api/v1',
        };

        try {
            $response = Http::withHeaders([
                'DD-API-KEY' => $apiKey,
                'DD-APPLICATION-KEY' => $appKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/validate');

            $json = $response->json();

            if ($response->successful() && ($json['valid'] ?? false) === true) {
                return [
                    'success' => true,
                    'message' => 'Connected to Datadog (' . strtoupper($site) . '). API key validated.',
                ];
            }

            return [
                'success' => false,
                'error' => 'Datadog API key validation failed. Check your credentials.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'app_key' => 'nullable|string',
            'site' => 'nullable|string|in:us,eu',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'datadog_list_monitors' => [
                'class' => DatadogListMonitors::class,
                'type' => 'read',
                'name' => 'List Monitors',
                'description' => 'List Datadog monitors with optional filtering by name or tags.',
                'icon' => 'ph:bell',
            ],
            'datadog_get_monitor' => [
                'class' => DatadogGetMonitor::class,
                'type' => 'read',
                'name' => 'Get Monitor',
                'description' => 'Get details of a specific Datadog monitor.',
                'icon' => 'ph:bell-ringing',
            ],
            'datadog_create_monitor' => [
                'class' => DatadogCreateMonitor::class,
                'type' => 'write',
                'name' => 'Create Monitor',
                'description' => 'Create a new Datadog monitor with a query and alerting options.',
                'icon' => 'ph:plus-circle',
            ],
            'datadog_update_monitor' => [
                'class' => DatadogUpdateMonitor::class,
                'type' => 'write',
                'name' => 'Update Monitor',
                'description' => 'Update an existing Datadog monitor.',
                'icon' => 'ph:pencil',
            ],
            'datadog_delete_monitor' => [
                'class' => DatadogDeleteMonitor::class,
                'type' => 'write',
                'name' => 'Delete Monitor',
                'description' => 'Delete a Datadog monitor.',
                'icon' => 'ph:trash',
            ],
            'datadog_query_metrics' => [
                'class' => DatadogQueryMetrics::class,
                'type' => 'read',
                'name' => 'Query Metrics',
                'description' => 'Query Datadog metrics for a given time range.',
                'icon' => 'ph:chart-line',
            ],
            'datadog_list_dashboards' => [
                'class' => DatadogListDashboards::class,
                'type' => 'read',
                'name' => 'List Dashboards',
                'description' => 'List all Datadog dashboards.',
                'icon' => 'ph:rectangle',
            ],
            'datadog_get_dashboard' => [
                'class' => DatadogGetDashboard::class,
                'type' => 'read',
                'name' => 'Get Dashboard',
                'description' => 'Get details of a specific Datadog dashboard.',
                'icon' => 'ph:rectangle-dashed',
            ],
            'datadog_post_event' => [
                'class' => DatadogPostEvent::class,
                'type' => 'write',
                'name' => 'Post Event',
                'description' => 'Post an event to the Datadog event stream.',
                'icon' => 'ph:megaphone',
            ],
            'datadog_get_current_user' => [
                'class' => DatadogGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Datadog user. Useful for verifying credentials.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/datadog.md';
    }

    /**
     * Get the credential fields for Datadog authentication.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'app_key', 'type' => 'secret', 'label' => 'Application Key', 'required' => true],
            ['key' => 'site', 'type' => 'select', 'label' => 'Datadog Site', 'required' => false, 'default' => 'us'],
        ];
    }

    /**
     * Confirm this class is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally resolving credentials for a specific account.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate
     * @param  array<string, mixed>  $context  Context containing optional 'account' key
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new DatadogService(
                apiKey: $creds->get('datadog', 'api_key', '', $account),
                appKey: $creds->get('datadog', 'app_key', '', $account),
                site: $creds->get('datadog', 'site', 'us', $account),
            );

            return new $class($service);
        }

        return new $class(app(DatadogService::class));
    }
}
