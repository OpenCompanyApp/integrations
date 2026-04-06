<?php

namespace OpenCompany\Integrations\ChargeOver;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListCustomers;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetCustomer;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListSubscriptions;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListInvoices;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetInvoice;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListTransactions;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetCurrentUser;

class ChargeOverToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'chargeover';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'customers, subscriptions, invoices, transactions',
            'description' => 'Billing & subscription management',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:chargeover',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'ChargeOver',
            'description' => 'Recurring billing and subscription management platform',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:chargeover',
            'category' => 'payments',
            'badge' => 'verified',
            'docs_url' => 'https://developer.chargeover.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your ChargeOver API token',
                'hint' => 'Generate an API token in your ChargeOver admin under Settings > API',
                'required' => true,
            ],
            [
                'key' => 'subdomain',
                'type' => 'string',
                'label' => 'Subdomain',
                'placeholder' => 'mycompany',
                'hint' => 'Your ChargeOver subdomain (e.g., <code>mycompany</code> for <code>mycompany.chargeover.com</code>)',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Custom URL',
                'placeholder' => 'https://mycompany.chargeover.com',
                'hint' => 'Override the base URL if using a custom domain or self-hosted instance. Takes priority over subdomain.',
                'default' => '',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $subdomain = $config['subdomain'] ?? '';
        $baseUrl = rtrim($config['url'] ?? '', '/');

        if (empty($baseUrl) && !empty($subdomain)) {
            $baseUrl = 'https://' . $subdomain . '.chargeover.com';
        }

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No subdomain or custom URL provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v3/me');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to ChargeOver API at {$baseUrl}.",
                ];
            }

            return [
                'success' => false,
                'error' => "ChargeOver API returned HTTP {$response->status()}: " . ($response->json('message') ?? $response->body()),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'subdomain' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'chargeover_list_customers' => [
                'class' => ChargeOverListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers from ChargeOver.',
                'icon' => 'ph:users',
            ],
            'chargeover_get_customer' => [
                'class' => ChargeOverGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get details for a specific customer.',
                'icon' => 'ph:user',
            ],
            'chargeover_list_subscriptions' => [
                'class' => ChargeOverListSubscriptions::class,
                'type' => 'read',
                'name' => 'List Subscriptions',
                'description' => 'List subscriptions from ChargeOver.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargeover_list_invoices' => [
                'class' => ChargeOverListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices from ChargeOver.',
                'icon' => 'ph:file-text',
            ],
            'chargeover_get_invoice' => [
                'class' => ChargeOverGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Get details for a specific invoice.',
                'icon' => 'ph:file',
            ],
            'chargeover_list_transactions' => [
                'class' => ChargeOverListTransactions::class,
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List transactions (payments) from ChargeOver.',
                'icon' => 'ph:money',
            ],
            'chargeover_get_current_user' => [
                'class' => ChargeOverGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user / account info.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/chargeover.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'subdomain', 'type' => 'string', 'label' => 'Subdomain', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'Custom URL', 'required' => false, 'default' => ''],
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

            $service = new ChargeOverService(
                accessToken: $creds->get('chargeover', 'access_token', '', $account),
                subdomain: $creds->get('chargeover', 'subdomain', '', $account),
                baseUrl: $creds->get('chargeover', 'url', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ChargeOverService::class));
    }
}
