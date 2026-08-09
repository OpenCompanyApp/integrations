<?php

namespace OpenCompany\Integrations\Razorpay;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayCreateOrder;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayGetCurrentUser;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayGetOrder;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayGetPayment;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListCustomers;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListOrders;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListPayments;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListRefunds;

/**
 * Registers Razorpay tools and metadata for integration discovery.
 *
 * Exposes payments, orders, refunds, customers, and a lightweight connection
 * check for the Razorpay REST API.
 */
class RazorpayToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'credential_mode' => 'stored_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['key_id', 'key_secret'],
                'notes' => ['Razorpay uses HTTP Basic Auth with key_id as username and key_secret as password.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
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
            'label' => 'Razorpay',
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
            'category' => 'data',
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
                'name' => 'Connection Check',
                'description' => 'Verify the Razorpay API connection with a lightweight payments request.',
                'icon' => 'ph:plugs-connected',
            ],
        ];
    }

    /**
     * Path to the JavaScript documentation file for this integration.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/razorpay.md';
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
            $creds = app(CredentialResolver::class);

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
