<?php

namespace OpenCompany\Integrations\Autopilot;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Autopilot.
 *
 * Exposes the official Autopilot API Blueprint operations and resolves default
 * or named account credentials for tool instances.
 */
class AutopilotToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key_header',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Autopilot requires the API key in the autopilotapikey header.'],
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
        return 'autopilot';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Autopilot',
            'description' => 'Contacts, lists, journeys, and REST hooks',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:autopilot',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Autopilot',
            'description' => 'Manage Autopilot contacts, lists, journey ejection, and REST hook subscriptions.',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:autopilot',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://github.com/autopilotdev/autopilotdev.github.io/blob/master/_api_docs/apiary.md',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Test Autopilot credentials with a lightweight REST hook list request.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.autopilothq.com'), '/');
        $baseUrl = str_ends_with($baseUrl, '/v1') ? substr($baseUrl, 0, -3) : $baseUrl;

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'autopilotapikey' => $apiKey,
                'autopilot-sdk-version' => '2.0',
            ])
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl.'/v1/hooks');

            return $response->successful()
                ? ['success' => true, 'message' => 'Connected to Autopilot API.']
                : ['success' => false, 'error' => "Autopilot API returned HTTP {$response->status()}."];
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
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.autopilothq.com'],
        ];
    }

    /**
     * Registered Autopilot operation tools keyed by tool slug.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        $tools = [];
        foreach (AutopilotService::operations() as $definition) {
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
        return __DIR__.'/../script-docs/autopilot.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an Autopilot tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve an Autopilot service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): AutopilotService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AutopilotService(
                apiKey: $creds->get('autopilot', 'api_key', '', $account),
                baseUrl: $creds->get('autopilot', 'url', 'https://api.autopilothq.com', $account),
            );
        }

        return app(AutopilotService::class);
    }
}
