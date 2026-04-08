<?php

namespace OpenCompany\Integrations\Paystack;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Paystack\Tools\PaystackListTransactions;
use OpenCompany\Integrations\Paystack\Tools\PaystackGetTransaction;
use OpenCompany\Integrations\Paystack\Tools\PaystackInitializeTransaction;
use OpenCompany\Integrations\Paystack\Tools\PaystackListCustomers;
use OpenCompany\Integrations\Paystack\Tools\PaystackCreateCustomer;
use OpenCompany\Integrations\Paystack\Tools\PaystackListPlans;
use OpenCompany\Integrations\Paystack\Tools\PaystackGetCurrentUser;

class PaystackToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'paystack';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'transactions, customers, plans',
            'description' => 'Payments platform for Africa',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:paystack',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Paystack',
            'description' => 'Payments platform for Africa — manage transactions, customers, and plans.',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:paystack',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://paystack.com/docs/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'secret_key',
                'type' => 'secret',
                'label' => 'Secret Key',
                'placeholder' => 'sk_test_...',
                'hint' => 'Find your secret key in the Paystack Dashboard under Settings → API Keys & Webhooks',
                'required' => true,
            ],
        ];
    }

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
            ])->timeout(10)->get('https://api.paystack.co/integration/payment_session_timeout');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach Paystack API. Check your network connection.',
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Paystack API error: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Paystack API successfully.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'secret_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'paystack_list_transactions' => [
                'class' => PaystackListTransactions::class,
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List transactions with optional filtering.',
                'icon' => 'ph:list',
            ],
            'paystack_get_transaction' => [
                'class' => PaystackGetTransaction::class,
                'type' => 'read',
                'name' => 'Get Transaction',
                'description' => 'Get details of a specific transaction.',
                'icon' => 'ph:receipt',
            ],
            'paystack_initialize_transaction' => [
                'class' => PaystackInitializeTransaction::class,
                'type' => 'write',
                'name' => 'Initialize Transaction',
                'description' => 'Initialize a new payment transaction.',
                'icon' => 'ph:plus-circle',
            ],
            'paystack_list_customers' => [
                'class' => PaystackListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers on your integration.',
                'icon' => 'ph:users',
            ],
            'paystack_create_customer' => [
                'class' => PaystackCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new customer on your integration.',
                'icon' => 'ph:user-plus',
            ],
            'paystack_list_plans' => [
                'class' => PaystackListPlans::class,
                'type' => 'read',
                'name' => 'List Plans',
                'description' => 'List subscription plans on your integration.',
                'icon' => 'ph:calendar',
            ],
            'paystack_get_current_user' => [
                'class' => PaystackGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Connection Check',
                'description' => 'Verify the Paystack API connection and get session timeout settings.',
                'icon' => 'ph:plugs-connected',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/paystack.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'secret_key', 'type' => 'secret', 'label' => 'Secret Key', 'required' => true],
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

            $service = new PaystackService(
                secretKey: $creds->get('paystack', 'secret_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(PaystackService::class));
    }
}
