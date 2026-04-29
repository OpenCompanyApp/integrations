<?php

namespace OpenCompany\Integrations\PayPal;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\PayPal\Tools\PayPalListOrders;
use OpenCompany\Integrations\PayPal\Tools\PayPalGetOrder;
use OpenCompany\Integrations\PayPal\Tools\PayPalCreateOrder;
use OpenCompany\Integrations\PayPal\Tools\PayPalListPayments;
use OpenCompany\Integrations\PayPal\Tools\PayPalGetPayment;
use OpenCompany\Integrations\PayPal\Tools\PayPalListInvoices;
use OpenCompany\Integrations\PayPal\Tools\PayPalGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class PayPalToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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




/**
     * The application name identifier.
     */
    public function appName(): string
    {
        return 'paypal';
    }

/**
     * Short metadata for the integration UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'PayPal',
            'description' => 'Online payments',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:paypal',
        ];
    }

/**
     * Full integration metadata for the integration catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'PayPal',
            'description' => 'Accept payments, manage orders, and generate invoices with PayPal.',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:paypal',
            'category' => 'payments',
            'badge' => 'verified',
            'docs_url' => 'https://developer.paypal.com/api/rest/',
        ];
    }/**
     * Configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your PayPal API access token',
                'hint' => 'Generate an access token in the <a href="https://developer.paypal.com/dashboard/applications/" target="_blank">PayPal Developer Dashboard</a> under your app credentials',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api-m.paypal.com/v1',
                'hint' => 'Use <code>https://api-m.paypal.com/v1</code> for production or <code>https://api-m.sandbox.paypal.com/v1</code> for sandbox',
                'default' => 'https://api-m.paypal.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to the PayPal API using the provided config.
     *
     * @param  array<string, mixed>  $config  The configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api-m.paypal.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/identity/oauth2/userinfo');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach PayPal API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            $userName = $json['name'] ?? ($json['email'] ?? 'Unknown');

            return [
                'success' => true,
                'message' => "Connected to PayPal API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the integration configuration.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all available PayPal tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'paypal_list_orders' => [
                'class' => PayPalListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List PayPal checkout orders.',
                'icon' => 'ph:list-bullets',
            ],
            'paypal_get_order' => [
                'class' => PayPalGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get details of a specific PayPal order.',
                'icon' => 'ph:receipt',
            ],
            'paypal_create_order' => [
                'class' => PayPalCreateOrder::class,
                'type' => 'write',
                'name' => 'Create Order',
                'description' => 'Create a new PayPal checkout order.',
                'icon' => 'ph:plus-circle',
            ],
            'paypal_list_payments' => [
                'class' => PayPalListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List PayPal payments.',
                'icon' => 'ph:money',
            ],
            'paypal_get_payment' => [
                'class' => PayPalGetPayment::class,
                'type' => 'read',
                'name' => 'Get Payment',
                'description' => 'Get details of a specific PayPal payment.',
                'icon' => 'ph:receipt',
            ],
            'paypal_list_invoices' => [
                'class' => PayPalListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List PayPal invoices.',
                'icon' => 'ph:file-text',
            ],
            'paypal_get_current_user' => [
                'class' => PayPalGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated PayPal user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/paypal.md';
    }

    /**
     * Credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api-m.paypal.com/v1'],
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
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class   The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new PayPalService(
                accessToken: $creds->get('paypal', 'access_token', '', $account),
                baseUrl: $creds->get('paypal', 'url', 'https://api-m.paypal.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(PayPalService::class));
    }
}
