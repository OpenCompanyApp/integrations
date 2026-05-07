<?php

namespace OpenCompany\Integrations\Confluent;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Confluent Cloud.
 *
 * Exposes generated coverage for Confluent's official Cloud API OpenAPI
 * document and resolves account-specific credentials for host applications.
 */
class ConfluentToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key_basic_or_bearer_token',
                'legacy_auth_type' => 'api_token',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret', 'manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Cloud API keys use HTTP Basic auth with api_key and api_secret. Resource/OAuth tokens can be supplied as access_token.'],
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
        return 'confluent';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Confluent Cloud',
            'description' => 'Kafka, Schema Registry, Flink, networking, IAM, billing, and streaming platform APIs',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:confluent',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Confluent Cloud',
            'description' => 'Manage Confluent Cloud Kafka, Schema Registry, Connect, Flink, networking, IAM, API keys, billing, catalog, stream sharing, provider integrations, Tableflow, and related Cloud resources through the official REST APIs.',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:confluent',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.confluent.io/cloud/current/api.html',
            'source_url' => 'https://docs.confluent.io/cloud/current/openapi.yaml',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'text', 'label' => 'Cloud API Key', 'placeholder' => 'Enter your Confluent Cloud API key id', 'hint' => 'Used with API Secret for HTTP Basic auth to Confluent Cloud APIs.', 'required' => false],
            ['key' => 'api_secret', 'type' => 'secret', 'label' => 'Cloud API Secret', 'placeholder' => 'Enter your Confluent Cloud API secret', 'hint' => 'Used with Cloud API Key for HTTP Basic auth.', 'required' => false],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'OAuth, STS, external, or partner bearer token', 'required' => false],
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'Legacy API Token', 'placeholder' => 'Legacy bearer token value', 'required' => false],
            ['key' => 'cluster_id', 'type' => 'text', 'label' => 'Default Kafka Cluster ID', 'placeholder' => 'lkc-abc123', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.confluent.cloud', 'default' => 'https://api.confluent.cloud', 'required' => false],
        ];
    }

    /**
     * Test the configured Confluent Cloud credentials with the environments endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $apiSecret = (string) ($config['api_secret'] ?? '');
        $accessToken = (string) ($config['access_token'] ?? '');
        $apiToken = (string) ($config['api_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.confluent.cloud'), '/');

        if (($apiKey === '' || $apiSecret === '') && $accessToken === '' && $apiToken === '') {
            return ['success' => false, 'error' => 'Provide a Confluent api_key/api_secret pair or an access token.'];
        }

        $headers = ['Accept' => 'application/json'];
        if ($apiKey !== '' && $apiSecret !== '') {
            $headers['Authorization'] = 'Basic ' . base64_encode($apiKey . ':' . $apiSecret);
        } else {
            $headers['Authorization'] = 'Bearer ' . ($accessToken !== '' ? $accessToken : $apiToken);
        }

        try {
            $response = Http::withHeaders($headers)->timeout(10)->get($baseUrl . '/org/v2/environments', ['page_size' => 1]);

            if (!$response->successful()) {
                $message = $response->json('errors') ?? $response->json('message') ?? $response->body();

                return ['success' => false, 'error' => 'Confluent Cloud API returned HTTP ' . $response->status() . ': ' . (is_string($message) ? $message : json_encode($message))];
            }

            return ['success' => true, 'message' => 'Connected to Confluent Cloud at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string', 'api_secret' => 'nullable|string', 'access_token' => 'nullable|string', 'api_token' => 'nullable|string', 'cluster_id' => 'nullable|string', 'url' => 'nullable|url'];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Register generated Confluent Cloud OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (ConfluentService::operations() as $slug => $operation) {
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
        return __DIR__ . '/../lua-docs/confluent.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally resolving credentials for a specific account.
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
    private function resolveService(array $context = []): ConfluentService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ConfluentService(
                apiKey: (string) $creds->get('confluent', 'api_key', '', (string) $account),
                apiSecret: (string) $creds->get('confluent', 'api_secret', '', (string) $account),
                accessToken: (string) $creds->get('confluent', 'access_token', '', (string) $account),
                apiToken: (string) $creds->get('confluent', 'api_token', '', (string) $account),
                clusterId: (string) $creds->get('confluent', 'cluster_id', '', (string) $account),
                baseUrl: (string) $creds->get('confluent', 'url', 'https://api.confluent.cloud', (string) $account),
            );
        }

        return app(ConfluentService::class);
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
            str_contains($path, '/kafka/') => 'ph:queue',
            str_contains($path, '/iam/') => 'ph:users-three',
            str_contains($path, '/org/') => 'ph:tree-structure',
            str_contains($path, '/networking/') => 'ph:globe',
            str_contains($path, '/billing/') => 'ph:receipt',
            str_contains($path, '/srcm/') || str_contains($path, '/schemas') || str_contains($path, '/catalog') => 'ph:database',
            str_contains($path, '/connect') => 'ph:plugs-connected',
            str_contains($path, '/flink') || str_contains($path, '/sql') => 'ph:terminal-window',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}
