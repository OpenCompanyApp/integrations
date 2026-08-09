<?php

namespace OpenCompany\Integrations\Canva;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Canva Connect.
 *
 * Exposes official Canva Connect API operations from CanvaOperations and
 * resolves default or named account credentials for tool instances.
 */
class CanvaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'oauth_bearer',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => true,
                'token_keys' => ['access_token', 'client_id', 'client_secret'],
                'notes' => ['Most operations require a user-scoped Canva Connect OAuth access token. OAuth token endpoints can use client credentials or payload credentials.'],
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
        return 'canva';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Canva',
            'description' => 'Canva Connect API',
            'icon' => 'ph:paint-brush',
            'logo' => 'simple-icons:canva',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Canva',
            'description' => 'Create, import, export, resize, comment on, and organize Canva designs and assets.',
            'icon' => 'ph:paint-brush',
            'logo' => 'simple-icons:canva',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.canva.dev/docs/connect/',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Test a Canva bearer token against the current user endpoint.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.canva.com/rest'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl.'/v1/users/me');

            $json = $response->json();
            if ($response->successful() && is_array($json)) {
                return ['success' => true, 'message' => 'Connected to Canva Connect API.'];
            }

            if ($json === null) {
                return ['success' => false, 'error' => "Could not reach Canva API at {$baseUrl}. Check the URL."];
            }

            return ['success' => false, 'error' => "Canva API returned an error (HTTP {$response->status()})."];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'client_id' => 'nullable|string',
            'client_secret' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'client_id', 'type' => 'text', 'label' => 'OAuth Client ID', 'required' => false],
            ['key' => 'client_secret', 'type' => 'secret', 'label' => 'OAuth Client Secret', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'Canva API URL', 'required' => false, 'default' => 'https://api.canva.com/rest'],
        ];
    }

    /**
     * Registered Canva operation tools keyed by tool slug.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        $tools = [];
        foreach (CanvaService::operations() as $definition) {
            $tools[(string) $definition['slug']] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$definition['class'],
                'type' => (string) $definition['type'],
                'name' => (string) $definition['name'],
                'description' => (string) $definition['description'],
                'icon' => $definition['type'] === 'read' ? 'ph:list' : 'ph:pencil-simple',
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/canva.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Canva tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Canva service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): CanvaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CanvaService(
                accessToken: $creds->get('canva', 'access_token', '', $account),
                baseUrl: $creds->get('canva', 'url', 'https://api.canva.com/rest', $account),
                clientId: $creds->get('canva', 'client_id', '', $account),
                clientSecret: $creds->get('canva', 'client_secret', '', $account),
            );
        }

        return app(CanvaService::class);
    }
}
