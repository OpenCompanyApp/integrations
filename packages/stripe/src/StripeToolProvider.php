<?php

namespace OpenCompany\Integrations\Stripe;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Stripe\Tools\StripeCancelSubscription;
use OpenCompany\Integrations\Stripe\Tools\StripeCancelPaymentIntent;
use OpenCompany\Integrations\Stripe\Tools\StripeCapturePaymentIntent;
use OpenCompany\Integrations\Stripe\Tools\StripeConfirmPaymentIntent;
use OpenCompany\Integrations\Stripe\Tools\StripeCreateCustomer;
use OpenCompany\Integrations\Stripe\Tools\StripeCreateInvoice;
use OpenCompany\Integrations\Stripe\Tools\StripeCreatePaymentIntent;
use OpenCompany\Integrations\Stripe\Tools\StripeCreatePrice;
use OpenCompany\Integrations\Stripe\Tools\StripeCreateProduct;
use OpenCompany\Integrations\Stripe\Tools\StripeCreateSubscription;
use OpenCompany\Integrations\Stripe\Tools\StripeDeleteCustomer;
use OpenCompany\Integrations\Stripe\Tools\StripeGetBalance;
use OpenCompany\Integrations\Stripe\Tools\StripeGetCustomer;
use OpenCompany\Integrations\Stripe\Tools\StripeGetInvoice;
use OpenCompany\Integrations\Stripe\Tools\StripeGetPaymentIntent;
use OpenCompany\Integrations\Stripe\Tools\StripeGetProduct;
use OpenCompany\Integrations\Stripe\Tools\StripeGetSubscription;
use OpenCompany\Integrations\Stripe\Tools\StripeListCustomers;
use OpenCompany\Integrations\Stripe\Tools\StripeListInvoices;
use OpenCompany\Integrations\Stripe\Tools\StripeListPrices;
use OpenCompany\Integrations\Stripe\Tools\StripeListProducts;
use OpenCompany\Integrations\Stripe\Tools\StripePayInvoice;
use OpenCompany\Integrations\Stripe\Tools\StripeUpdateCustomer;
use OpenCompany\Integrations\Stripe\Tools\StripeUpdatePaymentIntent;
use OpenCompany\Integrations\Stripe\Tools\StripeVoidInvoice;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Stripe tools and provides integration metadata.
 */
class StripeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
        return 'stripe';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Stripe',
            'description' => 'Online payments',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:stripe',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Stripe',
            'description' => 'Online payments, billing, subscriptions, and invoicing',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:stripe',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.stripe.com/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Secret API Key',
                'placeholder' => 'sk_live_...',
                'hint' => 'Find in Stripe Dashboard → Developers → API keys. Use a restricted key with the permissions you need.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided. Find yours at Stripe Dashboard → Developers → API keys.'];
        }

        try {
            $response = Http::withBasicAuth($apiKey, '')
                ->timeout(10)
                ->get('https://api.stripe.com/v1/balance');

            if ($response->successful()) {
                $balance = $response->json() ?? [];
                $available = $balance['available'] ?? [];

                $amounts = array_map(function (array $a) {
                    $amount = ($a['amount'] ?? 0) / 100;
                    $currency = strtoupper($a['currency'] ?? 'usd');

                    return "{$amount} {$currency}";
                }, $available);

                $balanceStr = ! empty($amounts) ? implode(', ', $amounts) : '0.00 USD';

                return [
                    'success' => true,
                    'message' => "Connected to Stripe. Available balance: {$balanceStr}",
                ];
            }

            $error = $response->json('error.message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Stripe API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Customers
            'stripe_create_customer' => [
                'class' => StripeCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new Stripe customer.',
                'icon' => 'ph:user-plus',
            ],
            'stripe_get_customer' => [
                'class' => StripeGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Retrieve a Stripe customer by ID.',
                'icon' => 'ph:user',
            ],
            'stripe_update_customer' => [
                'class' => StripeUpdateCustomer::class,
                'type' => 'write',
                'name' => 'Update Customer',
                'description' => 'Update an existing Stripe customer.',
                'icon' => 'ph:pencil-simple',
            ],
            'stripe_list_customers' => [
                'class' => StripeListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List Stripe customers.',
                'icon' => 'ph:users',
            ],
            'stripe_delete_customer' => [
                'class' => StripeDeleteCustomer::class,
                'type' => 'write',
                'name' => 'Delete Customer',
                'description' => 'Delete a Stripe customer.',
                'icon' => 'ph:trash',
            ],
            // Products
            'stripe_create_product' => [
                'class' => StripeCreateProduct::class,
                'type' => 'write',
                'name' => 'Create Product',
                'description' => 'Create a new Stripe product.',
                'icon' => 'ph:package',
            ],
            'stripe_list_products' => [
                'class' => StripeListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List Stripe products.',
                'icon' => 'ph:packages',
            ],
            'stripe_get_product' => [
                'class' => StripeGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Retrieve a Stripe product by ID.',
                'icon' => 'ph:package',
            ],
            // Prices
            'stripe_create_price' => [
                'class' => StripeCreatePrice::class,
                'type' => 'write',
                'name' => 'Create Price',
                'description' => 'Create a price for a Stripe product.',
                'icon' => 'ph:currency-dollar',
            ],
            'stripe_list_prices' => [
                'class' => StripeListPrices::class,
                'type' => 'read',
                'name' => 'List Prices',
                'description' => 'List Stripe prices.',
                'icon' => 'ph:currency-dollar',
            ],
            // Payment Intents
            'stripe_create_payment_intent' => [
                'class' => StripeCreatePaymentIntent::class,
                'type' => 'write',
                'name' => 'Create Payment Intent',
                'description' => 'Create a Stripe payment intent.',
                'icon' => 'ph:credit-card',
            ],
            'stripe_get_payment_intent' => [
                'class' => StripeGetPaymentIntent::class,
                'type' => 'read',
                'name' => 'Get Payment Intent',
                'description' => 'Retrieve a Stripe payment intent by ID.',
                'icon' => 'ph:credit-card',
            ],
            'stripe_update_payment_intent' => [
                'class' => StripeUpdatePaymentIntent::class,
                'type' => 'write',
                'name' => 'Update Payment Intent',
                'description' => 'Update a Stripe payment intent.',
                'icon' => 'ph:pencil-simple',
            ],
            'stripe_confirm_payment_intent' => [
                'class' => StripeConfirmPaymentIntent::class,
                'type' => 'write',
                'name' => 'Confirm Payment Intent',
                'description' => 'Confirm a Stripe payment intent.',
                'icon' => 'ph:check-circle',
            ],
            'stripe_cancel_payment_intent' => [
                'class' => StripeCancelPaymentIntent::class,
                'type' => 'write',
                'name' => 'Cancel Payment Intent',
                'description' => 'Cancel a Stripe payment intent.',
                'icon' => 'ph:x-circle',
            ],
            'stripe_capture_payment_intent' => [
                'class' => StripeCapturePaymentIntent::class,
                'type' => 'write',
                'name' => 'Capture Payment Intent',
                'description' => 'Capture a Stripe payment intent.',
                'icon' => 'ph:check-circle',
            ],
            // Invoices
            'stripe_create_invoice' => [
                'class' => StripeCreateInvoice::class,
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a Stripe invoice.',
                'icon' => 'ph:file-text',
            ],
            'stripe_get_invoice' => [
                'class' => StripeGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Retrieve a Stripe invoice by ID.',
                'icon' => 'ph:file-text',
            ],
            'stripe_list_invoices' => [
                'class' => StripeListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List Stripe invoices.',
                'icon' => 'ph:files',
            ],
            'stripe_pay_invoice' => [
                'class' => StripePayInvoice::class,
                'type' => 'write',
                'name' => 'Pay Invoice',
                'description' => 'Pay a Stripe invoice.',
                'icon' => 'ph:money',
            ],
            'stripe_void_invoice' => [
                'class' => StripeVoidInvoice::class,
                'type' => 'write',
                'name' => 'Void Invoice',
                'description' => 'Void a Stripe invoice.',
                'icon' => 'ph:x-circle',
            ],
            // Subscriptions
            'stripe_create_subscription' => [
                'class' => StripeCreateSubscription::class,
                'type' => 'write',
                'name' => 'Create Subscription',
                'description' => 'Create a Stripe subscription.',
                'icon' => 'ph:repeat',
            ],
            'stripe_get_subscription' => [
                'class' => StripeGetSubscription::class,
                'type' => 'read',
                'name' => 'Get Subscription',
                'description' => 'Retrieve a Stripe subscription by ID.',
                'icon' => 'ph:repeat',
            ],
            'stripe_cancel_subscription' => [
                'class' => StripeCancelSubscription::class,
                'type' => 'write',
                'name' => 'Cancel Subscription',
                'description' => 'Cancel a Stripe subscription.',
                'icon' => 'ph:x-circle',
            ],
            // Other
            'stripe_get_balance' => [
                'class' => StripeGetBalance::class,
                'type' => 'read',
                'name' => 'Get Balance',
                'description' => 'Get the Stripe account balance.',
                'icon' => 'ph:wallet',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/stripe.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Secret API Key', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the StripeService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): StripeService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new StripeService(
                apiKey: $creds->get('stripe', 'api_key', '', $account),
            );
        }

        return app(StripeService::class);
    }
}
