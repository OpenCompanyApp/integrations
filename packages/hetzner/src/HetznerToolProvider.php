<?php

namespace OpenCompany\Integrations\Hetzner;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the Hetzner Cloud integration.
 *
 * Exposes generated tools for the official Hetzner Cloud OpenAPI document
 * and resolves account-specific API tokens for host applications.
 */
class HetznerToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Hetzner Cloud requests use Authorization: Bearer with a project API token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
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
        return 'hetzner';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Hetzner Cloud',
            'description' => 'Servers, networks, firewalls, volumes, load balancers, DNS, images, locations, and actions',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:hetzner',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Hetzner Cloud',
            'description' => 'Manage Hetzner Cloud servers, volumes, networks, firewalls, load balancers, primary IPs, floating IPs, DNS zones, SSH keys, certificates, images, pricing, and actions.',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:hetzner',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.hetzner.cloud/reference/cloud',
            'source_url' => 'https://docs.hetzner.cloud/cloud.spec.json',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Hetzner Cloud API token',
                'hint' => 'Generate a project API token from the Hetzner Cloud Console under Security > API Tokens.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.hetzner.cloud/v1',
                'hint' => 'Use https://api.hetzner.cloud/v1 unless you are targeting a compatible endpoint.',
                'default' => 'https://api.hetzner.cloud/v1',
            ],
        ];
    }

    /**
     * Test the configured Hetzner Cloud token with a lightweight locations call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.hetzner.cloud/v1'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No API token provided.'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl . '/locations');

            if (!$response->successful()) {
                $message = $response->json('error.message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => "Hetzner Cloud API error ({$response->status()}): {$message}",
                ];
            }

            $count = count($response->json('locations') ?? []);

            return [
                'success' => true,
                'message' => "Connected to Hetzner Cloud API at {$baseUrl}; {$count} locations visible.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Register generated Hetzner Cloud OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (HetznerService::operations() as $slug => $operation) {
            $tools[$slug] = [
                'class' => __NAMESPACE__ . '\\Tools\\' . $operation['class'],
                'type' => $operation['type'] ?? 'read',
                'name' => $operation['name'] ?? $slug,
                'description' => $operation['description'] ?? '',
                'icon' => $this->iconFor($operation),
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/hetzner.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with default or account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context containing an account key.
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
    private function resolveService(array $context = []): HetznerService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new HetznerService(
                accessToken: (string) $creds->get('hetzner', 'access_token', '', (string) $account),
                baseUrl: (string) $creds->get('hetzner', 'url', 'https://api.hetzner.cloud/v1', (string) $account),
            );
        }

        return app(HetznerService::class);
    }

    /**
     * Choose a catalog icon from the operation path.
     *
     * @param  array<string, mixed>  $operation  Operation metadata.
     */
    private function iconFor(array $operation): string
    {
        $path = (string) ($operation['path'] ?? '');

        return match (true) {
            str_contains($path, '/servers') => 'ph:server',
            str_contains($path, '/volumes') => 'ph:hard-drives',
            str_contains($path, '/networks') => 'ph:network',
            str_contains($path, '/firewalls') => 'ph:shield-check',
            str_contains($path, '/load_balancers') => 'ph:git-branch',
            str_contains($path, '/ssh_keys') => 'ph:key',
            str_contains($path, '/floating_ips'), str_contains($path, '/primary_ips') => 'ph:globe',
            str_contains($path, '/dns'), str_contains($path, '/zones') => 'ph:globe-hemisphere-west',
            str_contains($path, '/actions') => 'ph:list-checks',
            str_contains($path, '/certificates') => 'ph:certificate',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}
