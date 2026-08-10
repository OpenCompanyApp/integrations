<?php

namespace OpenCompany\Integrations\Wildix;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool provider for the official Wildix WMS/PBX API integration.
 *
 * Exposes generated SDK operations, credential fields, metadata, and
 * multi-account service resolution for host applications.
 */
class WildixToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Requires the PBX API base URL, usually https://{pbx}.wildixin.com.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => ['pbx_api_base_url'],
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
        return 'wildix';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Wildix',
            'description' => 'Business telephony and PBX management',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:wildix',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Wildix',
            'description' => 'WMS/PBX API for call control, users, groups, departments, OAuth clients, notifications, and PBX administration',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:wildix',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.npmjs.com/package/@wildix/wms-api-client',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Wildix WMS/PBX API bearer token',
                'hint' => 'Bearer token used by the official Wildix WMS API client.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'PBX API Base URL',
                'placeholder' => 'https://example.wildixin.com',
                'hint' => 'Use your Wildix PBX host, usually <code>https://{pbx}.wildixin.com</code>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Verify credentials with the lightweight personal info endpoint.
     *
     * @param  array<string, mixed>  $config  Wildix credential configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = trim((string) ($config['access_token'] ?? ''));
        $baseUrl = trim((string) ($config['url'] ?? ''));

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }
        if ($baseUrl === '') {
            return ['success' => false, 'error' => 'No PBX API base URL provided'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->acceptJson()
                ->timeout(10)
                ->get(rtrim($this->configuredBaseUrl($baseUrl), '/').'/api/v1/personal/info');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Wildix API returned HTTP '.$response->status()];
            }

            return ['success' => true, 'message' => 'Connected to Wildix WMS/PBX API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'url' => 'required|string',
        ];
    }

    public function tools(): array
    {
        $tools = [];

        foreach (WildixService::operations() as $operation) {
            $tools[(string) $operation['slug']] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$operation['class'],
                'type' => $operation['type'],
                'name' => $operation['name'],
                'description' => $operation['description'],
                'icon' => str_contains((string) $operation['operation'], 'call') ? 'ph:phone' : 'ph:gear',
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/wildix.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'PBX API Base URL', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Wildix service for default or named account credentials.
     *
     * @param  array<string, mixed>  $context  Host account context.
     */
    private function resolveService(array $context = []): WildixService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new WildixService(
                accessToken: $creds->get('wildix', 'access_token', '', $account),
                baseUrl: $creds->get('wildix', 'url', '', $account),
            );
        }

        return app(WildixService::class);
    }

    /**
     * Normalize a configured PBX host for testConnection without exposing service internals.
     */
    private function configuredBaseUrl(string $baseUrl): string
    {
        $baseUrl = trim($baseUrl);
        if (!str_starts_with($baseUrl, 'http://') && !str_starts_with($baseUrl, 'https://')) {
            $baseUrl = str_ends_with($baseUrl, '.wildixin.com') ? $baseUrl : $baseUrl.'.wildixin.com';

            return 'https://'.$baseUrl;
        }

        return $baseUrl;
    }
}
