<?php

namespace OpenCompany\Integrations\CockroachDb;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the CockroachDB Cloud integration.
 *
 * Exposes generated tools for the official CockroachDB Cloud OpenAPI document
 * and resolves account-specific Cloud API keys for host applications.
 */
class CockroachDbToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'token_keys' => ['access_token'],
                'notes' => ['CockroachDB Cloud API requests use Authorization: Bearer with a Cloud API key.'],
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
        return 'cockroachdb';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'CockroachDB',
            'description' => 'Cloud clusters, databases, SQL users, API keys, roles, folders, metrics, backups, and SCIM',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:cockroachlabs',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'CockroachDB',
            'description' => 'Manage CockroachDB Cloud clusters, databases, SQL users, backups, maintenance windows, metrics, folders, roles, API keys, CMEK, networking, and SCIM resources.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:cockroachlabs',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.cockroachlabs.com/docs/api/cloud/v1.html',
            'source_url' => 'https://cockroachlabs.cloud/assets/docs/api/latest/openapi.json',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your CockroachDB Cloud API key',
                'hint' => 'Generate an API key in the CockroachDB Cloud Console under Organization Settings > API Keys.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Root URL',
                'placeholder' => 'https://cockroachlabs.cloud',
                'hint' => 'Use https://cockroachlabs.cloud unless targeting a compatible endpoint. Legacy values ending in /api/v1 are still accepted for Cloud v1 tools.',
                'default' => 'https://cockroachlabs.cloud',
            ],
        ];
    }

    /**
     * Test the configured CockroachDB Cloud token with a lightweight clusters call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://cockroachlabs.cloud'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $url = str_ends_with($baseUrl, '/api/v1') ? $baseUrl . '/clusters' : $baseUrl . '/api/v1/clusters';
            $response = Http::withToken($accessToken)
                ->acceptJson()
                ->timeout(10)
                ->get($url);

            if (!$response->successful()) {
                $message = $response->json('message') ?? $response->json('error') ?? $response->body();

                return [
                    'success' => false,
                    'error' => "CockroachDB Cloud API error ({$response->status()}): {$message}",
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to CockroachDB Cloud.',
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Register generated CockroachDB Cloud OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (CockroachDbService::operations() as $slug => $operation) {
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
        return __DIR__ . '/../lua-docs/cockroachdb.md';
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
    private function resolveService(array $context = []): CockroachDbService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CockroachDbService(
                accessToken: (string) $creds->get('cockroachdb', 'access_token', '', (string) $account),
                baseUrl: (string) $creds->get('cockroachdb', 'url', 'https://cockroachlabs.cloud', (string) $account),
            );
        }

        return app(CockroachDbService::class);
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
            str_contains($path, '/clusters') => 'ph:database',
            str_contains($path, '/databases') => 'ph:folder',
            str_contains($path, '/sql-users'), str_contains($path, '/Users'), str_contains($path, '/Groups') => 'ph:users',
            str_contains($path, '/api-keys') => 'ph:key',
            str_contains($path, '/roles') => 'ph:shield-check',
            str_contains($path, '/backups') => 'ph:archive',
            str_contains($path, '/folders') => 'ph:folder-open',
            str_contains($path, '/networking') => 'ph:network',
            str_contains($path, '/metrics') => 'ph:chart-line',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}
