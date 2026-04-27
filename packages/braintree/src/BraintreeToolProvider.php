<?php

namespace OpenCompany\Integrations\Braintree;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Braintree\Tools\BraintreeListTransactions;
use OpenCompany\Integrations\Braintree\Tools\BraintreeGetTransaction;
use OpenCompany\Integrations\Braintree\Tools\BraintreeListCustomers;
use OpenCompany\Integrations\Braintree\Tools\BraintreeGetCustomer;
use OpenCompany\Integrations\Braintree\Tools\BraintreeListPlans;
use OpenCompany\Integrations\Braintree\Tools\BraintreeGetPlan;
use OpenCompany\Integrations\Braintree\Tools\BraintreeGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class BraintreeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
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
        return 'braintree';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'transactions, customers, plans, subscriptions',
            'description' => 'Payment processing',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:braintree',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Braintree',
            'description' => 'Payment processing by PayPal — accept cards, PayPal, Venmo, and more',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:braintree',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developer.paypal.com/braintree/docs',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Braintree access token',
                'hint' => 'Generate a token in the Braintree Control Panel under <strong>Settings &rarr; API Keys</strong>. Use a token-scoped key for production.',
                'required' => true,
            ],
            [
                'key' => 'merchant_id',
                'type' => 'text',
                'label' => 'Merchant ID',
                'placeholder' => 'e.g., abc123def456',
                'hint' => 'Your Braintree Merchant ID, found in <strong>Settings &rarr; Business</strong> in the Control Panel.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.braintreegateway.com',
                'hint' => 'Use <code>https://api.braintreegateway.com</code> for production or <code>https://api.sandbox.braintreegateway.com</code> for sandbox.',
                'default' => 'https://api.braintreegateway.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $merchantId = $config['merchant_id'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.braintreegateway.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($merchantId)) {
            return ['success' => false, 'error' => 'No merchant ID provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . "/merchants/{$merchantId}");

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Braintree API at {$baseUrl}. Check the URL and credentials.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Braintree API for merchant {$merchantId}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'merchant_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'braintree_list_transactions' => [
                'class' => BraintreeListTransactions::class,
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List payment transactions for the merchant.',
                'icon' => 'ph:list',
            ],
            'braintree_get_transaction' => [
                'class' => BraintreeGetTransaction::class,
                'type' => 'read',
                'name' => 'Get Transaction',
                'description' => 'Retrieve a single transaction by ID.',
                'icon' => 'ph:receipt',
            ],
            'braintree_list_customers' => [
                'class' => BraintreeListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers stored in Braintree.',
                'icon' => 'ph:users',
            ],
            'braintree_get_customer' => [
                'class' => BraintreeGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Retrieve a single customer by ID.',
                'icon' => 'ph:user',
            ],
            'braintree_list_plans' => [
                'class' => BraintreeListPlans::class,
                'type' => 'read',
                'name' => 'List Plans',
                'description' => 'List recurring billing plans.',
                'icon' => 'ph:currency-dollar',
            ],
            'braintree_get_plan' => [
                'class' => BraintreeGetPlan::class,
                'type' => 'read',
                'name' => 'Get Plan',
                'description' => 'Retrieve a single recurring billing plan by ID.',
                'icon' => 'ph:currency-dollar',
            ],
            'braintree_get_current_user' => [
                'class' => BraintreeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current Merchant',
                'description' => 'Get the current merchant account info.',
                'icon' => 'ph:building',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/braintree.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'merchant_id', 'type' => 'text', 'label' => 'Merchant ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.braintreegateway.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new BraintreeService(
                accessToken: $creds->get('braintree', 'access_token', '', $account),
                merchantId: $creds->get('braintree', 'merchant_id', '', $account),
                baseUrl: $creds->get('braintree', 'url', 'https://api.braintreegateway.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(BraintreeService::class));
    }
}
