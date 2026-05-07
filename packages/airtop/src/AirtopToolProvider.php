<?php

namespace OpenCompany\Integrations\Airtop;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for official Airtop API operations.
 */
class AirtopToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    public function appName(): string
    {
        return 'airtop';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Airtop',
            'description' => 'Cloud browser automation',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:airtop',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Airtop',
            'description' => 'Official Airtop API tools for browser sessions, windows, automation, extraction, files, profiles, and async request status.',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:airtop',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.airtop.ai',
            'source_url' => 'https://docs.airtop.ai/openapi.json',
        ];
    }

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
                'token_keys' => ['api_key'],
                'notes' => ['Requests use the Authorization: Bearer API key header.'],
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

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Airtop API key',
                'hint' => 'Generate an API key in your Airtop account settings.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.airtop.ai/api',
                'hint' => 'Override only if using a custom Airtop-compatible endpoint.',
                'default' => 'https://api.airtop.ai/api',
            ],
        ];
    }

    /**
     * Verify credentials with the official list sessions endpoint.
     *
     * @param  array<string, mixed>  $config  Connection form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.airtop.ai/api'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/v1/sessions');

            if (! $response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Airtop API error: '.(is_string($error) ? $error : json_encode($error)),
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Airtop API.',
            ];
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

    public function tools(): array
    {
        $tools = [];

        foreach (AirtopService::operations() as $operation) {
            $tools[(string) $operation['slug']] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$operation['class'],
                'type' => $operation['type'],
                'name' => $operation['name'],
                'description' => $operation['description'],
                'icon' => $operation['type'] === 'read' ? 'ph:eye' : 'ph:globe',
            ];
        }

        return $tools;
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/airtop.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.airtop.ai/api'],
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
     * Resolve the Airtop service for a default or account-scoped context.
     *
     * @param  array<string, mixed>  $context  Optional host context including account.
     */
    private function resolveService(array $context = []): AirtopService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AirtopService(
                apiKey: $creds->get('airtop', 'api_key', '', $account),
                baseUrl: $creds->get('airtop', 'url', 'https://api.airtop.ai/api', $account),
            );
        }

        return app(AirtopService::class);
    }
}
