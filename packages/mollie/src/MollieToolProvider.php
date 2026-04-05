<?php

namespace OpenCompany\Integrations\Mollie;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mollie\Tools\MollieListPayments;
use OpenCompany\Integrations\Mollie\Tools\MollieGetPayment;
use OpenCompany\Integrations\Mollie\Tools\MollieCreatePayment;
use OpenCompany\Integrations\Mollie\Tools\MollieListCustomers;
use OpenCompany\Integrations\Mollie\Tools\MollieCreateCustomer;
use OpenCompany\Integrations\Mollie\Tools\MollieListSubscriptions;
use OpenCompany\Integrations\Mollie\Tools\MollieCreateSubscription;
use OpenCompany\Integrations\Mollie\Tools\MollieListInvoices;
use OpenCompany\Integrations\Mollie\Tools\MollieGetCurrentUser;

class MollieToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'mollie';
    }

    /**
     * Get metadata for the application display.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'payments, customers, subscriptions, invoices',
            'description' => 'Payment processing',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:mollie',
        ];
    }

    /**
     * Get integration metadata for the marketplace/UI.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Mollie',
            'description' => 'Payment processing, subscriptions and invoicing',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:mollie',
            'category' => 'payments',
            'badge' => 'verified',
            'docs_url' => 'https://docs.mollie.com',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx or test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
                'hint' => 'Use a <code>live_</code> token for production or a <code>test_</code> token for the Mollie test environment',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.mollie.com/v2',
                'hint' => 'Override only for custom Mollie endpoints. Default is the official API.',
                'default' => 'https://api.mollie.com/v2',
            ],
        ];
    }

    /**
     * Test the connection to the Mollie API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.mollie.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/methods');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Mollie API at {$baseUrl}.",
                ];
            }

            $json = $response->json();
            $error = $json['detail'] ?? $json['title'] ?? "HTTP {$response->status()}";

            return [
                'success' => false,
                'error' => "Mollie API returned an error: {$error}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration values.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'mollie_list_payments' => [
                'class' => MollieListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List payments with optional filters.',
                'icon' => 'ph:list',
            ],
            'mollie_get_payment' => [
                'class' => MollieGetPayment::class,
                'type' => 'read',
                'name' => 'Get Payment',
                'description' => 'Retrieve a single payment by ID.',
                'icon' => 'ph:credit-card',
            ],
            'mollie_create_payment' => [
                'class' => MollieCreatePayment::class,
                'type' => 'write',
                'name' => 'Create Payment',
                'description' => 'Create a new payment.',
                'icon' => 'ph:plus-circle',
            ],
            'mollie_list_customers' => [
                'class' => MollieListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List all customers.',
                'icon' => 'ph:users',
            ],
            'mollie_create_customer' => [
                'class' => MollieCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new customer.',
                'icon' => 'ph:user-plus',
            ],
            'mollie_list_subscriptions' => [
                'class' => MollieListSubscriptions::class,
                'type' => 'read',
                'name' => 'List Subscriptions',
                'description' => 'List subscriptions for a customer.',
                'icon' => 'ph:arrows-repeat',
            ],
            'mollie_create_subscription' => [
                'class' => MollieCreateSubscription::class,
                'type' => 'write',
                'name' => 'Create Subscription',
                'description' => 'Create a subscription for a customer.',
                'icon' => 'ph:arrows-repeat',
            ],
            'mollie_list_invoices' => [
                'class' => MollieListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices for the authenticated account.',
                'icon' => 'ph:file-text',
            ],
            'mollie_get_current_user' => [
                'class' => MollieGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Payment Methods',
                'description' => 'Retrieve enabled payment methods.',
                'icon' => 'ph:wallet',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mollie.md';
    }

    /**
     * Get the credential fields required by this integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.mollie.com/v2'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context with optional 'account' key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new MollieService(
                accessToken: $creds->get('mollie', 'access_token', '', $account),
                baseUrl: $creds->get('mollie', 'url', 'https://api.mollie.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(MollieService::class));
    }
}
