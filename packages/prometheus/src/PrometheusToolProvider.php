<?php

namespace OpenCompany\Integrations\Prometheus;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Prometheus\Tools\PrometheusListAlerts;
use OpenCompany\Integrations\Prometheus\Tools\PrometheusGetAlert;
use OpenCompany\Integrations\Prometheus\Tools\PrometheusListRules;
use OpenCompany\Integrations\Prometheus\Tools\PrometheusGetRule;
use OpenCompany\Integrations\Prometheus\Tools\PrometheusListTargets;
use OpenCompany\Integrations\Prometheus\Tools\PrometheusGetTarget;
use OpenCompany\Integrations\Prometheus\Tools\PrometheusGetCurrentUser;

/**
 * Tool provider for the Prometheus integration.
 *
 * Registers 7 tools for interacting with a Prometheus instance:
 * alerts, rules, targets, and user info.
 * Supports multi-account via resolveService().
 */
class PrometheusToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * {@inheritDoc}
     */
    public function appName(): string
    {
        return 'prometheus';
    }

    /**
     * {@inheritDoc}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'alerts, rules, targets, user',
            'description' => 'Monitoring & alerting',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:prometheus',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Prometheus',
            'description' => 'Open-source monitoring and alerting toolkit',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:prometheus',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://prometheus.io/docs/prometheus/latest/querying/api/',
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
                'placeholder' => 'Enter your Prometheus API bearer token',
                'hint' => 'Generate an API token in your Prometheus instance configuration',
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
            ])->timeout(10)->get('https://api.prometheus.io/v1/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach Prometheus API. Check your configuration.',
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $json['error'] ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Prometheus API error: {$message}",
                ];
            }

            $userName = $json['name'] ?? $json['email'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Prometheus as {$userName}.",
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
            'prometheus_list_alerts' => [
                'class' => PrometheusListAlerts::class,
                'type' => 'read',
                'name' => 'List Alerts',
                'description' => 'List Prometheus alerts.',
                'icon' => 'ph:bell',
            ],
            'prometheus_get_alert' => [
                'class' => PrometheusGetAlert::class,
                'type' => 'read',
                'name' => 'Get Alert',
                'description' => 'Get a Prometheus alert by name.',
                'icon' => 'ph:bell-ringing',
            ],
            'prometheus_list_rules' => [
                'class' => PrometheusListRules::class,
                'type' => 'read',
                'name' => 'List Rules',
                'description' => 'List Prometheus alerting and recording rules.',
                'icon' => 'ph:list-bullets',
            ],
            'prometheus_get_rule' => [
                'class' => PrometheusGetRule::class,
                'type' => 'read',
                'name' => 'Get Rule',
                'description' => 'Get a Prometheus rule group by name.',
                'icon' => 'ph:list-bullets',
            ],
            'prometheus_list_targets' => [
                'class' => PrometheusListTargets::class,
                'type' => 'read',
                'name' => 'List Targets',
                'description' => 'List Prometheus scrape targets.',
                'icon' => 'ph:target',
            ],
            'prometheus_get_target' => [
                'class' => PrometheusGetTarget::class,
                'type' => 'read',
                'name' => 'Get Target',
                'description' => 'Get a Prometheus target by instance.',
                'icon' => 'ph:target',
            ],
            'prometheus_get_current_user' => [
                'class' => PrometheusGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated user info.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/prometheus.md';
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
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new PrometheusService(
                apiToken: $creds->get('prometheus', 'api_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(PrometheusService::class));
    }
}
