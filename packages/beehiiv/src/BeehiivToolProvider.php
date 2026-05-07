<?php

namespace OpenCompany\Integrations\Beehiiv;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for the official beehiiv API.
 */
class BeehiivToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    public function appName(): string { return 'beehiiv'; }

    public function appMeta(): array
    {
        return ['label' => 'beehiiv', 'description' => 'Newsletter platform', 'icon' => 'ph:envelope', 'logo' => 'simple-icons:beehiiv'];
    }

    public function integrationMeta(): array
    {
        return ['name' => 'beehiiv', 'description' => 'Official beehiiv API tools for publications, posts, subscriptions, segments, automations, webhooks, tiers, polls, and analytics.', 'icon' => 'ph:envelope', 'logo' => 'simple-icons:beehiiv', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.beehiiv.com/', 'source_url' => 'https://developers.beehiiv.com/welcome/getting-started'];
    }

    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['api_key'], 'notes' => ['Bearer API key authentication. OAuth access tokens can also be stored as api_key for authorized apps.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function configSchema(): array
    {
        return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'beehiiv API key', 'required' => true], ['key' => 'publication_id', 'type' => 'string', 'label' => 'Default Publication ID', 'placeholder' => 'pub_xxxxxxxx', 'required' => false], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.beehiiv.com/v2', 'default' => 'https://api.beehiiv.com/v2', 'required' => false]];
    }

    /**
     * Test the connection to the beehiiv API using the provided config.
     *
     * @param  array<string, mixed>  $config  The configuration to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.beehiiv.com/v2'), '/');
        if ($apiKey === '') return ['success' => false, 'error' => 'No API key provided'];
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer '.$apiKey, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl.'/publications');
            if (!$response->successful()) return ['success' => false, 'error' => 'beehiiv API returned HTTP '.$response->status().'.'];
            return ['success' => true, 'message' => 'Connected to beehiiv API successfully.'];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string', 'publication_id' => 'nullable|string', 'url' => 'nullable|url'];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (BeehiivService::operations() as $operation) {
            $tools[(string) $operation['slug']] = ['class' => __NAMESPACE__.'\\Tools\\'.$operation['class'], 'type' => $operation['type'], 'name' => $operation['name'], 'description' => $operation['description'], 'icon' => $operation['type'] === 'read' ? 'ph:eye' : 'ph:envelope'];
        }
        return $tools;
    }

    public function luaDocsPath(): ?string { return __DIR__.'/../lua-docs/beehiiv.md'; }

    public function credentialFields(): array
    {
        return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true], ['key' => 'publication_id', 'type' => 'string', 'label' => 'Default Publication ID', 'required' => false], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.beehiiv.com/v2']];
    }

    public function isIntegration(): bool { return true; }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the service for the default or named account context.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): BeehiivService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new BeehiivService($creds->get('beehiiv', 'api_key', '', $account), $creds->get('beehiiv', 'publication_id', '', $account), $creds->get('beehiiv', 'url', 'https://api.beehiiv.com/v2', $account));
        }
        return app(BeehiivService::class);
    }
}