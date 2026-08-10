<?php

namespace OpenCompany\Integrations\Docker;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the Docker Hub integration.
 *
 * Exposes generated tools for Docker's official Hub OpenAPI document and
 * resolves account-specific Docker Hub access tokens for host applications.
 */
class DockerToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Docker Hub requests use Authorization: Bearer with a personal access token or API bearer token.'],
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
        return 'docker';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Docker Hub',
            'description' => 'Repositories, tags, access tokens, organizations, groups, invites, audit logs, and SCIM',
            'icon' => 'ph:package',
            'logo' => 'simple-icons:docker',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Docker Hub',
            'description' => 'Manage Docker Hub repositories, tags, access tokens, organization settings, members, groups, invites, audit logs, and SCIM resources through the official Hub API.',
            'icon' => 'ph:package',
            'logo' => 'simple-icons:docker',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.docker.com/reference/api/hub/latest/',
            'source_url' => 'https://docs.docker.com/reference/api/hub/latest.yaml',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Docker Hub access token',
                'hint' => 'Generate a personal access token from Docker Hub under Account Settings > Security.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Root URL',
                'placeholder' => 'https://hub.docker.com',
                'hint' => 'Use https://hub.docker.com unless targeting a compatible endpoint. Legacy values ending in /v2 are still accepted.',
                'default' => 'https://hub.docker.com',
            ],
        ];
    }

    /**
     * Test the configured Docker Hub token with a lightweight access-token call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://hub.docker.com'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $url = str_ends_with($baseUrl, '/v2') ? $baseUrl . '/access-tokens' : $baseUrl . '/v2/access-tokens';
            $response = Http::withToken($accessToken)
                ->acceptJson()
                ->timeout(10)
                ->get($url);

            if (!$response->successful()) {
                $message = $response->json('detail') ?? $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => "Docker Hub API error ({$response->status()}): {$message}",
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Docker Hub.',
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
     * Register generated Docker Hub OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (DockerService::operations() as $slug => $operation) {
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
        return __DIR__ . '/../script-docs/docker.md';
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
    private function resolveService(array $context = []): DockerService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new DockerService(
                accessToken: (string) $creds->get('docker', 'access_token', '', (string) $account),
                baseUrl: (string) $creds->get('docker', 'url', 'https://hub.docker.com', (string) $account),
            );
        }

        return app(DockerService::class);
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
            str_contains($path, '/repositories') => 'ph:package',
            str_contains($path, '/tags') => 'ph:tag',
            str_contains($path, '/access-tokens') => 'ph:key',
            str_contains($path, '/orgs') => 'ph:buildings',
            str_contains($path, '/members'), str_contains($path, '/groups'), str_contains($path, '/Users') => 'ph:users',
            str_contains($path, '/auditlogs') => 'ph:list-magnifying-glass',
            str_contains($path, '/scim') => 'ph:identification-card',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}
