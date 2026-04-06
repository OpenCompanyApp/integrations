<?php

namespace OpenCompany\Integrations\ZohoBills;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ZohoBills\Tools\ZohoBillsCreateInvoice;
use OpenCompany\Integrations\ZohoBills\Tools\ZohoBillsGetCurrentUser;
use OpenCompany\Integrations\ZohoBills\Tools\ZohoBillsGetCustomer;
use OpenCompany\Integrations\ZohoBills\Tools\ZohoBillsGetInvoice;
use OpenCompany\Integrations\ZohoBills\Tools\ZohoBillsListCustomers;
use OpenCompany\Integrations\ZohoBills\Tools\ZohoBillsListInvoices;
use OpenCompany\Integrations\ZohoBills\Tools\ZohoBillsListItems;

class ZohoBillsToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'zoho_bills';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'invoices, customers, items',
            'description' => 'Billing & invoicing',
            'icon' => 'ph:receipt',
            'logo' => 'simple-icons:zoho',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoho Bills',
            'description' => 'Online billing and invoicing software by Zoho',
            'icon' => 'ph:receipt',
            'logo' => 'simple-icons:zoho',
            'category' => 'payments',
            'badge' => 'verified',
            'docs_url' => 'https://www.zoho.com/bills/api/v3/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Zoho Bills OAuth access token',
                'hint' => 'Generate an OAuth token in your Zoho API Console with <code>ZohoBilling.invoices.READ</code> (and <code>.CREATE</code> for write access) scopes',
                'required' => true,
            ],
            [
                'key' => 'organization_id',
                'type' => 'string',
                'label' => 'Organization ID',
                'placeholder' => 'Enter your Zoho organization ID',
                'hint' => 'Find your Organization ID in Zoho Bills under <strong>Settings → Organization Profile</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://billing.zoho.com',
                'hint' => 'Use <code>https://billing.zoho.com</code> for global, <code>https://billing.zoho.eu</code> for EU, or your custom domain',
                'default' => 'https://billing.zoho.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $organizationId = $config['organization_id'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://billing.zoho.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($organizationId)) {
            return ['success' => false, 'error' => 'No organization ID provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'X-com-zoho-bills-organizationid' => $organizationId,
            ])->timeout(10)->get($baseUrl . '/api/v3/users/me', [
                'organization_id' => $organizationId,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Zoho Bills API at {$baseUrl}. Check the URL and credentials.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Zoho Bills API error: {$error}",
                ];
            }

            $userName = $json['user']['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Zoho Bills as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'organization_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'zoho_bills_list_invoices' => [
                'class' => ZohoBillsListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices with optional status and customer filters.',
                'icon' => 'ph:invoices',
            ],
            'zoho_bills_get_invoice' => [
                'class' => ZohoBillsGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Retrieve a single invoice by ID.',
                'icon' => 'ph:invoices',
            ],
            'zoho_bills_create_invoice' => [
                'class' => ZohoBillsCreateInvoice::class,
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a new invoice for a customer.',
                'icon' => 'ph:invoices',
            ],
            'zoho_bills_list_customers' => [
                'class' => ZohoBillsListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers (contacts) with optional type filter.',
                'icon' => 'ph:users',
            ],
            'zoho_bills_get_customer' => [
                'class' => ZohoBillsGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Retrieve a single customer by ID.',
                'icon' => 'ph:users',
            ],
            'zoho_bills_list_items' => [
                'class' => ZohoBillsListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List items (products and services).',
                'icon' => 'ph:package',
            ],
            'zoho_bills_get_current_user' => [
                'class' => ZohoBillsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Zoho Bills user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoho-bills.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'organization_id', 'type' => 'string', 'label' => 'Organization ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://billing.zoho.com'],
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

            $service = new ZohoBillsService(
                accessToken: $creds->get('zoho_bills', 'access_token', '', $account),
                organizationId: $creds->get('zoho_bills', 'organization_id', '', $account),
                baseUrl: $creds->get('zoho_bills', 'url', 'https://billing.zoho.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(ZohoBillsService::class));
    }
}
