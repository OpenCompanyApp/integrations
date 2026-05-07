<?php

namespace OpenCompany\Integrations\Miniflux;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Miniflux.
 *
 * Exposes feeds, categories, entries, users, API keys, OPML import/export,
 * health probes, version endpoints, and guarded raw API calls.
 */
class MinifluxToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const RAW_TOOLS = [
        'miniflux_api_get' => ['MinifluxApiGet', 'read', 'API GET', 'Call a safe relative Miniflux API GET path.', 'ph:code'],
        'miniflux_api_post' => ['MinifluxApiPost', 'write', 'API POST', 'Call a safe relative Miniflux API POST path.', 'ph:code'],
        'miniflux_api_put' => ['MinifluxApiPut', 'write', 'API PUT', 'Call a safe relative Miniflux API PUT path.', 'ph:code'],
        'miniflux_api_patch' => ['MinifluxApiPatch', 'write', 'API PATCH', 'Call a safe relative Miniflux API PATCH path.', 'ph:code'],
        'miniflux_api_delete' => ['MinifluxApiDelete', 'write', 'API DELETE', 'Call a safe relative Miniflux API DELETE path.', 'ph:code'],
    ];

    /**
     * Describe authentication and host capabilities.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_token_or_basic',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key', 'username', 'password', 'url'],
                'notes' => ['Miniflux prefers X-Auth-Token API keys and also supports HTTP Basic authentication.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => ['A reachable Miniflux instance URL is required.'],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'miniflux'; }

    public function appMeta(): array
    {
        return ['label' => 'Miniflux', 'description' => 'RSS feeds, entries, categories, OPML, users, API keys, and health probes', 'icon' => 'ph:rss', 'logo' => 'ph:rss'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Miniflux',
            'description' => 'Manage Miniflux feeds, categories, entries, users, API keys, OPML import/export, health probes, and version metadata.',
            'icon' => 'ph:rss',
            'logo' => 'ph:rss',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://miniflux.app/docs/api.html',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify Miniflux credentials using the current-user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/');
            $apiKey = (string) ($config['api_key'] ?? '');
            $username = (string) ($config['username'] ?? '');
            $password = (string) ($config['password'] ?? '');

            if ($baseUrl === '') {
                return ['success' => false, 'error' => 'Miniflux instance URL is required.'];
            }

            if ($apiKey === '' && ($username === '' || $password === '')) {
                return ['success' => false, 'error' => 'Miniflux API key or username/password is required.'];
            }

            $http = Http::acceptJson()->timeout(20);
            $http = $apiKey !== '' ? $http->withHeaders(['X-Auth-Token' => $apiKey]) : $http->withBasicAuth($username, $password);
            $response = $http->get($baseUrl.'/v1/me');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Miniflux API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Miniflux API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['url' => 'required|string', 'api_key' => 'nullable|string', 'username' => 'nullable|string', 'password' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'url', 'type' => 'text', 'label' => 'Instance URL', 'placeholder' => 'https://miniflux.example', 'hint' => 'Root URL of the Miniflux instance, without /v1.', 'required' => true],
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Miniflux API token', 'hint' => 'Preferred X-Auth-Token API key from Settings > API Keys.', 'required' => false],
            ['key' => 'username', 'type' => 'text', 'label' => 'Username', 'placeholder' => 'admin', 'hint' => 'Optional Basic auth username fallback.', 'required' => false],
            ['key' => 'password', 'type' => 'secret', 'label' => 'Password', 'placeholder' => 'Miniflux password', 'hint' => 'Optional Basic auth password fallback.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (MinifluxService::operations() as $operation => $definition) {
            [, , , $type, $name, $description] = $definition;
            $class = $this->classNameForOperation($operation);
            $tools['miniflux_'.$operation] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$class,
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'icon' => $type === 'read' ? 'ph:list' : 'ph:pencil-simple',
            ];
        }

        foreach (self::RAW_TOOLS as $slug => [$class, $type, $name, $description, $icon]) {
            $tools[$slug] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$class,
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'icon' => $icon,
            ];
        }

        return $tools;
    }

    public function isIntegration(): bool { return true; }

    /**
     * Create a Miniflux tool instance.
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
    private function resolveService(array $context = []): MinifluxService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new MinifluxService(
                apiKey: $creds->get('miniflux', 'api_key', '', $account),
                username: $creds->get('miniflux', 'username', '', $account),
                password: $creds->get('miniflux', 'password', '', $account),
                baseUrl: $creds->get('miniflux', 'url', 'https://miniflux.example', $account),
            );
        }

        return app(MinifluxService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/miniflux.md';
    }

    private function classNameForOperation(string $operation): string
    {
        return 'Miniflux'.str_replace(' ', '', ucwords(str_replace('_', ' ', $operation)));
    }
}
