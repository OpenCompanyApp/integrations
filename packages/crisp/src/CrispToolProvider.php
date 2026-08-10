<?php

namespace OpenCompany\Integrations\Crisp;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool provider for the official Crisp REST API integration.
 *
 * Exposes node-crisp-api REST methods, credential fields, metadata, and
 * multi-account service resolution for host applications.
 */
class CrispToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'basic_auth',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret_pair',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['identifier', 'key'],
                'notes' => ['Crisp REST API uses token identifier/key with the X-Crisp-Tier header.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => ['token_identifier', 'token_key', 'token_tier'],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string { return 'crisp'; }

    public function appMeta(): array
    {
        return ['label' => 'Crisp', 'description' => 'Customer messaging and helpdesk', 'icon' => 'ph:chat-circle-dots', 'logo' => 'simple-icons:crisp'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Crisp',
            'description' => 'REST API for conversations, people profiles, campaigns, helpdesk, operators, visitors, plugins, plans, media, and bucket URLs',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:crisp',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.crisp.chat/references/rest-api/v1/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'identifier', 'type' => 'secret', 'label' => 'Token Identifier', 'placeholder' => 'Enter your Crisp token identifier', 'required' => true],
            ['key' => 'key', 'type' => 'secret', 'label' => 'Token Key', 'placeholder' => 'Enter your Crisp token key', 'required' => true],
            ['key' => 'tier', 'type' => 'select', 'label' => 'Token Tier', 'default' => 'plugin', 'required' => true, 'options' => [['label' => 'Plugin', 'value' => 'plugin'], ['label' => 'Website', 'value' => 'website'], ['label' => 'User', 'value' => 'user']]],
            ['key' => 'website_id', 'type' => 'string', 'label' => 'Default Website ID', 'placeholder' => 'e.g. a1b2c3d4-e5f6-7890-abcd-ef1234567890', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Host', 'placeholder' => 'https://api.crisp.chat', 'default' => 'https://api.crisp.chat'],
        ];
    }

    /**
     * Verify Crisp credentials with the connect account endpoint.
     *
     * @param  array<string, mixed>  $config  Crisp credential configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $identifier = $config['identifier'] ?? $config['api_key'] ?? '';
        $key = $config['key'] ?? $config['token_key'] ?? '';
        $tier = $config['tier'] ?? 'plugin';
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.crisp.chat'), '/');
        $baseUrl = str_ends_with($baseUrl, '/v1') ? substr($baseUrl, 0, -3) : $baseUrl;

        if ($identifier === '' || $key === '') {
            return ['success' => false, 'error' => 'Token identifier and token key are required.'];
        }

        try {
            $response = Http::withHeaders(['X-Crisp-Tier' => $tier])->withBasicAuth((string) $identifier, (string) $key)->acceptJson()->timeout(10)->get($baseUrl.'/v1/plugin/connect/account');
            if (!$response->successful()) {
                $json = $response->json();
                $error = is_array($json) ? ($json['reason'] ?? $json['message'] ?? 'Unknown error') : $response->body();

                return ['success' => false, 'error' => 'Authentication failed: '.$error];
            }

            return ['success' => true, 'message' => 'Connected to Crisp REST API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['identifier' => 'required_without:api_key|string', 'key' => 'required|string', 'tier' => 'nullable|in:user,website,plugin', 'website_id' => 'nullable|string', 'url' => 'nullable|url'];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (CrispService::operations() as $operation) {
            $tools[(string) $operation['slug']] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$operation['class'],
                'type' => $operation['type'],
                'name' => $operation['name'],
                'description' => $operation['description'],
                'icon' => str_contains((string) $operation['operation'], 'conversation') ? 'ph:chat-circle-dots' : 'ph:app-window',
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string { return __DIR__.'/../script-docs/crisp.md'; }

    public function credentialFields(): array
    {
        return [
            ['key' => 'identifier', 'type' => 'secret', 'label' => 'Token Identifier', 'required' => true],
            ['key' => 'key', 'type' => 'secret', 'label' => 'Token Key', 'required' => true],
            ['key' => 'tier', 'type' => 'select', 'label' => 'Token Tier', 'required' => true, 'default' => 'plugin'],
            ['key' => 'website_id', 'type' => 'string', 'label' => 'Default Website ID', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Host', 'required' => false, 'default' => 'https://api.crisp.chat'],
        ];
    }

    public function isIntegration(): bool { return true; }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Crisp service for default or named account credentials.
     *
     * @param  array<string, mixed>  $context  Host account context.
     */
    private function resolveService(array $context = []): CrispService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new CrispService(
                identifier: $creds->get('crisp', 'identifier', $creds->get('crisp', 'api_key', '', $account), $account),
                key: $creds->get('crisp', 'key', $creds->get('crisp', 'token_key', '', $account), $account),
                websiteId: $creds->get('crisp', 'website_id', '', $account),
                tier: $creds->get('crisp', 'tier', 'plugin', $account),
                baseUrl: $creds->get('crisp', 'url', 'https://api.crisp.chat', $account),
            );
        }

        return app(CrispService::class);
    }
}
