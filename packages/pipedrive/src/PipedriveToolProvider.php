<?php

namespace OpenCompany\Integrations\Pipedrive;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the Pipedrive integration.
 *
 * Exposes generated tools for Pipedrive's official v1 and v2 OpenAPI documents
 * and resolves account-specific API tokens for host applications.
 */
class PipedriveToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Pipedrive API requests use the x-api-token header.'],
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
        return 'pipedrive';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Pipedrive',
            'description' => 'CRM deals, contacts, organizations, activities, products, projects, leads, notes, webhooks, goals, and search',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:pipedrive',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pipedrive',
            'description' => 'Manage Pipedrive CRM resources through the official v1 and v2 APIs, including deals, persons, organizations, activities, products, leads, projects, notes, files, webhooks, goals, fields, pipelines, stages, users, and search.',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:pipedrive',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.pipedrive.com/docs/api/v1',
            'source_url' => 'https://developers.pipedrive.com/docs/api/v1/openapi.yaml; https://developers.pipedrive.com/docs/api/v2/openapi.yaml',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Pipedrive API token',
                'hint' => 'Find your token in Pipedrive personal preferences, or use an OAuth access token if your host maps it to this field.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Root URL',
                'placeholder' => 'https://api.pipedrive.com',
                'hint' => 'Versioned URLs ending in /v1 or /api/v2 are normalized to the API root.',
                'default' => 'https://api.pipedrive.com',
            ],
        ];
    }

    /**
     * Test the configured Pipedrive API token with the current-user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = (string) ($config['api_token'] ?? '');
        $baseUrl = $this->normalizeBaseUrl((string) ($config['base_url'] ?? 'https://api.pipedrive.com'));

        if ($apiToken === '') {
            return ['success' => false, 'error' => 'No API token provided.'];
        }

        try {
            $response = Http::withHeaders(['x-api-token' => $apiToken, 'Accept' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/v1/users/me');

            if (!$response->successful()) {
                $message = $response->json('error') ?? $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Pipedrive API error (' . $response->status() . '): ' . (is_string($message) ? $message : json_encode($message)),
                ];
            }

            $json = $response->json() ?? [];
            $user = is_array($json) ? ($json['data'] ?? $json['user'] ?? $json) : [];
            $name = is_array($user) ? ($user['name'] ?? $user['email'] ?? 'authenticated user') : 'authenticated user';

            return ['success' => true, 'message' => "Connected to Pipedrive as {$name}."];
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
     * Register generated Pipedrive OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (PipedriveService::operations() as $slug => $operation) {
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
        return __DIR__ . '/../script-docs/pipedrive.md';
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
    private function resolveService(array $context = []): PipedriveService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new PipedriveService(
                apiToken: (string) $creds->get('pipedrive', 'api_token', '', (string) $account),
                baseUrl: (string) $creds->get('pipedrive', 'base_url', 'https://api.pipedrive.com', (string) $account),
            );
        }

        return app(PipedriveService::class);
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
            str_contains($path, '/deals') => 'ph:handshake',
            str_contains($path, '/persons') => 'ph:user',
            str_contains($path, '/organizations') => 'ph:buildings',
            str_contains($path, '/activities') => 'ph:calendar-check',
            str_contains($path, '/products') => 'ph:package',
            str_contains($path, '/leads') => 'ph:funnel',
            str_contains($path, '/projects') => 'ph:briefcase',
            str_contains($path, '/webhooks') => 'ph:plugs-connected',
            str_contains($path, '/files') => 'ph:paperclip',
            str_contains($path, '/notes') => 'ph:note',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }

    private function normalizeBaseUrl(string $baseUrl): string
    {
        $baseUrl = rtrim($baseUrl, '/');

        foreach (['/api/v2', '/v1'] as $suffix) {
            if (str_ends_with($baseUrl, $suffix)) {
                return substr($baseUrl, 0, -strlen($suffix));
            }
        }

        return $baseUrl;
    }
}
