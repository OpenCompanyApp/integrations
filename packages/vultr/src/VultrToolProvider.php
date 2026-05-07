<?php

namespace OpenCompany\Integrations\Vultr;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the Vultr integration.
 *
 * Exposes generated tools for Vultr's official OpenAPI document and resolves
 * account-specific API keys for host applications.
 */
class VultrToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Vultr requests use Authorization: Bearer <api_key>.'],
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
        return 'vultr';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Vultr',
            'description' => 'Cloud compute, networking, storage, databases, Kubernetes, DNS, IAM, billing, and support',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:vultr',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Vultr',
            'description' => 'Manage Vultr compute, bare metal, Kubernetes, managed databases, block storage, object storage, networking, DNS, IAM, billing, CDN, registry, and support resources through the official REST API.',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:vultr',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.vultr.com/api/',
            'source_url' => 'https://www.vultr.com/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Enter your Vultr API key', 'hint' => 'Generate an API key in the Vultr customer portal under Account > API.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.vultr.com/v2', 'hint' => 'Override only for a Vultr-compatible API endpoint.', 'default' => 'https://api.vultr.com/v2'],
        ];
    }

    /**
     * Test the configured Vultr API key with the account endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.vultr.com/v2'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken, 'Accept' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/account');

            if (!$response->successful()) {
                $message = $response->json('error') ?? $response->json('message') ?? $response->body();

                return ['success' => false, 'error' => 'Vultr account check failed. Status: ' . $response->status() . '. ' . (is_string($message) ? $message : json_encode($message))];
            }

            $email = $response->json('account.email') ?? 'the configured account';

            return ['success' => true, 'message' => "Connected to Vultr as {$email}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return ['access_token' => 'nullable|string', 'url' => 'nullable|url'];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Register generated Vultr OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (VultrService::operations() as $slug => $operation) {
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

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/vultr.md';
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
    private function resolveService(array $context = []): VultrService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new VultrService(
                accessToken: (string) $creds->get('vultr', 'access_token', '', (string) $account),
                baseUrl: (string) $creds->get('vultr', 'url', 'https://api.vultr.com/v2', (string) $account),
            );
        }

        return app(VultrService::class);
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
            str_contains($path, '/instances') => 'ph:server',
            str_contains($path, '/bare-metals') => 'ph:hard-drives',
            str_contains($path, '/kubernetes') => 'ph:hexagon',
            str_contains($path, '/databases') => 'ph:database',
            str_contains($path, '/blocks') => 'ph:archive',
            str_contains($path, '/object-storage') || str_contains($path, '/s3') => 'ph:bucket',
            str_contains($path, '/dns') => 'ph:globe',
            str_contains($path, '/firewalls') => 'ph:shield',
            str_contains($path, '/ssh-keys') => 'ph:key',
            str_contains($path, '/account') || str_contains($path, '/billing') => 'ph:receipt',
            str_contains($path, '/v2/policies') || str_contains($path, '/v2/roles') || str_contains($path, '/v2/groups') => 'ph:users-three',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}
