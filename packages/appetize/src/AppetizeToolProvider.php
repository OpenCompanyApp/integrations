<?php

namespace OpenCompany\Integrations\Appetize;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Appetize\Tools\AppetizeApiDelete;
use OpenCompany\Integrations\Appetize\Tools\AppetizeApiGet;
use OpenCompany\Integrations\Appetize\Tools\AppetizeApiPost;
use OpenCompany\Integrations\Appetize\Tools\AppetizeCreateApp;
use OpenCompany\Integrations\Appetize\Tools\AppetizeDeleteApp;
use OpenCompany\Integrations\Appetize\Tools\AppetizeGetApp;
use OpenCompany\Integrations\Appetize\Tools\AppetizeGetUsageSummary;
use OpenCompany\Integrations\Appetize\Tools\AppetizeListAllApps;
use OpenCompany\Integrations\Appetize\Tools\AppetizeListApps;
use OpenCompany\Integrations\Appetize\Tools\AppetizeListDevices;
use OpenCompany\Integrations\Appetize\Tools\AppetizeUpdateApp;

/**
 * Tool catalog and configuration metadata for Appetize.
 *
 * Exposes Appetize REST API operations for apps, app groups, usage summaries,
 * device metadata, and safe raw relative API calls.
 */
class AppetizeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Appetize uses the X-API-KEY request header.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'appetize'; }

    public function appMeta(): array
    {
        return ['label' => 'Appetize', 'description' => 'Mobile app streaming uploads, app metadata, usage, and devices', 'icon' => 'ph:device-mobile', 'logo' => 'ph:device-mobile'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Appetize',
            'description' => 'Manage Appetize apps, app groups, usage summaries, devices, and raw API calls.',
            'icon' => 'ph:device-mobile',
            'logo' => 'ph:device-mobile',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.appetize.io/rest-api',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify Appetize credentials with the apps endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey === '') {
                return ['success' => false, 'error' => 'Appetize API key is required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/') ?: 'https://api.appetize.io';
            $response = Http::withHeaders(['X-API-KEY' => $apiKey, 'Accept' => 'application/json'])
                ->timeout(20)
                ->get($baseUrl.'/v1/apps');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Appetize API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Appetize API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'appetize-token', 'hint' => 'Appetize API token from organization settings.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://api.appetize.io', 'hint' => 'Optional API base URL for private instances.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        return [
            'appetize_list_apps' => ['class' => AppetizeListApps::class, 'type' => 'read', 'name' => 'List Apps', 'description' => 'List Appetize apps with pagination.', 'icon' => 'ph:list'],
            'appetize_list_all_apps' => ['class' => AppetizeListAllApps::class, 'type' => 'read', 'name' => 'List All Apps', 'description' => 'List all Appetize apps without pagination.', 'icon' => 'ph:list-bullets'],
            'appetize_get_app' => ['class' => AppetizeGetApp::class, 'type' => 'read', 'name' => 'Get App', 'description' => 'Get one app or app group by public key.', 'icon' => 'ph:device-mobile'],
            'appetize_create_app' => ['class' => AppetizeCreateApp::class, 'type' => 'write', 'name' => 'Create App', 'description' => 'Create a new Appetize app from a public URL.', 'icon' => 'ph:plus-circle'],
            'appetize_update_app' => ['class' => AppetizeUpdateApp::class, 'type' => 'write', 'name' => 'Update App', 'description' => 'Update an app build or settings.', 'icon' => 'ph:pencil'],
            'appetize_delete_app' => ['class' => AppetizeDeleteApp::class, 'type' => 'write', 'name' => 'Delete App', 'description' => 'Delete one Appetize app.', 'icon' => 'ph:trash'],
            'appetize_get_usage_summary' => ['class' => AppetizeGetUsageSummary::class, 'type' => 'read', 'name' => 'Get Usage Summary', 'description' => 'Get account usage summary.', 'icon' => 'ph:chart-line'],
            'appetize_list_devices' => ['class' => AppetizeListDevices::class, 'type' => 'read', 'name' => 'List Devices', 'description' => 'List supported Appetize devices and OS versions.', 'icon' => 'ph:devices'],
            'appetize_api_get' => ['class' => AppetizeApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Appetize GET path.', 'icon' => 'ph:code'],
            'appetize_api_post' => ['class' => AppetizeApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative Appetize POST path.', 'icon' => 'ph:code'],
            'appetize_api_delete' => ['class' => AppetizeApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative Appetize DELETE path.', 'icon' => 'ph:code'],
        ];
    }

    public function isIntegration(): bool { return true; }

    /**
     * Create an Appetize tool instance.
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
    private function resolveService(array $context = []): AppetizeService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AppetizeService(
                apiKey: $creds->get('appetize', 'api_key', '', $account),
                baseUrl: $creds->get('appetize', 'url', 'https://api.appetize.io', $account),
            );
        }

        return app(AppetizeService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/appetize.md';
    }
}
