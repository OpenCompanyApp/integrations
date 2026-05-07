<?php

namespace OpenCompany\Integrations\Meilisearch;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the Meilisearch integration.
 *
 * Exposes generated tools for the official Meilisearch OpenAPI operation map
 * and resolves account-specific API keys and instance URLs for host apps.
 */
class MeilisearchToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe authentication and host support for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Self-hosted Meilisearch instances may allow unauthenticated local access, but production hosts should store the master key or scoped API key.'],
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
        return 'meilisearch';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Meilisearch',
            'description' => 'Search indexes, documents, tasks, settings, keys, and webhooks',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:meilisearch',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Meilisearch',
            'description' => 'Manage Meilisearch indexes, documents, search, tasks, settings, API keys, webhooks, dumps, snapshots, and instance operations through the official HTTP API.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:meilisearch',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.meilisearch.com/docs/reference/api/overview',
            'source_url' => 'https://github.com/meilisearch/meilisearch/releases/download/v1.43.0/meilisearch-openapi.json',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://search.example.test',
                'hint' => 'Base URL of the Meilisearch instance. Local development often uses http://localhost:7700.',
                'default' => 'http://localhost:7700',
                'required' => true,
            ],
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Meilisearch master key or scoped API key',
                'hint' => 'Optional for unauthenticated local instances; recommended for production.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the configured Meilisearch instance by calling the health endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $baseUrl = rtrim((string) ($config['url'] ?? 'http://localhost:7700'), '/');
        $apiKey = (string) ($config['api_key'] ?? '');

        if ($baseUrl === '') {
            return ['success' => false, 'error' => 'Meilisearch instance URL is required.'];
        }

        try {
            $request = Http::acceptJson()->timeout(10);
            if ($apiKey !== '') {
                $request = $request->withToken($apiKey);
            }

            $response = $request->get($baseUrl . '/health');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Meilisearch API returned HTTP ' . $response->status() . '.'];
            }

            $status = $response->json('status') ?? 'available';

            return ['success' => true, 'message' => 'Connected to Meilisearch at ' . $baseUrl . ' (' . $status . ').'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'url' => 'nullable|url',
            'api_key' => 'nullable|string',
        ];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Register generated Meilisearch OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (MeilisearchService::operations() as $slug => $operation) {
            $tools[$slug] = [
                'class' => __NAMESPACE__ . '\\Tools\\' . $operation['class'],
                'type' => $operation['type'] ?? 'read',
                'name' => $operation['name'] ?? $slug,
                'description' => $operation['description'] ?? '',
                'icon' => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
            ];
        }

        return $tools;
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/meilisearch.md';
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
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new $class(new MeilisearchService(
                apiKey: (string) $creds->get('meilisearch', 'api_key', '', (string) $account),
                baseUrl: (string) $creds->get('meilisearch', 'url', 'http://localhost:7700', (string) $account),
            ));
        }

        return new $class(app(MeilisearchService::class));
    }
}
