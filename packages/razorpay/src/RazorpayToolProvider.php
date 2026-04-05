<?php

namespace OpenCompany\Integrations\Razorpay;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListPayments;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayGetPayment;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListOrders;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayGetOrder;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayCreateOrder;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListRefunds;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListCustomers;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayGetCurrentUser;

/**
 * Tool provider for the Razorpay integration.
 *
 * Implements ConfigurableIntegration for multi-account credential management,
 * and ToolProvider for registering Razorpay tools with the integration registry.
 */
class RazorpayToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The application name identifier.
     */
    public function appName(): string
    {
        return 'razorpay';
    }

    /**
     * Metadata for the app display in the integration UI.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'payments, orders, refunds, customers',
            'description' => 'Payment gateway',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:razorpay',
        ];
    }

    /**
     * Integration metadata describing the Razorpay integration.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Razorpay',
            'description' => 'Indian payment gateway for online payments',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:razorpay',
            'category' => 'payments',
            'badge' => 'verified',
            'docs_url' => 'https://razorpay.com/docs/api/',
        ];
    }

    /**
     * Configuration schema for the Razorpay integration.
     *
     * Defines the fields required to configure the integration: key_id, key_secret,
     * and an optional custom URL for the API base.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'key_id',
                'type' => 'text',
                'label' => 'Key ID',
                'placeholder' => 'Enter your Razorpay Key ID',
                'hint' => 'Find your Key ID in the Razorpay Dashboard under Settings → API Keys',
                'required' => true,
            ],
            [
                'key' => 'key_secret',
                'type' => 'secret',
                'label' => 'Key Secret',
                'placeholder' => 'Enter your Razorpay Key Secret',
                'hint' => 'Find your Key Secret in the Razorpay Dashboard under Settings → API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.razorpay.com/v1',
                'hint' => 'Use the default URL unless you have a custom Razorpay endpoint',
                'default' => 'https://api.razorpay.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Razorpay API using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing key_id and key_secret.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $keyId = $config['key_id'] ?? '';
        $keySecret = $config['key_secret'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.razorpay.com/v1', '/');

        if (empty($keyId) || empty($keySecret)) {
            return ['success' => false, 'error' => 'Key ID and Key Secret are required.'];
        }

        try {
            $response = Http::withBasicAuth($keyId, $keySecret)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/payments', ['count' => 1]);

            if ($response->status() === 401) {
                return [
                    'success' => false,
                    'error' => 'Invalid Key ID or Key Secret.',
                ];
            }

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Razorpay API successfully.',
                ];
            }

            return [
                'success' => false,
                'error' => "Razorpay API returned HTTP {$response->status()}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the Razorpay configuration.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'key_id' => 'required|string',
            'key_secret' => 'required|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'razorpay_list_payments' => [
                'class' => RazorpayListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List payments from Razorpay.',
                'icon' => 'ph:credit-card',
            ],
            'razorpay_get_payment' => [
                'class' => RazorpayGetPayment::class,
                'type' => 'read',
                'name' => 'Get Payment',
                'description' => 'Get details of a specific payment.',
                'icon' => 'ph:credit-card',
            ],
            'razorpay_list_orders' => [
                'class' => RazorpayListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List orders from Razorpay.',
                'icon' => 'ph:list-bullets',
            ],
            'razorpay_get_order' => [
                'class' => RazorpayGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get details of a specific order.',
                'icon' => 'ph:list-bullets',
            ],
            'razorpay_create_order' => [
                'class' => RazorpayCreateOrder::class,
                'type' => 'write',
                'name' => 'Create Order',
                'description' => 'Create a new payment order in Razorpay.',
                'icon' => 'ph:plus-circle',
            ],
            'razorpay_list_refunds' => [
                'class' => RazorpayListRefunds::class,
                'type' => 'read',
                'name' => 'List Refunds',
                'description' => 'List refunds from Razorpay.',
                'icon' => 'ph:arrow-counter-clockwise',
            ],
            'razorpay_list_customers' => [
                'class' => RazorpayListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers from Razorpay.',
                'icon' => 'ph:users',
            ],
            'razorpay_get_current_user' => [
                'class' => RazorpayGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get current user information from Razorpay.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua documentation file for this integration.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/razorpay.md';
    }

    /**
     * Credential fields required by this integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'key_id', 'type' => 'text', 'label' => 'Key ID', 'required' => true],
            ['key' => 'key_secret', 'type' => 'secret', 'label' => 'Key Secret', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.razorpay.com/v1'],
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
     * @param  class-string<Tool>  $class   The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new RazorpayService(
                keyId: $creds->get('razorpay', 'key_id', '', $account),
                keySecret: $creds->get('razorpay', 'key_secret', '', $account),
                baseUrl: $creds->get('razorpay', 'url', 'https://api.razorpay.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(RazorpayService::class));
    }
}
