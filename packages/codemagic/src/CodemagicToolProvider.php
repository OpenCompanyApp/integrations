<?php

namespace OpenCompany\Integrations\Codemagic;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicApiDelete;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicApiGet;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicApiPatch;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicApiPost;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicCancelBuild;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicCreateApp;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicCreateArtifactPublicUrl;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicCreatePrivateApp;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicDeleteCache;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicDeleteCaches;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicGetApp;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicGetArtifact;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicListApps;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicListCaches;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicStartBuild;

/**
 * Tool catalog and configuration metadata for Codemagic.
 *
 * Exposes documented REST API operations for applications, builds, artifacts,
 * caches, and safe raw relative API calls.
 */
class CodemagicToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'token_keys' => ['api_token'],
                'notes' => ['Codemagic uses the x-auth-token request header.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'codemagic';
    }

    public function appMeta(): array
    {
        return ['label' => 'Codemagic', 'description' => 'Mobile CI/CD apps, builds, artifacts, and caches', 'icon' => 'ph:magic-wand', 'logo' => 'ph:magic-wand'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Codemagic',
            'description' => 'Manage Codemagic applications, builds, artifacts, caches, and raw API calls.',
            'icon' => 'ph:magic-wand',
            'logo' => 'ph:magic-wand',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.codemagic.io/rest-api/codemagic-rest-api/',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Verify Codemagic credentials with the applications endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $token = (string) ($config['api_token'] ?? '');
            if ($token === '') {
                return ['success' => false, 'error' => 'Codemagic API token is required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.codemagic.io'), '/');
            $response = Http::withHeaders(['x-auth-token' => $token, 'Accept' => 'application/json'])
                ->timeout(20)
                ->get($baseUrl.'/apps');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Codemagic API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Codemagic API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_token' => 'required|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'placeholder' => 'codemagic-token', 'hint' => 'Codemagic API token from account integrations settings.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://api.codemagic.io', 'hint' => 'Optional Codemagic API base URL.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        return [
            'codemagic_list_apps' => ['class' => CodemagicListApps::class, 'type' => 'read', 'name' => 'List Apps', 'description' => 'List Codemagic applications.', 'icon' => 'ph:app-window'],
            'codemagic_get_app' => ['class' => CodemagicGetApp::class, 'type' => 'read', 'name' => 'Get App', 'description' => 'Get one Codemagic application.', 'icon' => 'ph:app-window'],
            'codemagic_create_app' => ['class' => CodemagicCreateApp::class, 'type' => 'write', 'name' => 'Create App', 'description' => 'Add a repository to Codemagic.', 'icon' => 'ph:plus-circle'],
            'codemagic_create_private_app' => ['class' => CodemagicCreatePrivateApp::class, 'type' => 'write', 'name' => 'Create Private App', 'description' => 'Add a private repository with SSH key details.', 'icon' => 'ph:key'],
            'codemagic_start_build' => ['class' => CodemagicStartBuild::class, 'type' => 'write', 'name' => 'Start Build', 'description' => 'Start a Codemagic build.', 'icon' => 'ph:play'],
            'codemagic_cancel_build' => ['class' => CodemagicCancelBuild::class, 'type' => 'write', 'name' => 'Cancel Build', 'description' => 'Cancel a Codemagic build.', 'icon' => 'ph:x-circle'],
            'codemagic_get_artifact' => ['class' => CodemagicGetArtifact::class, 'type' => 'read', 'name' => 'Get Artifact', 'description' => 'Get an authenticated artifact URL.', 'icon' => 'ph:package'],
            'codemagic_create_artifact_public_url' => ['class' => CodemagicCreateArtifactPublicUrl::class, 'type' => 'write', 'name' => 'Create Artifact Public URL', 'description' => 'Create a public artifact download URL.', 'icon' => 'ph:link'],
            'codemagic_list_caches' => ['class' => CodemagicListCaches::class, 'type' => 'read', 'name' => 'List Caches', 'description' => 'List app caches.', 'icon' => 'ph:database'],
            'codemagic_delete_caches' => ['class' => CodemagicDeleteCaches::class, 'type' => 'write', 'name' => 'Delete Caches', 'description' => 'Delete all app caches.', 'icon' => 'ph:trash'],
            'codemagic_delete_cache' => ['class' => CodemagicDeleteCache::class, 'type' => 'write', 'name' => 'Delete Cache', 'description' => 'Delete one app cache.', 'icon' => 'ph:trash'],
            'codemagic_api_get' => ['class' => CodemagicApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Codemagic GET path.', 'icon' => 'ph:code'],
            'codemagic_api_post' => ['class' => CodemagicApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative Codemagic POST path.', 'icon' => 'ph:code'],
            'codemagic_api_patch' => ['class' => CodemagicApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a safe relative Codemagic PATCH path.', 'icon' => 'ph:code'],
            'codemagic_api_delete' => ['class' => CodemagicApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative Codemagic DELETE path.', 'icon' => 'ph:code'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Codemagic tool instance.
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
    private function resolveService(array $context = []): CodemagicService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CodemagicService(
                apiToken: $creds->get('codemagic', 'api_token', '', $account),
                baseUrl: $creds->get('codemagic', 'url', 'https://api.codemagic.io', $account),
            );
        }

        return app(CodemagicService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/codemagic.md';
    }
}
