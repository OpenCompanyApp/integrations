<?php

namespace OpenCompany\Integrations\CustomerIO;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Customer.io.
 *
 * Exposes official Customer.io App, Track, and Pipelines API operations from
 * CustomerIOOperations and resolves default or named account credentials.
 */
class CustomerIOToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'multi_api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key', 'site_id', 'track_api_key', 'pipelines_api_key'],
                'notes' => ['App API operations use bearer auth. Track API operations use site ID plus Track API key. Pipelines API operations use the Pipelines API key as the basic-auth username.'],
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
        return 'customerio';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Customer.io',
            'description' => 'Customer engagement and data platform',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:customerio',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Customer.io',
            'description' => 'Manage Customer.io campaigns, messages, people, objects, tracking events, and CDP pipeline calls.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:customerio',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.customer.io/api/',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Test Customer.io credentials against a non-mutating endpoint when available.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.customer.io'), '/');
        $siteId = (string) ($config['site_id'] ?? '');
        $trackApiKey = (string) ($config['track_api_key'] ?? '');
        $trackBaseUrl = rtrim((string) ($config['track_url'] ?? 'https://track.customer.io'), '/');
        $pipelinesApiKey = (string) ($config['pipelines_api_key'] ?? '');

        try {
            if ($apiKey !== '') {
                $response = Http::withToken($apiKey)
                    ->acceptJson()
                    ->timeout(10)
                    ->get($baseUrl.'/v1/campaigns', ['limit' => 1]);

                return $response->successful()
                    ? ['success' => true, 'message' => 'Connected to Customer.io App API.']
                    : ['success' => false, 'error' => "Customer.io App API returned HTTP {$response->status()}."];
            }

            if ($siteId !== '' && $trackApiKey !== '') {
                $response = Http::withBasicAuth($siteId, $trackApiKey)
                    ->acceptJson()
                    ->timeout(10)
                    ->get($trackBaseUrl.'/api/v1/accounts/region');

                return $response->successful()
                    ? ['success' => true, 'message' => 'Connected to Customer.io Track API.']
                    : ['success' => false, 'error' => "Customer.io Track API returned HTTP {$response->status()}."];
            }

            if ($pipelinesApiKey !== '') {
                return [
                    'success' => true,
                    'message' => 'Customer.io Pipelines credentials are present. The Pipelines API has no non-mutating health endpoint to probe safely.',
                ];
            }

            return ['success' => false, 'error' => 'No Customer.io credentials provided.'];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
            'site_id' => 'nullable|string',
            'track_api_key' => 'nullable|string',
            'track_url' => 'nullable|url',
            'pipelines_api_key' => 'nullable|string',
            'pipelines_url' => 'nullable|url',
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'App API Key', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'App API URL', 'required' => false, 'default' => 'https://api.customer.io'],
            ['key' => 'site_id', 'type' => 'text', 'label' => 'Track Site ID', 'required' => false],
            ['key' => 'track_api_key', 'type' => 'secret', 'label' => 'Track API Key', 'required' => false],
            ['key' => 'track_url', 'type' => 'url', 'label' => 'Track API URL', 'required' => false, 'default' => 'https://track.customer.io'],
            ['key' => 'pipelines_api_key', 'type' => 'secret', 'label' => 'Pipelines API Key', 'required' => false],
            ['key' => 'pipelines_url', 'type' => 'url', 'label' => 'Pipelines API URL', 'required' => false, 'default' => 'https://cdp.customer.io/v1'],
        ];
    }

    /**
     * Registered Customer.io operation tools keyed by tool slug.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        $tools = [];
        foreach (CustomerIOService::operations() as $definition) {
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
        return __DIR__.'/../lua-docs/customerio.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Customer.io tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Customer.io service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): CustomerIOService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CustomerIOService(
                apiKey: $creds->get('customerio', 'api_key', '', $account),
                baseUrl: $creds->get('customerio', 'url', 'https://api.customer.io', $account),
                siteId: $creds->get('customerio', 'site_id', '', $account),
                trackApiKey: $creds->get('customerio', 'track_api_key', '', $account),
                trackBaseUrl: $creds->get('customerio', 'track_url', 'https://track.customer.io', $account),
                pipelinesApiKey: $creds->get('customerio', 'pipelines_api_key', '', $account),
                pipelinesBaseUrl: $creds->get('customerio', 'pipelines_url', 'https://cdp.customer.io/v1', $account),
            );
        }

        return app(CustomerIOService::class);
    }
}
