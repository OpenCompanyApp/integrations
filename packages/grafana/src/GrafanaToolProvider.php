<?php

namespace OpenCompany\Integrations\Grafana;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the Grafana integration.
 *
 * Exposes generated tools for Grafana's official HTTP API OpenAPI document
 * and resolves account-specific service account tokens and instance URLs.
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_token'],
                'notes' => ['Grafana HTTP API requests use Authorization: Bearer with a service account token or API token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
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
        return 'grafana';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Grafana',
            'description' => 'Dashboards, data sources, alerts, folders, teams, users, reports, snapshots, and RBAC',
            'icon' => 'ph:chart-line',
            'logo' => 'simple-icons:grafana',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Grafana',
            'description' => 'Manage Grafana dashboards, data sources, alerts, folders, teams, users, snapshots, reports, service accounts, preferences, RBAC, and provisioning resources through the official HTTP API.',
            'icon' => 'ph:chart-line',
            'logo' => 'simple-icons:grafana',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://grafana.com/docs/grafana/latest/developers/http_api/',
            'source_url' => 'https://raw.githubusercontent.com/grafana/grafana/main/public/openapi3.json',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://grafana.example.test/api',
                'hint' => 'Grafana instance API root. Include the /api prefix, for example https://grafana.example.test/api.',
                'default' => 'http://localhost:3000/api',
                'required' => true,
            ],
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Grafana service account token',
                'hint' => 'Create a service account token in Grafana. Older API keys also work where enabled.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the configured Grafana instance by calling the signed-in user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = (string) ($config['api_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'http://localhost:3000/api'), '/');

        if ($apiToken === '') {
            return ['success' => false, 'error' => 'No API token provided.'];
        }

        if ($baseUrl === '') {
            return ['success' => false, 'error' => 'Grafana API base URL is required.'];
        }

        try {
            $response = Http::withToken($apiToken)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl . '/user');

            if (!$response->successful()) {
                $message = $response->json('message') ?? $response->json('error') ?? $response->body();

                return [
                    'success' => false,
                    'error' => "Grafana API error ({$response->status()}): {$message}",
                ];
            }

            $userName = $response->json('name') ?? $response->json('login') ?? $response->json('email') ?? 'authenticated user';

            return [
                'success' => true,
                'message' => "Connected to Grafana as {$userName}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'url' => 'nullable|url',
            'api_token' => 'nullable|string',
        ];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Register generated Grafana OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (GrafanaService::operations() as $slug => $operation) {
            $tools[$slug] = [
                'class' => __NAMESPACE__ . '\\Tools\\' . $operation['class'],
                'type' => $operation['type'] ?? 'read',
                'name' => $operation['name'] ?? $slug,
                'description' => $operation['description'] ?? '',
                'icon' => $this->iconFor($slug, $operation),
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/grafana.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with default or account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context containing an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GrafanaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new GrafanaService(
                apiToken: (string) $creds->get('grafana', 'api_token', '', (string) $account),
                baseUrl: (string) $creds->get('grafana', 'url', 'http://localhost:3000/api', (string) $account),
            );
        }

        return app(GrafanaService::class);
    }

    /**
     * Choose a catalog icon from the operation path.
     *
     * @param  array<string, mixed>  $operation  Operation metadata.
     */
    private function iconFor(string $slug, array $operation): string
    {
        $path = (string) ($operation['path'] ?? '');

        return match (true) {
            str_contains($path, '/dashboards'), str_contains($path, '/search') => 'ph:squares-four',
            str_contains($path, '/datasources') => 'ph:database',
            str_contains($path, '/alert'), str_contains($path, '/provisioning') => 'ph:bell',
            str_contains($path, '/teams') => 'ph:users-three',
            str_contains($path, '/users'), str_contains($path, '/user'), str_contains($path, '/serviceaccounts') => 'ph:user-circle',
            str_contains($path, '/folders') => 'ph:folder',
            str_contains($path, '/reports') => 'ph:file-text',
            str_contains($path, '/snapshots') => 'ph:camera',
            str_contains($path, '/access-control') => 'ph:shield-check',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}
