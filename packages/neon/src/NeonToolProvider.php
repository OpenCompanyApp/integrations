<?php

namespace OpenCompany\Integrations\Neon;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the Neon integration.
 *
 * Exposes generated tools for Neon's official OpenAPI document and resolves
 * account-specific Neon API keys for host applications.
 */
class NeonToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Neon requests use Authorization: Bearer with a Neon API key.'],
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
        return 'neon';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Neon',
            'description' => 'Serverless Postgres projects, branches, computes, databases, roles, operations, API keys, organizations, auth, and billing',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:neon',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Neon',
            'description' => 'Manage Neon serverless Postgres projects, branches, computes, databases, roles, operations, API keys, organizations, permissions, Neon Auth, consumption, and billing settings through the official API.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:neon',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://neon.com/docs/reference/api-reference',
            'source_url' => 'https://neon.com/api_spec/release/v2.json',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Neon API key',
                'hint' => 'Generate an API key in the Neon Console under Account Settings > API Keys.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://console.neon.tech/api/v2',
                'hint' => 'Override only if using a custom Neon-compatible endpoint.',
                'default' => 'https://console.neon.tech/api/v2',
            ],
        ];
    }

    /**
     * Test the configured Neon API key with the current-user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://console.neon.tech/api/v2'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl . '/users/me');

            if (!$response->successful()) {
                $message = $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Neon API error (' . $response->status() . '): ' . (is_string($message) ? $message : json_encode($message)),
                ];
            }

            $json = $response->json() ?? [];
            $user = is_array($json) ? ($json['user'] ?? $json) : [];
            $email = is_array($user) ? ($user['email'] ?? 'unknown') : 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Neon as {$email}.",
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
     * Register generated Neon OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (NeonService::operations() as $slug => $operation) {
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
        return __DIR__ . '/../script-docs/neon.md';
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
    private function resolveService(array $context = []): NeonService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new NeonService(
                accessToken: (string) $creds->get('neon', 'access_token', '', (string) $account),
                baseUrl: (string) $creds->get('neon', 'url', 'https://console.neon.tech/api/v2', (string) $account),
            );
        }

        return app(NeonService::class);
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
            str_contains($path, '/branches') => 'ph:git-branch',
            str_contains($path, '/databases') => 'ph:database',
            str_contains($path, '/roles') => 'ph:user-gear',
            str_contains($path, '/endpoints') => 'ph:cpu',
            str_contains($path, '/api_keys') => 'ph:key',
            str_contains($path, '/organizations') => 'ph:buildings',
            str_contains($path, '/auth') => 'ph:shield-check',
            str_contains($path, '/billing'), str_contains($path, '/consumption') => 'ph:chart-bar',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}
