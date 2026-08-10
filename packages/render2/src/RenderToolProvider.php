<?php

namespace OpenCompany\Integrations\Render2;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides Render tools and configuration metadata for integration hosts.
 *
 * Exposes generated coverage for Render's official public OpenAPI registry
 * while preserving the canonical `render` app name for host discovery.
 */
class RenderToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'token_keys' => ['api_key'],
                'notes' => ['Render public API requests use Authorization: Bearer with a Render API key.'],
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
        return 'render';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Render',
            'description' => 'Cloud services, deploys, databases, projects, logs, metrics, jobs, and workflows',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:render',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Render',
            'description' => 'Manage Render services, deploys, jobs, databases, key value stores, projects, environments, logs, metrics, webhooks, workflows, and account resources.',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:render',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://api-docs.render.com/',
            'source_url' => 'https://api-docs.render.com/openapi/render-public-api-1.json',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Render API key',
                'hint' => 'Generate an API key in the Render dashboard under Account Settings > API Keys.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.render.com/v1',
                'hint' => 'Override only if using a custom Render-compatible endpoint.',
                'default' => 'https://api.render.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Render API.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.render.com/v1'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withToken($apiKey)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl . '/users');

            if (!$response->successful()) {
                $message = $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => "Render API error ({$response->status()}): {$message}",
                ];
            }

            $email = $response->json('email') ?? $response->json('user.email') ?? 'authenticated user';

            return [
                'success' => true,
                'message' => "Connected to Render as {$email}.",
            ];
        } catch (\Throwable $e) {
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

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (RenderService::operations() as $slug => $operation) {
            $tools[$slug] = [
                'class' => __NAMESPACE__ . '\\Tools\\' . $operation['class'],
                'type' => $operation['type'],
                'name' => $operation['name'],
                'description' => $operation['description'],
                'icon' => $this->iconFor($slug, $operation),
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/render2.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.render.com/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Render tool from the catalog class name.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
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
    private function resolveService(array $context = []): RenderService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new RenderService(
                apiKey: $creds->get('render', 'api_key', '', $account) ?: $creds->get('render2', 'api_key', '', $account),
                baseUrl: $creds->get('render', 'url', '', $account) ?: $creds->get('render2', 'url', 'https://api.render.com/v1', $account),
            );
        }

        return app(RenderService::class);
    }

    /**
     * Choose a catalog icon from the operation path.
     *
     * @param  array<string, mixed>  $operation  Operation metadata.
     */
    private function iconFor(string $slug, array $operation): string
    {
        $path = (string) ($operation['path'] ?? '');

        return match (true) {
            str_contains($path, '/deploy') => 'ph:rocket-launch',
            str_contains($path, '/jobs'), str_contains($path, '/tasks'), str_contains($path, '/workflows') => 'ph:list-checks',
            str_contains($path, '/postgres'), str_contains($path, '/redis'), str_contains($path, '/key-value') => 'ph:database',
            str_contains($path, '/logs'), str_contains($path, '/metrics') => 'ph:chart-line',
            str_contains($path, '/projects'), str_contains($path, '/environments') => 'ph:folders',
            str_contains($path, '/webhooks') => 'ph:webhooks-logo',
            str_contains($path, '/owners'), str_contains($path, '/users') => 'ph:user-circle',
            str_contains($path, '/services') => 'ph:server',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}
