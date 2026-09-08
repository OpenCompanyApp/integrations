<?php

namespace OpenCompany\Integrations\Raindrop;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Raindrop.io.
 *
 * Exposes official Raindrop.io REST API operations from RaindropOperations and
 * resolves default or named account credentials for tool instances.
 */
class RaindropToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Raindrop.io uses OAuth access tokens in the Authorization: Bearer header.'],
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
        return 'raindrop';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Raindrop.io',
            'description' => 'Bookmark manager, collections, tags, highlights, import, export, and backups',
            'icon' => 'ph:bookmark-simple',
            'logo' => 'simple-icons:raindropio',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Raindrop.io',
            'description' => 'Manage Raindrop.io bookmarks, collections, tags, highlights, filters, imports, exports, backups, and user settings.',
            'icon' => 'ph:bookmark-simple',
            'logo' => 'simple-icons:raindropio',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.raindrop.io/',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Test Raindrop.io credentials with the current user endpoint.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.raindrop.io/rest/v1'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl.'/user');

            if (!$response->successful()) {
                return ['success' => false, 'error' => "Raindrop.io API returned HTTP {$response->status()}."];
            }

            return ['success' => true, 'message' => 'Connected to Raindrop.io API.'];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.raindrop.io/rest/v1'],
        ];
    }

    /**
     * Registered Raindrop.io operation tools keyed by tool slug.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        $tools = [];
        foreach (RaindropService::operations() as $definition) {
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
        return __DIR__.'/../script-docs/raindrop.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Raindrop.io tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Raindrop.io service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): RaindropService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new RaindropService(
                accessToken: $creds->get('raindrop', 'access_token', '', $account),
                baseUrl: $creds->get('raindrop', 'url', 'https://api.raindrop.io/rest/v1', $account),
            );
        }

        return app(RaindropService::class);
    }
}
