<?php

namespace OpenCompany\Integrations\Dialpad;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and credential configuration for the Dialpad integration.
 */
class DialpadToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    public function appName(): string { return 'dialpad'; }

    public function appMeta(): array
    {
        return ['label' => 'Dialpad', 'description' => 'Business communications', 'icon' => 'ph:phone', 'logo' => 'simple-icons:dialpad'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Dialpad',
            'description' => 'Official Dialpad API tools for users, calls, SMS, offices, departments, call centers, rooms, webhooks, subscriptions, and numbers.',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:dialpad',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.dialpad.com/reference/download-api-collection',
            'source_url' => 'https://github.com/dialpad/dialpad-python-sdk/blob/master/dialpad_api_spec.json',
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
            'auth' => ['strategy' => 'bearer_token', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['The official spec also supports query-string apikey auth via auth_mode=query.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Dialpad API key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://dialpad.com', 'default' => 'https://dialpad.com', 'required' => false],
            ['key' => 'auth_mode', 'type' => 'select', 'label' => 'Auth Mode', 'default' => 'bearer', 'options' => ['bearer', 'query'], 'required' => false],
        ];
    }

    /**
     * Test Dialpad credentials using the official company endpoint.
     *
     * @param  array<string, mixed>  $config  Dialpad credentials and optional base URL.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $service = new DialpadService((string) ($config['access_token'] ?? ''), (string) ($config['url'] ?? 'https://dialpad.com'), (string) ($config['auth_mode'] ?? 'bearer'));
        if (!$service->isConfigured()) return ['success' => false, 'error' => 'No Dialpad API key provided'];
        try {
            $service->call('dialpad_company_get');
            return ['success' => true, 'message' => 'Connected to Dialpad API successfully.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['access_token' => 'nullable|string', 'url' => 'nullable|url', 'auth_mode' => 'nullable|in:bearer,query'];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (DialpadService::operations() as $operation) {
            $tools[(string) $operation['slug']] = ['class' => __NAMESPACE__.'\\Tools\\'.$operation['class'], 'type' => $operation['type'], 'name' => $operation['name'], 'description' => $operation['description'], 'icon' => $operation['type'] === 'read' ? 'ph:eye' : 'ph:phone'];
        }
        return $tools;
    }

    public function scriptDocsPath(): ?string { return __DIR__.'/../script-docs/dialpad.md'; }

    public function credentialFields(): array
    {
        return [['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'Dialpad API URL', 'required' => false, 'default' => 'https://dialpad.com'], ['key' => 'auth_mode', 'type' => 'select', 'label' => 'Auth Mode', 'required' => false, 'default' => 'bearer']];
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
    private function resolveService(array $context = []): DialpadService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new DialpadService($creds->get('dialpad', 'access_token', '', $account), $creds->get('dialpad', 'url', 'https://dialpad.com', $account), $creds->get('dialpad', 'auth_mode', 'bearer', $account));
        }
        return app(DialpadService::class);
    }
}