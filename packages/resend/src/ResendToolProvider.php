<?php

namespace OpenCompany\Integrations\Resend;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the Resend integration.
 *
 * Exposes generated tools for Resend's official OpenAPI document and resolves
 * account-specific API keys for host applications.
 */
class ResendToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => [], 'notes' => ['Resend requests use Authorization: Bearer <api_key>.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'resend'; }
    public function appMeta(): array { return ['label' => 'Resend', 'description' => 'Email delivery, domains, audiences, contacts, broadcasts, automations, and events', 'icon' => 'ph:envelope-simple', 'logo' => 'simple-icons:resend']; }
    public function integrationMeta(): array { return ['name' => 'Resend', 'description' => 'Manage Resend emails, receiving emails, domains, API keys, templates, audiences, contacts, broadcasts, webhooks, segments, topics, contact properties, logs, automations, and events through the official REST API.', 'icon' => 'ph:envelope-simple', 'logo' => 'simple-icons:resend', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://resend.com/docs/api-reference', 'source_url' => 'https://raw.githubusercontent.com/resend/resend-openapi/main/resend.yaml']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 're_xxxxxxxxxxxxxxxxxxxxxx', 'hint' => 'Your Resend API key with the necessary permissions.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.resend.com', 'default' => 'https://api.resend.com', 'required' => false]]; }

    /**
     * Test the configured Resend API key with the domains endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.resend.com'), '/');
        if ($apiKey === '') return ['success' => false, 'error' => 'Resend API key is not configured.'];
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $apiKey, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/domains');
            if (!$response->successful()) return ['success' => false, 'error' => 'Resend API returned HTTP ' . $response->status() . '.'];
            $count = count($response->json('data') ?? []);
            return ['success' => true, 'message' => sprintf('Connected to Resend - %d domain(s) found.', $count)];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    /** @return array<string, string> */
    public function validationRules(): array { return ['api_key' => 'nullable|string', 'url' => 'nullable|url']; }
    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array { return $this->configSchema(); }

    /**
     * Register generated Resend OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];
        foreach (ResendService::operations() as $slug => $operation) {
            $tools[$slug] = ['class' => __NAMESPACE__ . '\\Tools\\' . $operation['class'], 'type' => $operation['type'] ?? 'read', 'name' => $operation['name'] ?? $slug, 'description' => $operation['description'] ?? '', 'icon' => $this->iconFor($operation)];
        }
        return $tools;
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/resend.md'; }
    public function isIntegration(): bool { return true; }

    /**
     * Create a tool instance with default or account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context containing an account key.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): ResendService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new ResendService(apiKey: (string) $creds->get('resend', 'api_key', '', (string) $account), baseUrl: (string) $creds->get('resend', 'url', 'https://api.resend.com', (string) $account));
        }
        return app(ResendService::class);
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
            str_contains($path, '/emails') => 'ph:envelope-simple',
            str_contains($path, '/domains') => 'ph:globe',
            str_contains($path, '/api-keys') => 'ph:key',
            str_contains($path, '/contacts') => 'ph:user',
            str_contains($path, '/audiences') => 'ph:users',
            str_contains($path, '/broadcasts') => 'ph:broadcast',
            str_contains($path, '/webhooks') => 'ph:webhooks-logo',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}
