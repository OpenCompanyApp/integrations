<?php

namespace OpenCompany\Integrations\Typesense;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the Typesense integration.
 *
 * Exposes generated tools for Typesense's official OpenAPI document and
 * resolves account-specific API keys for host applications.
 */
class TypesenseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['Typesense requests use the X-TYPESENSE-API-KEY header.'],
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
        return 'typesense';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Typesense',
            'description' => 'Search collections, documents, aliases, synonyms, curation, keys, analytics, presets, stopwords, and operations',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:typesense',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Typesense',
            'description' => 'Manage Typesense search collections, documents, aliases, API keys, synonym sets, curation sets, analytics rules, presets, stopwords, overrides, and cluster operations through the official REST API.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:typesense',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://typesense.org/docs/latest/api/',
            'source_url' => 'https://raw.githubusercontent.com/typesense/typesense-api-spec/master/openapi.yml',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Enter your Typesense API key', 'hint' => 'Use an admin key for write operations or a scoped search key for read/search-only operations.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Typesense URL', 'placeholder' => 'http://localhost:8108', 'hint' => 'The base URL of your Typesense node or cluster.', 'default' => 'http://localhost:8108'],
        ];
    }

    /**
     * Test the configured Typesense API key with the health endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'http://localhost:8108'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders(['X-TYPESENSE-API-KEY' => $apiKey, 'Accept' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/health');

            if (!$response->successful()) {
                return ['success' => false, 'error' => "Typesense health check failed at {$baseUrl}. Status: {$response->status()}."];
            }

            return ['success' => true, 'message' => "Connected to Typesense at {$baseUrl}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string', 'url' => 'nullable|url'];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Register generated Typesense OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (TypesenseService::operations() as $slug => $operation) {
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

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/typesense.md';
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
    private function resolveService(array $context = []): TypesenseService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new TypesenseService(
                apiKey: (string) $creds->get('typesense', 'api_key', '', (string) $account),
                baseUrl: (string) $creds->get('typesense', 'url', 'http://localhost:8108', (string) $account),
            );
        }

        return app(TypesenseService::class);
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
            str_contains($path, '/collections') => 'ph:database',
            str_contains($path, '/documents') => 'ph:file-text',
            str_contains($path, '/keys') => 'ph:key',
            str_contains($path, '/aliases') => 'ph:arrows-left-right',
            str_contains($path, '/synonym') => 'ph:git-merge',
            str_contains($path, '/curation') => 'ph:magic-wand',
            str_contains($path, '/analytics') => 'ph:chart-bar',
            str_contains($path, '/operations') => 'ph:gear',
            str_contains($path, '/health') => 'ph:heartbeat',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}
