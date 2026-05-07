<?php

namespace OpenCompany\Integrations\Postman;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Postman.
 *
 * Exposes core Postman API resources plus guarded raw calls for plan-specific endpoints.
 */
class PostmanToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const RAW_TOOLS = [
        'postman_api_get' => ['PostmanApiGet', 'read', 'API GET', 'Call a safe relative Postman API GET path.', 'ph:code'],
        'postman_api_post' => ['PostmanApiPost', 'write', 'API POST', 'Call a safe relative Postman API POST path.', 'ph:code'],
        'postman_api_put' => ['PostmanApiPut', 'write', 'API PUT', 'Call a safe relative Postman API PUT path.', 'ph:code'],
        'postman_api_patch' => ['PostmanApiPatch', 'write', 'API PATCH', 'Call a safe relative Postman API PATCH path.', 'ph:code'],
        'postman_api_delete' => ['PostmanApiDelete', 'write', 'API DELETE', 'Call a safe relative Postman API DELETE path.', 'ph:code'],
    ];

    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'api_key_header', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'required_secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['api_key'], 'notes' => ['Postman API keys are sent in the X-Api-Key header.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'postman'; }
    public function appMeta(): array { return ['label' => 'Postman', 'description' => 'Workspaces, collections, environments, APIs, mocks, monitors, users, groups, and roles', 'icon' => 'ph:planet', 'logo' => 'ph:planet']; }
    public function integrationMeta(): array { return ['name' => 'Postman', 'description' => 'Manage Postman workspaces, collections, environments, APIs, versions, schemas, mock servers, monitors, webhooks, users, groups, workspace roles, and billing metadata.', 'icon' => 'ph:planet', 'logo' => 'ph:planet', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://learning.postman.com/docs/developer/postman-api/intro-api']; }
    public function configSchema(): array { return $this->credentialFields(); }

    /** @param array<string, mixed> $config @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey === '') { return ['success' => false, 'error' => 'Postman API key is required.']; }
            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/') ?: 'https://api.getpostman.com';
            $response = Http::withHeaders(['X-Api-Key' => $apiKey])->acceptJson()->timeout(20)->get($baseUrl.'/me');
            return $response->successful() ? ['success' => true, 'message' => 'Connected to Postman API.'] : ['success' => false, 'error' => 'Postman API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['api_key' => 'required|string', 'url' => 'nullable|string']; }
    public function credentialFields(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'PMAK-...', 'hint' => 'Postman API key.', 'required' => true], ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://api.getpostman.com', 'hint' => 'Optional Postman API base URL override.', 'required' => false]]; }

    public function tools(): array
    {
        $tools = [];
        foreach (PostmanService::operations() as $operation => $definition) {
            [, , , $type, $name, $description] = $definition;
            $class = $this->classNameForOperation($operation);
            $tools['postman_'.$operation] = ['class' => __NAMESPACE__.'\\Tools\\'.$class, 'type' => $type, 'name' => $name, 'description' => $description, 'icon' => $type === 'read' ? 'ph:list' : 'ph:pencil-simple'];
        }
        foreach (self::RAW_TOOLS as $slug => [$class, $type, $name, $description, $icon]) { $tools[$slug] = ['class' => __NAMESPACE__.'\\Tools\\'.$class, 'type' => $type, 'name' => $name, 'description' => $description, 'icon' => $icon]; }
        return $tools;
    }

    public function isIntegration(): bool { return true; }
    /** @param array<string, mixed> $context */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param array<string, mixed> $context */
    private function resolveService(array $context = []): PostmanService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) { $creds = app(CredentialResolver::class); return new PostmanService(apiKey: $creds->get('postman', 'api_key', '', $account), baseUrl: $creds->get('postman', 'url', 'https://api.getpostman.com', $account)); }
        return app(PostmanService::class);
    }
    public function luaDocsPath(): ?string { return __DIR__.'/../lua-docs/postman.md'; }
    private function classNameForOperation(string $operation): string { return 'Postman'.str_replace(' ', '', ucwords(str_replace('_', ' ', $operation))); }
}
