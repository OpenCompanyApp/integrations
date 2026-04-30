<?php

namespace OpenCompany\Integrations\Adyen;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Adyen\Tools\AdyenListTransactions;
use OpenCompany\Integrations\Adyen\Tools\AdyenGetTransaction;
use OpenCompany\Integrations\Adyen\Tools\AdyenMakePayment;
use OpenCompany\Integrations\Adyen\Tools\AdyenCapturePayment;
use OpenCompany\Integrations\Adyen\Tools\AdyenRefundPayment;
use OpenCompany\Integrations\Adyen\Tools\AdyenListStores;
use OpenCompany\Integrations\Adyen\Tools\AdyenGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Adyen\Tools\AdyenGetCurrentMerchant;
use OpenCompany\Integrations\Adyen\Tools\AdyenGetShopper;
use OpenCompany\Integrations\Adyen\Tools\AdyenListShoppers;

/**
 * Registers the integration provider and exposes its tools.
 */
class AdyenToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

/**
     * {@inheritDoc}
     */
    public function appName(): string
    {
        return 'adyen';
    }

    /**
     * {@inheritDoc}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Adyen',
            'description' => 'Global payments platform',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:adyen',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Adyen',
            'description' => 'Global payments platform for businesses — accept, process, and settle payments.',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:adyen',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://docs.adyen.com/api-explorer/',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Adyen API key',
                'hint' => 'Generate an API key in your Adyen Customer Area under Developers → API Credentials',
                'required' => true,
            ],
            [
                'key' => 'merchant_account',
                'type' => 'text',
                'label' => 'Merchant Account',
                'placeholder' => 'e.g., YourCompanyECOM',
                'hint' => 'Your Adyen merchant account code, found in the Customer Area',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://checkout-test.adyen.com',
                'hint' => 'Use <code>https://checkout-test.adyen.com</code> for test, <code>https://checkout-live.adyen.com</code> for live',
                'default' => 'https://checkout-test.adyen.com',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://checkout-test.adyen.com', '/');
        $merchantAccount = $config['merchant_account'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($merchantAccount)) {
            return ['success' => false, 'error' => 'No merchant account provided'];
        }

        try {
            $response = Http::withHeaders([
                'x-API-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post($baseUrl . '/checkout/v67/paymentMethods', [
                'merchantAccount' => $merchantAccount,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Adyen API at {$baseUrl}. Check the URL.",
                ];
            }

            if (! $response->successful()) {
                $error = $json['message'] ?? $json['errorType'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Adyen API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Adyen API (merchant: {$merchantAccount}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'merchant_account' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * {@inheritDoc}
     */
        public function tools(): array
    {
        return [
            'adyen_capture_payment' => [
                'class' => AdyenCapturePayment::class,
                'type' => 'write',
                'name' => 'Capture Payment',
                'description' => 'Capture a previously authorized Adyen payment. Requires the PSP reference of the original payment and the amount to capture (value in minor units + currency). The merchant account is automatically injected.',
                'icon' => 'ph:wrench',
            ],
            'adyen_get_current_merchant' => [
                'class' => AdyenGetCurrentMerchant::class,
                'type' => 'read',
                'name' => 'Get Current Merchant',
                'description' => 'Get current merchant account information from Adyen. Verifies API connectivity and returns available payment methods for the merchant account.',
                'icon' => 'ph:wrench',
            ],
            'adyen_get_current_user' => [
                'class' => AdyenGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Verify Adyen API connectivity and retrieve current merchant account information. Useful as a health check to confirm the integration is properly configured.',
                'icon' => 'ph:wrench',
            ],
            'adyen_get_transaction' => [
                'class' => AdyenGetTransaction::class,
                'type' => 'read',
                'name' => 'Get Transaction',
                'description' => 'Get details of a specific Adyen transaction by its PSP reference. Returns the full transaction object including amount, status, and payment details.',
                'icon' => 'ph:wrench',
            ],
            'adyen_list_stores' => [
                'class' => AdyenListStores::class,
                'type' => 'read',
                'name' => 'List Stores',
                'description' => 'List stores for the configured Adyen merchant account. Returns store details including store codes, names, and addresses. The merchant account is automatically injected.',
                'icon' => 'ph:wrench',
            ],
            'adyen_list_transactions' => [
                'class' => AdyenListTransactions::class,
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List transactions from the Adyen transaction feed. Returns a paginated list of transactions for the merchant account. Use page and size parameters to control pagination.',
                'icon' => 'ph:wrench',
            ],
            'adyen_make_payment' => [
                'class' => AdyenMakePayment::class,
                'type' => 'write',
                'name' => 'Make Payment',
                'description' => 'Initiate a payment through Adyen. Requires amount (value in minor units + currency) and payment method. The merchant account is automatically injected from the integration configuration. Returns the payment result including PSP reference.',
                'icon' => 'ph:wrench',
            ],
            'adyen_refund_payment' => [
                'class' => AdyenRefundPayment::class,
                'type' => 'write',
                'name' => 'Refund Payment',
                'description' => 'Refund an Adyen payment (full or partial). Requires the PSP reference of the original payment and the amount to refund (value in minor units + currency). The merchant account is automatically injected.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    /**
     * {@inheritDoc}
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/adyen.md';
    }

    /**
     * {@inheritDoc}
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'merchant_account', 'type' => 'text', 'label' => 'Merchant Account', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://checkout-test.adyen.com'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new AdyenService(
                apiKey: $creds->get('adyen', 'api_key', '', $account),
                merchantAccount: $creds->get('adyen', 'merchant_account', '', $account),
                baseUrl: $creds->get('adyen', 'url', 'https://checkout-test.adyen.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(AdyenService::class));
    }
}
