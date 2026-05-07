<?php

namespace OpenCompany\Integrations\Braintree;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for the official Braintree GraphQL API.
 */
class BraintreeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    public function appName(): string { return 'braintree'; }

    public function appMeta(): array
    {
        return ['label' => 'Braintree', 'description' => 'Payment processing', 'icon' => 'ph:credit-card', 'logo' => 'simple-icons:braintree'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Braintree',
            'description' => 'Official Braintree GraphQL tools for payments, customers, disputes, payment methods, in-store readers, reports, and recurring billing.',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:braintree',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developer.paypal.com/braintree/graphql/guides/making_api_calls/',
            'source_url' => 'https://github.com/braintree/graphql-api/blob/master/schema.graphql',
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
            'auth' => ['strategy' => 'basic_or_bearer_token', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['public_key', 'private_key', 'access_token'], 'notes' => ['Public/private keys use Basic auth. OAuth access tokens use Bearer auth.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'public_key', 'type' => 'text', 'label' => 'Public Key', 'placeholder' => 'Braintree public key', 'required' => false],
            ['key' => 'private_key', 'type' => 'secret', 'label' => 'Private Key', 'placeholder' => 'Braintree private key', 'required' => false],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'OAuth Access Token', 'placeholder' => 'Braintree OAuth access token', 'required' => false],
            ['key' => 'merchant_id', 'type' => 'text', 'label' => 'Merchant ID', 'placeholder' => 'example_merchant', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'GraphQL Endpoint', 'placeholder' => 'https://payments.sandbox.braintree-api.com/graphql', 'default' => 'https://payments.sandbox.braintree-api.com/graphql', 'required' => false],
            ['key' => 'version', 'type' => 'text', 'label' => 'Braintree Version', 'placeholder' => '2019-01-01', 'default' => '2019-01-01', 'required' => false],
        ];
    }

    /**
     * Test Braintree credentials with the official ping query.
     *
     * @param  array<string, mixed>  $config  Braintree credentials.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $publicKey = (string) ($config['public_key'] ?? '');
        $privateKey = (string) ($config['private_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://payments.sandbox.braintree-api.com/graphql'), '/');
        $version = (string) ($config['version'] ?? '2019-01-01');
        if ($accessToken === '' && ($publicKey === '' || $privateKey === '')) {
            return ['success' => false, 'error' => 'Provide Braintree public/private keys or an OAuth access token.'];
        }
        try {
            $headers = ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Braintree-Version' => $version];
            $headers['Authorization'] = $publicKey !== '' && $privateKey !== '' ? 'Basic '.base64_encode($publicKey.':'.$privateKey) : 'Bearer '.$accessToken;
            $response = Http::withHeaders($headers)->timeout(10)->post($baseUrl, ['query' => 'query BraintreePing { ping }']);
            if (!$response->successful()) return ['success' => false, 'error' => 'Braintree GraphQL API returned HTTP '.$response->status().'.'];
            $json = $response->json() ?? [];
            if (isset($json['errors'])) return ['success' => false, 'error' => 'Braintree GraphQL error: '.json_encode($json['errors'])];
            return ['success' => true, 'message' => 'Connected to Braintree GraphQL API.'];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['access_token' => 'nullable|string', 'public_key' => 'nullable|string|required_with:private_key', 'private_key' => 'nullable|string|required_with:public_key', 'merchant_id' => 'nullable|string', 'url' => 'nullable|url', 'version' => 'nullable|string'];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (BraintreeService::operations() as $operation) {
            $tools[(string) $operation['slug']] = ['class' => __NAMESPACE__.'\\Tools\\'.$operation['class'], 'type' => $operation['type'], 'name' => $operation['name'], 'description' => $operation['description'], 'icon' => $operation['type'] === 'read' ? 'ph:eye' : 'ph:credit-card'];
        }
        return $tools;
    }

    public function luaDocsPath(): ?string { return __DIR__.'/../lua-docs/braintree.md'; }

    public function credentialFields(): array
    {
        return [['key' => 'public_key', 'type' => 'text', 'label' => 'Public Key', 'required' => false], ['key' => 'private_key', 'type' => 'secret', 'label' => 'Private Key', 'required' => false], ['key' => 'access_token', 'type' => 'secret', 'label' => 'OAuth Access Token', 'required' => false], ['key' => 'merchant_id', 'type' => 'text', 'label' => 'Merchant ID', 'required' => false]];
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
    private function resolveService(array $context = []): BraintreeService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new BraintreeService($creds->get('braintree', 'access_token', '', $account), $creds->get('braintree', 'merchant_id', '', $account), $creds->get('braintree', 'url', 'https://payments.sandbox.braintree-api.com/graphql', $account), $creds->get('braintree', 'public_key', '', $account), $creds->get('braintree', 'private_key', '', $account), $creds->get('braintree', 'version', '2019-01-01', $account));
        }
        return app(BraintreeService::class);
    }
}