<?php

namespace OpenCompany\Integrations\ArgoCd;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the Argo CD integration.
 *
 * Exposes generated tools for the official Argo CD Swagger document and
 * resolves account-specific Argo CD tokens for host applications.
 */
class ArgoCdToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Argo CD requests use Authorization: Bearer with a user or account token.'],
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
        return 'argocd';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Argo CD',
            'description' => 'GitOps applications, app sets, projects, repositories, clusters, accounts, settings, certificates, and GPG keys',
            'icon' => 'mdi:kubernetes',
            'logo' => 'mdi:kubernetes',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Argo CD',
            'description' => 'Manage Argo CD GitOps applications, application sets, projects, repositories, repo credentials, clusters, accounts, settings, certificates, GPG keys, and API sessions.',
            'icon' => 'mdi:kubernetes',
            'logo' => 'mdi:kubernetes',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://argo-cd.readthedocs.io/en/stable/developer-guide/api-docs/',
            'source_url' => 'https://raw.githubusercontent.com/argoproj/argo-cd/master/assets/swagger.json',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Bearer Token',
                'placeholder' => 'eyJhbGciOi...',
                'hint' => 'Generate an Argo CD account token in the UI or with argocd account generate-token.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Server URL',
                'placeholder' => 'https://argocd.example.com',
                'hint' => 'Use the Argo CD server root URL. Legacy values ending in /api/v1 are accepted.',
                'default' => 'https://argocd.example.com',
            ],
        ];
    }

    /**
     * Test the configured Argo CD token with the current-user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $token = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['base_url'] ?? 'https://argocd.example.com'), '/');

        if ($token === '') {
            return ['success' => false, 'error' => 'No bearer token provided.'];
        }

        if (str_ends_with($baseUrl, '/api/v1')) {
            $baseUrl = substr($baseUrl, 0, -strlen('/api/v1'));
        }

        try {
            $response = Http::withToken($token)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl . '/api/v1/session/userinfo');

            if (!$response->successful()) {
                $message = $response->json('message') ?? $response->json('error') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Argo CD API error (' . $response->status() . '): ' . (is_string($message) ? $message : json_encode($message)),
                ];
            }

            $data = $response->json() ?? [];
            $username = is_array($data) ? ($data['username'] ?? $data['sub'] ?? 'unknown') : 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Argo CD as {$username}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'base_url' => 'nullable|string|url',
        ];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Register generated Argo CD Swagger tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (ArgoCdService::operations() as $slug => $operation) {
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

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/argocd.md';
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
    private function resolveService(array $context = []): ArgoCdService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ArgoCdService(
                token: (string) $creds->get('argocd', 'api_key', '', (string) $account),
                baseUrl: (string) $creds->get('argocd', 'base_url', 'https://argocd.example.com', (string) $account),
            );
        }

        return app(ArgoCdService::class);
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
            str_contains($path, '/applicationsets') => 'mdi:application-braces-outline',
            str_contains($path, '/applications') => 'mdi:application-outline',
            str_contains($path, '/projects') => 'mdi:folder-outline',
            str_contains($path, '/repositories'), str_contains($path, '/repocreds') => 'mdi:source-repository',
            str_contains($path, '/clusters') => 'mdi:kubernetes',
            str_contains($path, '/account') => 'mdi:account-outline',
            str_contains($path, '/certificates'), str_contains($path, '/gpgkeys') => 'mdi:certificate-outline',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}