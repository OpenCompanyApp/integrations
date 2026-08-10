<?php

namespace OpenCompany\Integrations\DailyCo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Daily.co.
 *
 * Exposes Daily REST API operations from the official generated SDK and
 * resolves default or named account credentials for tool instances.
 */
class DailyCoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Daily API keys are sent as Authorization: Bearer tokens.'],
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
        return 'daily-co';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Daily.co',
            'description' => 'Video rooms, meeting tokens, recordings, analytics, logs, presence, phone numbers, and webhooks',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:dailydotco',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Daily.co',
            'description' => 'Manage Daily video rooms, domain config, meeting tokens, meetings, recordings, transcripts, presence, phone numbers, logs, and webhooks.',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:dailydotco',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.daily.co/reference/rest-api',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Test Daily credentials with a lightweight rooms request.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.daily.co/v1'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withToken($apiKey)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl.'/rooms', ['limit' => 1]);

            return $response->successful()
                ? ['success' => true, 'message' => 'Connected to Daily.co API.']
                : ['success' => false, 'error' => "Daily.co API returned HTTP {$response->status()}."];
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
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.daily.co/v1'],
        ];
    }

    /**
     * Registered Daily operation tools keyed by tool slug.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        $tools = [];
        foreach (DailyCoService::operations() as $definition) {
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
        return __DIR__.'/../script-docs/daily-co.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Daily tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Daily service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): DailyCoService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new DailyCoService(
                apiKey: $creds->get('daily-co', 'api_key', '', $account),
                baseUrl: $creds->get('daily-co', 'url', 'https://api.daily.co/v1', $account),
            );
        }

        return app(DailyCoService::class);
    }
}
