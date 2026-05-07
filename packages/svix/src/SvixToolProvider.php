<?php

namespace OpenCompany\Integrations\Svix;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Svix.
 *
 * Exposes official Svix OpenAPI operations and resolves default or named
 * account credentials for tool instances.
 */
class SvixToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'legacy_auth_type' => 'api_token',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['auth_token'],
                'notes' => ['Svix cloud and self-hosted Svix use bearer tokens for API calls.'],
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
        return 'svix';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Svix',
            'description' => 'Webhook delivery, event types, endpoints, streams, ingest, and operational webhooks',
            'icon' => 'ph:webhooks-logo',
            'logo' => 'simple-icons:svix',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Svix',
            'description' => 'Manage Svix applications, messages, endpoints, event types, integrations, streams, ingest sources, connectors, and operational webhooks.',
            'icon' => 'ph:webhooks-logo',
            'logo' => 'simple-icons:svix',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api.svix.com',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Test Svix credentials with a lightweight application list request.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $authToken = (string) ($config['auth_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.svix.com'), '/');

        if ($authToken === '') {
            return ['success' => false, 'error' => 'No auth token provided'];
        }

        try {
            $response = Http::withToken($authToken)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl.'/api/v1/app', ['limit' => 1]);

            return $response->successful()
                ? ['success' => true, 'message' => 'Connected to Svix API.']
                : ['success' => false, 'error' => "Svix API returned HTTP {$response->status()}."];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'auth_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'auth_token', 'type' => 'secret', 'label' => 'Auth Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.svix.com'],
        ];
    }

    /**
     * Registered Svix operation tools keyed by tool slug.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        $tools = [];
        foreach (SvixService::operations() as $definition) {
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

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/svix.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Svix tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Svix service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): SvixService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new SvixService(
                authToken: $creds->get('svix', 'auth_token', '', $account),
                baseUrl: $creds->get('svix', 'url', 'https://api.svix.com', $account),
            );
        }

        return app(SvixService::class);
    }
}
