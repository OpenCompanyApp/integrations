<?php

namespace OpenCompany\Integrations\QuickBooks;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksCreateInvoice;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksGetInvoice;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksListInvoices;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksUpdateInvoice;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksCreateCustomer;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksGetCustomer;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksListCustomers;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksUpdateCustomer;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksCreatePayment;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksListPayments;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksCreateEstimate;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksListAccounts;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksCreateBill;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksListVendors;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksGetCompanyInfo;

/**
 * Registers all QuickBooks tools and provides integration metadata.
 */
class QuickBooksToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Return the application identifier for this integration.
     */
    public function appName(): string
    {
        return 'quickbooks';
    }

    /**
     * Return app-level metadata for display in the integrations registry.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'accounting, invoicing, billing',
            'description' => 'Accounting software',
            'icon' => 'ph:book-open',
            'logo' => 'simple-icons:quickbooks',
        ];
    }

    /**
     * Return integration metadata for the QuickBooks Online connector.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'QuickBooks',
            'description' => 'Accounting, invoicing, billing, payments, and financial management',
            'icon' => 'ph:book-open',
            'logo' => 'simple-icons:quickbooks',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.intuit.com/app/developer/qbo/docs/api',
        ];
    }

    /**
     * Return the configuration schema for QuickBooks credentials.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'OAuth2 Access Token',
                'placeholder' => 'eyJlbmMiOiJB...',
                'hint' => 'OAuth2 access token obtained from the QuickBooks OAuth flow. Refresh before expiry.',
                'required' => true,
            ],
            [
                'key' => 'realm_id',
                'type' => 'text',
                'label' => 'Realm ID (Company ID)',
                'placeholder' => '123456789',
                'hint' => 'The company ID returned during the QuickBooks OAuth authorization flow.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the QuickBooks connection by fetching company info.
     *
     * @param  array<string, mixed>  $config  Configuration containing access_token and realm_id
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $realmId = $config['realm_id'] ?? '';

        if (empty($accessToken) || empty($realmId)) {
            return ['success' => false, 'error' => 'Access token and Realm ID are required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$accessToken}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)
              ->get("https://quickbooks.api.intuit.com/v3/company/{$realmId}/companyinfo/{$realmId}");

            if ($response->successful()) {
                $json = $response->json() ?? [];
                $company = $json['CompanyInfo'] ?? $json;
                $name = $company['CompanyName'] ?? 'Unknown Company';

                return [
                    'success' => true,
                    'message' => "Connected to QuickBooks. Company: {$name}",
                ];
            }

            $body = $response->json() ?? [];
            $fault = $body['Fault'] ?? null;
            if ($fault) {
                $errorMessages = array_map(
                    fn (array $e) => $e['Message'] ?? 'Unknown error',
                    $fault['Error'] ?? []
                );
                $error = implode('; ', $errorMessages);
            } else {
                $error = $response->body();
            }

            return [
                'success' => false,
                'error' => 'QuickBooks API error (' . $response->status() . '): ' . $error,
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Return validation rules for QuickBooks configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'realm_id' => 'nullable|string',
        ];
    }

    /**
     * Return all available QuickBooks tools with metadata.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            // Invoices
            'quickbooks_create_invoice' => [
                'class' => QuickBooksCreateInvoice::class,
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a QuickBooks invoice for a customer.',
                'icon' => 'ph:file-text',
            ],
            'quickbooks_get_invoice' => [
                'class' => QuickBooksGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Retrieve a QuickBooks invoice by ID.',
                'icon' => 'ph:file-text',
            ],
            'quickbooks_list_invoices' => [
                'class' => QuickBooksListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List QuickBooks invoices.',
                'icon' => 'ph:files',
            ],
            'quickbooks_update_invoice' => [
                'class' => QuickBooksUpdateInvoice::class,
                'type' => 'write',
                'name' => 'Update Invoice',
                'description' => 'Update an existing QuickBooks invoice.',
                'icon' => 'ph:pencil-simple',
            ],
            // Customers
            'quickbooks_create_customer' => [
                'class' => QuickBooksCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new QuickBooks customer.',
                'icon' => 'ph:user-plus',
            ],
            'quickbooks_get_customer' => [
                'class' => QuickBooksGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Retrieve a QuickBooks customer by ID.',
                'icon' => 'ph:user',
            ],
            'quickbooks_list_customers' => [
                'class' => QuickBooksListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List QuickBooks customers.',
                'icon' => 'ph:users',
            ],
            'quickbooks_update_customer' => [
                'class' => QuickBooksUpdateCustomer::class,
                'type' => 'write',
                'name' => 'Update Customer',
                'description' => 'Update an existing QuickBooks customer.',
                'icon' => 'ph:pencil-simple',
            ],
            // Payments
            'quickbooks_create_payment' => [
                'class' => QuickBooksCreatePayment::class,
                'type' => 'write',
                'name' => 'Create Payment',
                'description' => 'Create a QuickBooks payment and link it to invoices.',
                'icon' => 'ph:money',
            ],
            'quickbooks_list_payments' => [
                'class' => QuickBooksListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List QuickBooks payments.',
                'icon' => 'ph:credit-card',
            ],
            // Estimates
            'quickbooks_create_estimate' => [
                'class' => QuickBooksCreateEstimate::class,
                'type' => 'write',
                'name' => 'Create Estimate',
                'description' => 'Create a QuickBooks estimate for a customer.',
                'icon' => 'ph:calculator',
            ],
            // Accounts
            'quickbooks_list_accounts' => [
                'class' => QuickBooksListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List QuickBooks accounts.',
                'icon' => 'ph:bank',
            ],
            // Bills
            'quickbooks_create_bill' => [
                'class' => QuickBooksCreateBill::class,
                'type' => 'write',
                'name' => 'Create Bill',
                'description' => 'Create a QuickBooks bill from a vendor.',
                'icon' => 'ph:receipt',
            ],
            // Vendors
            'quickbooks_list_vendors' => [
                'class' => QuickBooksListVendors::class,
                'type' => 'read',
                'name' => 'List Vendors',
                'description' => 'List QuickBooks vendors.',
                'icon' => 'ph:briefcase',
            ],
            // Company
            'quickbooks_get_company_info' => [
                'class' => QuickBooksGetCompanyInfo::class,
                'type' => 'read',
                'name' => 'Get Company Info',
                'description' => 'Get QuickBooks company information.',
                'icon' => 'ph:buildings',
            ],
        ];
    }

    /**
     * Return the path to the Lua docs file, or null.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/quickbooks.md';
    }

    /**
     * Return credential field definitions for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'OAuth2 Access Token', 'required' => true],
            ['key' => 'realm_id', 'type' => 'text', 'label' => 'Realm ID (Company ID)', 'required' => true],
        ];
    }

    /**
     * Whether this provider represents a full integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool class with the resolved service.
     *
     * @param  string  $class   Fully-qualified tool class name
     * @param  array<string, mixed>  $context  Optional context with account info
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the QuickBooksService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): QuickBooksService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new QuickBooksService(
                accessToken: $creds->get('quickbooks', 'access_token', '', $account),
                realmId: $creds->get('quickbooks', 'realm_id', '', $account),
            );
        }

        return app(QuickBooksService::class);
    }
}
