<?php

namespace OpenCompany\Integrations\Courier;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Courier.
 *
 * Exposes official Courier API operations generated from the API reference
 * markdown linked by Courier's llms.txt documentation index.
 */
class CourierToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Courier API keys are sent as Bearer tokens. Test and production environments use different keys.'],
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
        return 'courier';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Courier',
            'description' => 'Notifications and messaging',
            'icon' => 'ph:paper-plane-tilt',
            'logo' => 'simple-icons:courier',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Courier',
            'description' => 'Send notifications and manage Courier users, lists, tenants, templates, automations, journeys, logs, brands, and preferences.',
            'icon' => 'ph:paper-plane-tilt',
            'logo' => 'simple-icons:courier',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.courier.com/docs/reference/',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Test a Courier API key with a lightweight messages request.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.courier.com'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withToken($apiKey)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl.'/messages', ['limit' => 1]);

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Courier API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Courier API.'];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Courier API URL', 'required' => false, 'default' => 'https://api.courier.com'],
        ];
    }

    /**
     * Registered Courier operation tools keyed by tool slug.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        $tools = [];
        foreach (CourierService::operations() as $definition) {
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
        return __DIR__.'/../lua-docs/courier.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Courier tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Courier service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): CourierService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CourierService(
                apiKey: $creds->get('courier', 'api_key', '', $account),
                baseUrl: $creds->get('courier', 'url', 'https://api.courier.com', $account),
            );
        }

        return app(CourierService::class);
    }
}
