<?php

namespace OpenCompany\Integrations\Pagerduty;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the PagerDuty integration.
 *
 * Exposes generated tools for PagerDuty's official REST OpenAPI document and
 * resolves account-specific API tokens for host applications.
 */
class PagerDutyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'token_keys' => [],
                'notes' => ['PagerDuty REST requests use Authorization: Bearer with a REST API token.'],
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
        return 'pagerduty';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'PagerDuty',
            'description' => 'Incidents, services, escalation policies, schedules, teams, users, automation, analytics, status pages, and webhooks',
            'icon' => 'ph:siren',
            'logo' => 'simple-icons:pagerduty',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'PagerDuty',
            'description' => 'Manage PagerDuty incident response resources through the official REST API, including incidents, services, teams, users, schedules, escalation policies, automation, analytics, status pages, and webhooks.',
            'icon' => 'ph:siren',
            'logo' => 'simple-icons:pagerduty',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.pagerduty.com/api-reference/',
            'source_url' => 'https://raw.githubusercontent.com/PagerDuty/api-schema/main/reference/REST/openapiv3.json',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your PagerDuty REST API token',
                'hint' => 'Generate a REST API token in PagerDuty under Developer Tools > API Access Keys.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.pagerduty.com',
                'hint' => 'Override only for a PagerDuty-compatible API endpoint.',
                'default' => 'https://api.pagerduty.com',
            ],
        ];
    }

    /**
     * Test the configured PagerDuty API token with the current-user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = (string) ($config['api_token'] ?? '');
        $baseUrl = rtrim((string) ($config['base_url'] ?? 'https://api.pagerduty.com'), '/');

        if ($apiToken === '') {
            return ['success' => false, 'error' => 'No API token provided.'];
        }

        try {
            $response = Http::withToken($apiToken)
                ->withHeaders(['Accept' => 'application/vnd.pagerduty+json;version=2'])
                ->timeout(10)
                ->get($baseUrl . '/users/me');

            if (!$response->successful()) {
                $message = $response->json('error.message') ?? $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'PagerDuty API error (' . $response->status() . '): ' . (is_string($message) ? $message : json_encode($message)),
                ];
            }

            $json = $response->json() ?? [];
            $user = is_array($json) ? ($json['user'] ?? $json) : [];
            $name = is_array($user) ? ($user['name'] ?? $user['email'] ?? 'unknown') : 'unknown';

            return ['success' => true, 'message' => "Connected to PagerDuty as {$name}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Register generated PagerDuty OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (PagerdutyService::operations() as $slug => $operation) {
            $tools[$slug] = [
                'class' => __NAMESPACE__ . '\\Tools\\' . $operation['class'],
                'type' => $operation['type'] ?? 'read',
                'name' => $operation['name'] ?? $slug,
                'description' => $operation['description'] ?? '',
                'icon' => $this->iconFor($operation),
            ];
        }

        return $tools;
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pagerduty.md';
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
    private function resolveService(array $context = []): PagerdutyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new PagerdutyService(
                apiToken: (string) $creds->get('pagerduty', 'api_token', '', (string) $account),
                baseUrl: (string) $creds->get('pagerduty', 'base_url', 'https://api.pagerduty.com', (string) $account),
            );
        }

        return app(PagerdutyService::class);
    }

    /**
     * Choose a catalog icon from the operation path.
     *
     * @param  array<string, mixed>  $operation  Operation metadata.
     */
    private function iconFor(array $operation): string
    {
        $path = (string) ($operation['path'] ?? '');

        return match (true) {
            str_contains($path, '/incidents') => 'ph:warning-circle',
            str_contains($path, '/services') => 'ph:cube',
            str_contains($path, '/teams') => 'ph:users-three',
            str_contains($path, '/users') => 'ph:user-circle',
            str_contains($path, '/schedules') => 'ph:calendar',
            str_contains($path, '/escalation_policies') => 'ph:tree-structure',
            str_contains($path, '/automation_actions') => 'ph:robot',
            str_contains($path, '/analytics') => 'ph:chart-bar',
            str_contains($path, '/webhooks') => 'ph:plugs-connected',
            str_contains($path, '/status_pages') => 'ph:heartbeat',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}