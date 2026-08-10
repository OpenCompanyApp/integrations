<?php

namespace OpenCompany\Integrations\Adyen;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool provider for generated official Adyen OpenAPI operations.
 *
 * Exposes Checkout v72 and Management v3 operations from the generated
 * operation metadata.
 */
class AdyenToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe Adyen authentication and host support.
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
                'notes' => ['Uses the X-API-Key header.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
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
        return 'adyen';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Adyen',
            'description' => 'Payments, payment links, stored methods, and stores',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:adyen',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Adyen',
            'description' => 'Generated tools for official Adyen Checkout v72 and Management v3 OpenAPI operations.',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:adyen',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.adyen.com/api-explorer/',
            'source_url' => 'https://github.com/Adyen/adyen-openapi',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'merchant_account', 'type' => 'text', 'label' => 'Merchant Account', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Checkout API URL', 'default' => 'https://checkout-test.adyen.com'],
            ['key' => 'management_url', 'type' => 'url', 'label' => 'Management API URL', 'default' => 'https://management-test.adyen.com'],
            ['key' => 'company_id', 'type' => 'text', 'label' => 'Company ID', 'required' => false],
        ];
    }

    /**
     * Verify Adyen credentials with a lightweight payment-methods request.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $merchantAccount = (string) ($config['merchant_account'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://checkout-test.adyen.com'), '/');
        $managementUrl = rtrim((string) ($config['management_url'] ?? 'https://management-test.adyen.com'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $http = Http::withHeaders([
                'X-API-Key' => $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10);

            if ($merchantAccount !== '') {
                $response = $http->post($baseUrl . '/v72/paymentMethods', [
                    'merchantAccount' => $merchantAccount,
                ]);
            } else {
                $response = $http->get($managementUrl . '/v3/me');
            }

            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->json('errorType') ?? $response->body();

                return ['success' => false, 'error' => is_string($error) ? $error : json_encode($error)];
            }

            return ['success' => true, 'message' => 'Connected to Adyen API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'merchant_account' => 'nullable|string',
            'url' => 'nullable|url',
            'management_url' => 'nullable|url',
            'company_id' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        $tools = [];

        foreach (AdyenService::operations() as $operation) {
            $tools[(string) $operation['slug']] = [
                'class' => __NAMESPACE__ . '\\Tools\\' . $operation['class'],
                'type' => $operation['type'],
                'name' => $operation['name'],
                'description' => $operation['description'],
                'icon' => $operation['type'] === 'read' ? 'ph:list' : 'ph:terminal-window',
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/adyen.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'merchant_account', 'type' => 'text', 'label' => 'Merchant Account', 'required' => true],
            ['key' => 'company_id', 'type' => 'text', 'label' => 'Company ID', 'required' => false],
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
     * Resolve Adyen service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): AdyenService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AdyenService(
                apiKey: $creds->get('adyen', 'api_key', '', $account),
                merchantAccount: $creds->get('adyen', 'merchant_account', '', $account),
                baseUrl: $creds->get('adyen', 'url', 'https://checkout-test.adyen.com', $account),
                managementUrl: $creds->get('adyen', 'management_url', 'https://management-test.adyen.com', $account),
                companyId: $creds->get('adyen', 'company_id', '', $account),
            );
        }

        return app(AdyenService::class);
    }
}
