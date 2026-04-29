<?php

namespace OpenCompany\Integrations\Flutterwave;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveCreateCustomer;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveGetBanks;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveGetTransaction;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveInitiatePayment;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveListCustomers;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveListTransactions;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveVerifyTransaction;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FlutterwaveToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * The application name used to identify this integration.
     */
    public function appName(): string
    {
        return 'flutterwave';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Flutterwave',
            'description' => 'Flutterwave payments integration for Laravel — manage transactions, customers, and…',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Flutterwave',
            'description' => 'Flutterwave payments integration for Laravel — manage transactions, customers, and bank lookups.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Configuration schema for the Flutterwave integration.
     *
     * Defines the `secret_key` credential that the user must provide.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'secret_key',
                'type' => 'secret',
                'label' => 'Secret Key',
                'placeholder' => 'Enter your Flutterwave secret key',
                'hint' => 'Find your secret key in the Flutterwave dashboard under <strong>Settings → API Keys</strong>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to Flutterwave by fetching Nigerian banks.
     *
     * @param  array  $config  The resolved configuration containing `secret_key`.
     * @return array `{ success: bool, message?: string, error?: string }`
     */
    public function testConnection(array $config): array
    {
        $secretKey = $config['secret_key'] ?? '';

        if (empty($secretKey)) {
            return ['success' => false, 'error' => 'No secret key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $secretKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.flutterwave.com/v3/banks/NG');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach the Flutterwave API. Check your network connection.',
                ];
            }

            if (($json['status'] ?? '') === 'success' || $response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Flutterwave API successfully.',
                ];
            }

            return [
                'success' => false,
                'error' => $json['message'] ?? 'Unexpected response from Flutterwave API.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'secret_key' => 'nullable|string',
        ];
    }

    /**
     * The tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'flutterwave_list_transactions' => [
                'class' => FlutterwaveListTransactions::class,
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List transactions with optional filtering by status and date range.',
                'icon' => 'ph:list-bullets',
            ],
            'flutterwave_get_transaction' => [
                'class' => FlutterwaveGetTransaction::class,
                'type' => 'read',
                'name' => 'Get Transaction',
                'description' => 'Retrieve details of a specific transaction by ID.',
                'icon' => 'ph:receipt',
            ],
            'flutterwave_initiate_payment' => [
                'class' => FlutterwaveInitiatePayment::class,
                'type' => 'write',
                'name' => 'Initiate Payment',
                'description' => 'Initiate a new payment with customer and amount details.',
                'icon' => 'ph:credit-card',
            ],
            'flutterwave_verify_transaction' => [
                'class' => FlutterwaveVerifyTransaction::class,
                'type' => 'read',
                'name' => 'Verify Transaction',
                'description' => 'Verify a transaction by its ID or reference to confirm payment status.',
                'icon' => 'ph:shield-check',
            ],
            'flutterwave_list_customers' => [
                'class' => FlutterwaveListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers registered on your Flutterwave account.',
                'icon' => 'ph:users',
            ],
            'flutterwave_create_customer' => [
                'class' => FlutterwaveCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new customer record in Flutterwave.',
                'icon' => 'ph:user-plus',
            ],
            'flutterwave_get_banks' => [
                'class' => FlutterwaveGetBanks::class,
                'type' => 'read',
                'name' => 'Get Banks',
                'description' => 'Get a list of supported banks for a given country code.',
                'icon' => 'ph:buildings',
            ],
        ];
    }

    /**
     * Path to the Lua documentation file for agent context (optional).
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/flutterwave.md';
    }

    /**
     * Credential fields for the integration (mirrors configSchema for CredentialResolver).
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'secret_key', 'type' => 'secret', 'label' => 'Secret Key', 'required' => true],
        ];
    }

    /**
     * Confirm this class acts as an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool class with the appropriate FlutterwaveService.
     *
     * If an account context is provided, credentials are resolved per-account;
     * otherwise the singleton service from the container is used.
     *
     * @param  class-string<Tool>  $class   The tool class to instantiate.
     * @param  array               $context Optional context containing an `account` key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new FlutterwaveService(
                secretKey: $creds->get('flutterwave', 'secret_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(FlutterwaveService::class));
    }
}
