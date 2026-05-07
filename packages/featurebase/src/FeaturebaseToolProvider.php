<?php

namespace OpenCompany\Integrations\Featurebase;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Featurebase.
 *
 * Exposes the versioned Featurebase API for feedback, changelogs, contacts,
 * companies, help center content, conversations, tickets, tags, and webhooks.
 */
class FeaturebaseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe authentication and host capabilities.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_token',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Featurebase uses Authorization: Bearer <api-key> and Featurebase-Version headers.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'featurebase'; }

    public function appMeta(): array
    {
        return ['label' => 'Featurebase', 'description' => 'Feedback, support, help center, tickets, contacts, and webhooks', 'icon' => 'ph:megaphone', 'logo' => 'ph:megaphone'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Featurebase',
            'description' => 'Manage Featurebase feedback, posts, changelogs, contacts, companies, help center articles, conversations, tickets, tags, and webhooks.',
            'icon' => 'ph:megaphone',
            'logo' => 'ph:megaphone',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.featurebase.app/rest-api',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify Featurebase credentials with the boards endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey === '') {
                return ['success' => false, 'error' => 'Featurebase API key is required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/') ?: 'https://do.featurebase.app';
            $version = (string) ($config['api_version'] ?? '2026-01-01.nova');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Featurebase-Version' => $version,
                'Accept' => 'application/json',
            ])->timeout(20)->get($baseUrl.'/v2/boards');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Featurebase API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Featurebase API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string', 'url' => 'nullable|string', 'api_version' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'sk_...', 'hint' => 'Featurebase organization API key.', 'required' => true],
            ['key' => 'api_version', 'type' => 'text', 'label' => 'API Version', 'placeholder' => '2026-01-01.nova', 'hint' => 'Pinned Featurebase API version header.', 'required' => false],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://do.featurebase.app', 'hint' => 'Optional Featurebase base URL override or mock server.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (FeaturebaseService::operations() as $operation => $definition) {
            $tools[(string) $definition['slug']] = [
                'class' => __NAMESPACE__.'\\Tools\\'.(string) $definition['class'],
                'type' => (string) $definition['type'],
                'name' => (string) $definition['name'],
                'description' => (string) $definition['description'],
                'icon' => $definition['type'] === 'read' ? 'ph:list' : 'ph:pencil-simple',
            ];
        }

        foreach ([
            'featurebase_api_get' => ['FeaturebaseApiGet', 'read', 'API GET'],
            'featurebase_api_post' => ['FeaturebaseApiPost', 'write', 'API POST'],
            'featurebase_api_patch' => ['FeaturebaseApiPatch', 'write', 'API PATCH'],
            'featurebase_api_delete' => ['FeaturebaseApiDelete', 'write', 'API DELETE'],
        ] as $slug => [$class, $type, $name]) {
            $tools[$slug] = ['class' => __NAMESPACE__.'\\Tools\\'.$class, 'type' => $type, 'name' => $name, 'description' => 'Call a safe relative Featurebase '.$name.' path.', 'icon' => 'ph:code'];
        }

        return $tools;
    }

    public function isIntegration(): bool { return true; }

    /**
     * Create a Featurebase tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
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
    private function resolveService(array $context = []): FeaturebaseService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new FeaturebaseService(
                apiKey: $creds->get('featurebase', 'api_key', '', $account),
                baseUrl: $creds->get('featurebase', 'url', 'https://do.featurebase.app', $account),
                apiVersion: $creds->get('featurebase', 'api_version', '2026-01-01.nova', $account),
            );
        }

        return app(FeaturebaseService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/featurebase.md';
    }
}
