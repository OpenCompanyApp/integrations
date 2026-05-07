<?php

namespace OpenCompany\Integrations\TrustMrr;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\TrustMrr\Tools\TrustMrrGetStartup;
use OpenCompany\Integrations\TrustMrr\Tools\TrustMrrListStartups;

/**
 * Exposes TrustMRR startup revenue data tools.
 *
 * The public API currently documents startup listing and startup detail endpoints.
 */
class TrustMrrToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
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
        return 'trustmrr';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'TrustMRR',
            'description' => 'Verified startup revenue data',
            'icon' => 'ph:chart-line-up',
            'logo' => 'ph:chart-line-up',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'TrustMRR',
            'description' => 'Verified startup revenue data and acquisition deals',
            'icon' => 'ph:chart-line-up',
            'logo' => 'ph:chart-line-up',
            'category' => 'data',
            'docs_url' => 'https://trustmrr.com/docs/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'tmrr_...',
                'hint' => 'Generate a TrustMRR API key from the developer dashboard. Keys start with tmrr_.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test TrustMRR API credentials by listing one startup.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://trustmrr.com/api/v1/startups', ['limit' => 1]);

            if ($response->successful()) {
                $meta = $response->json('meta') ?? [];
                $total = $meta['total'] ?? 0;

                return [
                    'success' => true,
                    'message' => "Connected to TrustMRR. {$total} startups available.",
                ];
            }

            $error = $response->json('error') ?? $response->body();

            return [
                'success' => false,
                'error' => 'TrustMRR API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
        ];
    }

    public function tools(): array
    {
        return [
            'trustmrr_list_startups' => [
                'class' => TrustMrrListStartups::class,
                'type' => 'read',
                'name' => 'List Startups',
                'description' => 'Browse and filter startups with verified revenue on TrustMRR.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'trustmrr_get_startup' => [
                'class' => TrustMrrGetStartup::class,
                'type' => 'read',
                'name' => 'Get Startup',
                'description' => 'Get full details for a single TrustMRR startup by slug.',
                'icon' => 'ph:chart-line-up',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/trustmrr.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Create a tool instance with optional account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Optional context with an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the TrustMRR service for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Optional context with an account key.
     */
    private function resolveService(array $context = []): TrustMrrService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new TrustMrrService(
                apiKey: $creds->get('trustmrr', 'api_key', '', $account),
            );
        }

        return app(TrustMrrService::class);
    }
}
