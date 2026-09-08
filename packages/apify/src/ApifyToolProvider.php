<?php

namespace OpenCompany\Integrations\Apify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for official Apify API operations.
 */
class ApifyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    public function appName(): string
    {
        return 'apify';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Apify',
            'description' => 'Web scraping and automation platform',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:apify',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Apify',
            'description' => 'Official Apify API tools for actors, runs, tasks, datasets, key-value stores, request queues, webhooks, schedules, users, and tools.',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:apify',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.apify.com/api/v2',
            'source_url' => 'https://docs.apify.com/api/openapi.json',
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
                'strategy' => 'api_token',
                'legacy_auth_type' => 'api_token',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_token'],
                'notes' => ['Requests use the Authorization: Bearer API token header.'],
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
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Apify API token',
                'hint' => 'Find your API token in Apify settings under Integrations.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.apify.com',
                'hint' => 'Use the default Apify Cloud URL. Existing /v2-suffixed values remain supported.',
                'default' => 'https://api.apify.com',
            ],
        ];
    }

    /**
     * Verify credentials with the official current user endpoint.
     *
     * @param  array<string, mixed>  $config  Connection form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = (string) ($config['api_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.apify.com'), '/');

        if ($apiToken === '') {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($this->urlFor($baseUrl, '/v2/users/me'));

            if (! $response->successful()) {
                $error = $response->json('error.message') ?? $response->json('error') ?? $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Apify API error: '.(is_string($error) ? $error : json_encode($error)),
                ];
            }

            $username = $response->json('data.username') ?? 'user';

            return [
                'success' => true,
                'message' => "Connected to Apify API as {$username}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        $tools = [];

        foreach (ApifyService::operations() as $operation) {
            $tools[(string) $operation['slug']] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$operation['class'],
                'type' => $operation['type'],
                'name' => $operation['name'],
                'description' => $operation['description'],
                'icon' => $operation['type'] === 'read' ? 'ph:eye' : 'ph:robot',
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/apify.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Apify API URL', 'required' => false, 'default' => 'https://api.apify.com'],
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
     * Resolve the Apify service for a default or account-scoped context.
     *
     * @param  array<string, mixed>  $context  Optional host context including account.
     */
    private function resolveService(array $context = []): ApifyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ApifyService(
                apiToken: $creds->get('apify', 'api_token', '', $account),
                baseUrl: $creds->get('apify', 'url', 'https://api.apify.com', $account),
            );
        }

        return app(ApifyService::class);
    }

    /**
     * Build a request URL while tolerating the old /v2-suffixed base URL.
     */
    private function urlFor(string $baseUrl, string $path): string
    {
        if (str_ends_with($baseUrl, '/v2') && str_starts_with($path, '/v2/')) {
            return $baseUrl.substr($path, 3);
        }

        return $baseUrl.$path;
    }
}
