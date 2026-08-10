<?php

namespace OpenCompany\Integrations\Directus;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the Directus integration.
 *
 * Exposes generated tools for the official Directus OpenAPI specification and
 * resolves account-specific Directus tokens for host applications.
 */
class DirectusToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Directus requests use Authorization: Bearer with a static token or temporary access token.'],
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
        return 'directus';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Directus',
            'description' => 'Items, collections, files, users, roles, permissions, flows, schema, utilities, and versions',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:directus',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Directus',
            'description' => 'Manage Directus content, collections, files, users, roles, permissions, flows, schema, utilities, settings, and content versions through the official REST API.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:directus',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.directus.io/reference/introduction',
            'source_url' => 'https://unpkg.com/@directus/specs@13.0.0/dist/openapi.json',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Directus access token',
                'hint' => 'Generate a static token in Directus user settings or use a temporary access token.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://your-directus.example.com',
                'hint' => 'The base URL of your Directus instance without a trailing slash.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the configured Directus token with the current-user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? ''), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        if ($baseUrl === '') {
            return ['success' => false, 'error' => 'No instance URL provided.'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl . '/users/me');

            if (!$response->successful()) {
                $message = $response->json('errors.0.message') ?? $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => "Directus API error ({$response->status()}): {$message}",
                ];
            }

            $user = $response->json('data');
            $identity = is_array($user) && isset($user['email']) ? " as {$user['email']}" : '';

            return [
                'success' => true,
                'message' => "Connected to Directus{$identity}.",
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
     * Register generated Directus OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (DirectusService::operations() as $slug => $operation) {
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
        return __DIR__ . '/../script-docs/directus.md';
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
    private function resolveService(array $context = []): DirectusService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new DirectusService(
                accessToken: (string) $creds->get('directus', 'access_token', '', (string) $account),
                baseUrl: (string) $creds->get('directus', 'url', 'https://directus.example.com', (string) $account),
            );
        }

        return app(DirectusService::class);
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
            str_contains($path, '/items') => 'ph:database',
            str_contains($path, '/collections') => 'ph:folders',
            str_contains($path, '/files'), str_contains($path, '/assets') => 'ph:file',
            str_contains($path, '/users') => 'ph:user',
            str_contains($path, '/roles'), str_contains($path, '/permissions') => 'ph:shield-check',
            str_contains($path, '/flows'), str_contains($path, '/operations') => 'ph:flow-arrow',
            str_contains($path, '/schema') => 'ph:tree-structure',
            str_contains($path, '/auth') => 'ph:key',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}