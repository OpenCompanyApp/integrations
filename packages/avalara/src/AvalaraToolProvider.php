<?php

namespace OpenCompany\Integrations\Avalara;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and credential configuration for the Avalara AvaTax integration.
 */
class AvalaraToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    public function appName(): string
    {
        return 'avalara';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Avalara',
            'description' => 'Tax automation and compliance',
            'icon' => 'ph:receipt',
            'logo' => 'simple-icons:avalara',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Avalara',
            'description' => 'Official AvaTax REST API tools for tax calculation, transactions, companies, certificates, compliance, and returns data.',
            'icon' => 'ph:receipt',
            'logo' => 'simple-icons:avalara',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developer.avalara.com/api-reference/avatax/rest/v2/',
            'source_url' => 'https://rest.avatax.com/swagger/v2/swagger.json',
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
                'strategy' => 'bearer_or_basic',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token_or_license_key',
                'setup_flows' => ['manual_token', 'manual_basic'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token', 'account_id', 'license_key'],
                'notes' => ['Supports Avalara bearer tokens or Basic authentication with Account ID and License Key.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token_or_basic'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token_or_basic', 'runtime_mode' => 'normal'],
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
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Avalara OAuth bearer token', 'hint' => 'Optional when Account ID and License Key are provided.', 'required' => false],
            ['key' => 'account_id', 'type' => 'text', 'label' => 'Account ID', 'placeholder' => '123456789', 'hint' => 'Used with License Key for Basic authentication.', 'required' => false],
            ['key' => 'license_key', 'type' => 'secret', 'label' => 'License Key', 'placeholder' => 'Avalara license key', 'hint' => 'Used with Account ID for Basic authentication.', 'required' => false],
            ['key' => 'company_id', 'type' => 'text', 'label' => 'Default Company ID', 'placeholder' => '123456', 'hint' => 'Optional default for company-scoped tools.', 'required' => false],
            ['key' => 'base_url', 'type' => 'text', 'label' => 'Base URL', 'placeholder' => 'https://rest.avatax.com', 'hint' => 'Use https://sandbox-rest.avatax.com for sandbox credentials.', 'required' => false],
        ];
    }

    /**
     * Test Avalara credentials with the official ping endpoint.
     *
     * @param  array<string, mixed>  $config  Avalara credentials and optional base URL.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $service = new AvalaraService(
            accessToken: (string) ($config['access_token'] ?? ''),
            accountId: (string) ($config['account_id'] ?? ''),
            licenseKey: (string) ($config['license_key'] ?? ''),
            companyId: (string) ($config['company_id'] ?? ''),
            baseUrl: (string) ($config['base_url'] ?? 'https://rest.avatax.com'),
        );

        if (!$service->isConfigured()) {
            return ['success' => false, 'error' => 'Provide either an access token or Account ID plus License Key.'];
        }

        try {
            $result = $service->ping();
            if (($result['authenticated'] ?? false) === true) {
                return ['success' => true, 'message' => 'Connected to Avalara successfully.'];
            }

            return ['success' => false, 'error' => 'Avalara ping succeeded but credentials were not authenticated.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string|required_without_all:account_id,license_key',
            'account_id' => 'nullable|string|required_with:license_key',
            'license_key' => 'nullable|string|required_with:account_id',
            'company_id' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        $tools = [];

        foreach (AvalaraService::operations() as $operation) {
            $tools[(string) $operation['slug']] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$operation['class'],
                'type' => $operation['type'],
                'name' => $operation['name'],
                'description' => $operation['description'],
                'icon' => $operation['type'] === 'read' ? 'ph:eye' : 'ph:receipt',
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/avalara.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => false],
            ['key' => 'account_id', 'type' => 'text', 'label' => 'Account ID', 'required' => false],
            ['key' => 'license_key', 'type' => 'secret', 'label' => 'License Key', 'required' => false],
            ['key' => 'company_id', 'type' => 'text', 'label' => 'Default Company ID', 'required' => false],
            ['key' => 'base_url', 'type' => 'text', 'label' => 'Base URL', 'required' => false],
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
     * Resolve the service for the default or named account context.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): AvalaraService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AvalaraService(
                accessToken: $creds->get('avalara', 'access_token', '', $account),
                accountId: $creds->get('avalara', 'account_id', '', $account),
                licenseKey: $creds->get('avalara', 'license_key', '', $account),
                companyId: $creds->get('avalara', 'company_id', '', $account),
                baseUrl: $creds->get('avalara', 'base_url', 'https://rest.avatax.com', $account),
            );
        }

        return app(AvalaraService::class);
    }
}
