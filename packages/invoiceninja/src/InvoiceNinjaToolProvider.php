<?php

namespace OpenCompany\Integrations\InvoiceNinja;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Registers the integration provider and exposes its tools.
 */
class InvoiceNinjaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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
     * The application identifier used for credential resolution.
     */
    public function appName(): string
    {
        return 'invoiceninja';
    }

    /**
     * Metadata displayed in the integration UI.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Invoice Ninja',
            'description' => 'Invoicing & accounting',
            'icon' => 'ph:invoice',
            'logo' => 'simple-icons:invoiceninja',
        ];
    }

    /**
     * Integration metadata for the marketplace / integration catalog.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Invoice Ninja',
            'description' => 'Invoicing, billing and accounting platform',
            'icon' => 'ph:invoice',
            'logo' => 'simple-icons:invoiceninja',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://invoiceninja.github.io/docs/api-reference/invoice-ninja-api-reference',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Invoice Ninja API token',
                'hint' => 'Generate an API token in your Invoice Ninja account under Settings > Account Management > API Tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://invoicing.co',
                'hint' => 'The base URL of your Invoice Ninja instance (self-hosted or cloud)',
                'default' => 'https://invoicing.co',
            ],
        ];
    }

    /**
     * Test the connection to Invoice Ninja using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://invoicing.co', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-API-TOKEN' => $apiToken,
                'X-Requested-With' => 'XMLHttpRequest',
            ])->timeout(10)->get($baseUrl . '/api/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Invoice Ninja API at {$baseUrl}. Check the URL.",
                ];
            }

            if ($response->successful()) {
                $name = $json['data']['first_name'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Invoice Ninja as {$name}.",
                ];
            }

            $error = $json['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Invoice Ninja API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
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
            'invoiceninja_blank_client' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankClient',
                'type' => 'read',
                'name' => 'Blank Client',
                'description' => 'Fetch a blank client object with Invoice Ninja defaults.',
                'icon' => 'ph:users',
            ],
            'invoiceninja_blank_credit' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankCredit',
                'type' => 'read',
                'name' => 'Blank Credit',
                'description' => 'Fetch a blank Invoice Ninja credit object with defaults.',
                'icon' => 'ph:receipt',
            ],
            'invoiceninja_blank_expense' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankExpense',
                'type' => 'read',
                'name' => 'Blank Expense',
                'description' => 'Fetch a blank Invoice Ninja expense object with defaults.',
                'icon' => 'ph:currency-dollar',
            ],
            'invoiceninja_blank_invoice' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankInvoice',
                'type' => 'read',
                'name' => 'Blank Invoice',
                'description' => 'Fetch a blank invoice object with Invoice Ninja defaults.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_blank_payment' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankPayment',
                'type' => 'read',
                'name' => 'Blank Payment',
                'description' => 'Fetch a blank payment object with Invoice Ninja defaults.',
                'icon' => 'ph:credit-card',
            ],
            'invoiceninja_blank_product' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankProduct',
                'type' => 'read',
                'name' => 'Blank Product',
                'description' => 'Fetch a blank product object with Invoice Ninja defaults.',
                'icon' => 'ph:package',
            ],
            'invoiceninja_blank_project' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankProject',
                'type' => 'read',
                'name' => 'Blank Project',
                'description' => 'Fetch a blank Invoice Ninja project object with defaults.',
                'icon' => 'ph:briefcase',
            ],
            'invoiceninja_blank_purchase_order' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankPurchaseOrder',
                'type' => 'read',
                'name' => 'Blank Purchase Order',
                'description' => 'Fetch a blank Invoice Ninja purchase order object with defaults.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_blank_quote' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankQuote',
                'type' => 'read',
                'name' => 'Blank Quote',
                'description' => 'Fetch a blank Invoice Ninja quote object with defaults.',
                'icon' => 'ph:quotes',
            ],
            'invoiceninja_blank_recurring_invoice' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankRecurringInvoice',
                'type' => 'read',
                'name' => 'Blank Recurring Invoice',
                'description' => 'Fetch a blank Invoice Ninja recurring invoice object with defaults.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_blank_task' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankTask',
                'type' => 'read',
                'name' => 'Blank Task',
                'description' => 'Fetch a blank Invoice Ninja task object with defaults.',
                'icon' => 'ph:check-square',
            ],
            'invoiceninja_blank_tax_rate' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankTaxRate',
                'type' => 'read',
                'name' => 'Blank Tax Rate',
                'description' => 'Fetch a blank Invoice Ninja tax rate object with defaults.',
                'icon' => 'ph:percent',
            ],
            'invoiceninja_blank_vendor' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBlankVendor',
                'type' => 'read',
                'name' => 'Blank Vendor',
                'description' => 'Fetch a blank Invoice Ninja vendor object with defaults.',
                'icon' => 'ph:storefront',
            ],
            'invoiceninja_bulk_clients' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkClients',
                'type' => 'write',
                'name' => 'Bulk Clients',
                'description' => 'Run a documented bulk action against Invoice Ninja clients.',
                'icon' => 'ph:users',
            ],
            'invoiceninja_bulk_credits' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkCredits',
                'type' => 'write',
                'name' => 'Bulk Credits',
                'description' => 'Run a documented bulk action against Invoice Ninja credits.',
                'icon' => 'ph:receipt',
            ],
            'invoiceninja_bulk_expenses' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkExpenses',
                'type' => 'write',
                'name' => 'Bulk Expenses',
                'description' => 'Run a documented bulk action against Invoice Ninja expenses.',
                'icon' => 'ph:currency-dollar',
            ],
            'invoiceninja_bulk_invoices' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkInvoices',
                'type' => 'write',
                'name' => 'Bulk Invoices',
                'description' => 'Run a documented bulk action against Invoice Ninja invoices.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_bulk_payments' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkPayments',
                'type' => 'write',
                'name' => 'Bulk Payments',
                'description' => 'Run a documented bulk action against Invoice Ninja payments.',
                'icon' => 'ph:credit-card',
            ],
            'invoiceninja_bulk_products' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkProducts',
                'type' => 'write',
                'name' => 'Bulk Products',
                'description' => 'Run a documented bulk action against Invoice Ninja products.',
                'icon' => 'ph:package',
            ],
            'invoiceninja_bulk_projects' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkProjects',
                'type' => 'write',
                'name' => 'Bulk Projects',
                'description' => 'Run a documented bulk action against Invoice Ninja projects.',
                'icon' => 'ph:briefcase',
            ],
            'invoiceninja_bulk_purchase_orders' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkPurchaseOrders',
                'type' => 'write',
                'name' => 'Bulk Purchase Orders',
                'description' => 'Run a documented bulk action against Invoice Ninja purchase orders.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_bulk_quotes' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkQuotes',
                'type' => 'write',
                'name' => 'Bulk Quotes',
                'description' => 'Run a documented bulk action against Invoice Ninja quotes.',
                'icon' => 'ph:quotes',
            ],
            'invoiceninja_bulk_recurring_invoices' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkRecurringInvoices',
                'type' => 'write',
                'name' => 'Bulk Recurring Invoices',
                'description' => 'Run a documented bulk action against Invoice Ninja recurring invoices.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_bulk_tasks' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkTasks',
                'type' => 'write',
                'name' => 'Bulk Tasks',
                'description' => 'Run a documented bulk action against Invoice Ninja tasks.',
                'icon' => 'ph:check-square',
            ],
            'invoiceninja_bulk_tax_rates' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkTaxRates',
                'type' => 'write',
                'name' => 'Bulk Tax Rates',
                'description' => 'Run a documented bulk action against Invoice Ninja tax rates.',
                'icon' => 'ph:percent',
            ],
            'invoiceninja_bulk_vendors' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaBulkVendors',
                'type' => 'write',
                'name' => 'Bulk Vendors',
                'description' => 'Run a documented bulk action against Invoice Ninja vendors.',
                'icon' => 'ph:storefront',
            ],
            'invoiceninja_create_client' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreateClient',
                'type' => 'write',
                'name' => 'Create Client',
                'description' => 'Create a new client in Invoice Ninja. Provide name and at least one contact with an email address.',
                'icon' => 'ph:users',
            ],
            'invoiceninja_create_credit' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreateCredit',
                'type' => 'write',
                'name' => 'Create Credit',
                'description' => 'Create an Invoice Ninja credit.',
                'icon' => 'ph:receipt',
            ],
            'invoiceninja_create_expense' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreateExpense',
                'type' => 'write',
                'name' => 'Create Expense',
                'description' => 'Create an Invoice Ninja expense.',
                'icon' => 'ph:currency-dollar',
            ],
            'invoiceninja_create_invoice' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreateInvoice',
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a new invoice in Invoice Ninja. Requires a client_id and at least one line item. Supports custom due dates, partial deposits, and notes.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_create_payment' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreatePayment',
                'type' => 'write',
                'name' => 'Create Payment',
                'description' => 'Create an Invoice Ninja payment.',
                'icon' => 'ph:credit-card',
            ],
            'invoiceninja_create_product' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreateProduct',
                'type' => 'write',
                'name' => 'Create Product',
                'description' => 'Create an Invoice Ninja product.',
                'icon' => 'ph:package',
            ],
            'invoiceninja_create_project' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreateProject',
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create an Invoice Ninja project.',
                'icon' => 'ph:briefcase',
            ],
            'invoiceninja_create_purchase_order' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreatePurchaseOrder',
                'type' => 'write',
                'name' => 'Create Purchase Order',
                'description' => 'Create an Invoice Ninja purchase order.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_create_quote' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreateQuote',
                'type' => 'write',
                'name' => 'Create Quote',
                'description' => 'Create an Invoice Ninja quote.',
                'icon' => 'ph:quotes',
            ],
            'invoiceninja_create_recurring_invoice' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreateRecurringInvoice',
                'type' => 'write',
                'name' => 'Create Recurring Invoice',
                'description' => 'Create an Invoice Ninja recurring invoice.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_create_task' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreateTask',
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create an Invoice Ninja task.',
                'icon' => 'ph:check-square',
            ],
            'invoiceninja_create_tax_rate' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreateTaxRate',
                'type' => 'write',
                'name' => 'Create Tax Rate',
                'description' => 'Create an Invoice Ninja tax rate.',
                'icon' => 'ph:percent',
            ],
            'invoiceninja_create_vendor' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaCreateVendor',
                'type' => 'write',
                'name' => 'Create Vendor',
                'description' => 'Create an Invoice Ninja vendor.',
                'icon' => 'ph:storefront',
            ],
            'invoiceninja_delete_client' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeleteClient',
                'type' => 'write',
                'name' => 'Delete Client',
                'description' => 'Delete or archive an Invoice Ninja client by ID.',
                'icon' => 'ph:users',
            ],
            'invoiceninja_delete_credit' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeleteCredit',
                'type' => 'write',
                'name' => 'Delete Credit',
                'description' => 'Delete or archive an Invoice Ninja credit by ID.',
                'icon' => 'ph:receipt',
            ],
            'invoiceninja_delete_expense' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeleteExpense',
                'type' => 'write',
                'name' => 'Delete Expense',
                'description' => 'Delete or archive an Invoice Ninja expense by ID.',
                'icon' => 'ph:currency-dollar',
            ],
            'invoiceninja_delete_invoice' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeleteInvoice',
                'type' => 'write',
                'name' => 'Delete Invoice',
                'description' => 'Delete or archive an Invoice Ninja invoice by ID.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_delete_payment' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeletePayment',
                'type' => 'write',
                'name' => 'Delete Payment',
                'description' => 'Delete an Invoice Ninja payment by ID.',
                'icon' => 'ph:credit-card',
            ],
            'invoiceninja_delete_product' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeleteProduct',
                'type' => 'write',
                'name' => 'Delete Product',
                'description' => 'Delete or archive an Invoice Ninja product by ID.',
                'icon' => 'ph:package',
            ],
            'invoiceninja_delete_project' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeleteProject',
                'type' => 'write',
                'name' => 'Delete Project',
                'description' => 'Delete or archive an Invoice Ninja project by ID.',
                'icon' => 'ph:briefcase',
            ],
            'invoiceninja_delete_purchase_order' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeletePurchaseOrder',
                'type' => 'write',
                'name' => 'Delete Purchase Order',
                'description' => 'Delete or archive an Invoice Ninja purchase order by ID.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_delete_quote' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeleteQuote',
                'type' => 'write',
                'name' => 'Delete Quote',
                'description' => 'Delete or archive an Invoice Ninja quote by ID.',
                'icon' => 'ph:quotes',
            ],
            'invoiceninja_delete_recurring_invoice' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeleteRecurringInvoice',
                'type' => 'write',
                'name' => 'Delete Recurring Invoice',
                'description' => 'Delete or archive an Invoice Ninja recurring invoice by ID.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_delete_task' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeleteTask',
                'type' => 'write',
                'name' => 'Delete Task',
                'description' => 'Delete or archive an Invoice Ninja task by ID.',
                'icon' => 'ph:check-square',
            ],
            'invoiceninja_delete_tax_rate' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeleteTaxRate',
                'type' => 'write',
                'name' => 'Delete Tax Rate',
                'description' => 'Delete or archive an Invoice Ninja tax rate by ID.',
                'icon' => 'ph:percent',
            ],
            'invoiceninja_delete_vendor' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaDeleteVendor',
                'type' => 'write',
                'name' => 'Delete Vendor',
                'description' => 'Delete or archive an Invoice Ninja vendor by ID.',
                'icon' => 'ph:storefront',
            ],
            'invoiceninja_get_activity' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetActivity',
                'type' => 'read',
                'name' => 'Get Activity',
                'description' => 'Get a single Invoice Ninja activity by ID.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_get_client' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetClient',
                'type' => 'read',
                'name' => 'Get Client',
                'description' => 'Get a single Invoice Ninja client by ID.',
                'icon' => 'ph:users',
            ],
            'invoiceninja_get_credit' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetCredit',
                'type' => 'read',
                'name' => 'Get Credit',
                'description' => 'Get a single Invoice Ninja credit by ID.',
                'icon' => 'ph:receipt',
            ],
            'invoiceninja_get_current_user' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetCurrentUser',
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated Invoice Ninja user. Useful for verifying connection details and account information.',
                'icon' => 'ph:user',
            ],
            'invoiceninja_get_expense' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetExpense',
                'type' => 'read',
                'name' => 'Get Expense',
                'description' => 'Get a single Invoice Ninja expense by ID.',
                'icon' => 'ph:currency-dollar',
            ],
            'invoiceninja_get_invoice' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetInvoice',
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Get a single invoice from Invoice Ninja by ID. Returns full invoice details including line items, client info, and payment status.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_get_payment' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetPayment',
                'type' => 'read',
                'name' => 'Get Payment',
                'description' => 'Get a single Invoice Ninja payment by ID.',
                'icon' => 'ph:credit-card',
            ],
            'invoiceninja_get_product' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetProduct',
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get a single Invoice Ninja product by ID.',
                'icon' => 'ph:package',
            ],
            'invoiceninja_get_project' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetProject',
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get a single Invoice Ninja project by ID.',
                'icon' => 'ph:briefcase',
            ],
            'invoiceninja_get_purchase_order' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetPurchaseOrder',
                'type' => 'read',
                'name' => 'Get Purchase Order',
                'description' => 'Get a single Invoice Ninja purchase order by ID.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_get_quote' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetQuote',
                'type' => 'read',
                'name' => 'Get Quote',
                'description' => 'Get a single Invoice Ninja quote by ID.',
                'icon' => 'ph:quotes',
            ],
            'invoiceninja_get_recurring_invoice' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetRecurringInvoice',
                'type' => 'read',
                'name' => 'Get Recurring Invoice',
                'description' => 'Get a single Invoice Ninja recurring invoice by ID.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_get_task' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetTask',
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get a single Invoice Ninja task by ID.',
                'icon' => 'ph:check-square',
            ],
            'invoiceninja_get_tax_rate' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetTaxRate',
                'type' => 'read',
                'name' => 'Get Tax Rate',
                'description' => 'Get a single Invoice Ninja tax rate by ID.',
                'icon' => 'ph:percent',
            ],
            'invoiceninja_get_user' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetUser',
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get a single Invoice Ninja user by ID.',
                'icon' => 'ph:user',
            ],
            'invoiceninja_get_vendor' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaGetVendor',
                'type' => 'read',
                'name' => 'Get Vendor',
                'description' => 'Get a single Invoice Ninja vendor by ID.',
                'icon' => 'ph:storefront',
            ],
            'invoiceninja_health_check' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaHealthCheck',
                'type' => 'read',
                'name' => 'Health Check',
                'description' => 'Call the Invoice Ninja health-check endpoint.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_list_activities' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListActivities',
                'type' => 'read',
                'name' => 'List Activities',
                'description' => 'List Invoice Ninja account activities.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_list_clients' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListClients',
                'type' => 'read',
                'name' => 'List Clients',
                'description' => 'List clients from Invoice Ninja. Supports filtering by name, email, and ID number with pagination.',
                'icon' => 'ph:users',
            ],
            'invoiceninja_list_credits' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListCredits',
                'type' => 'read',
                'name' => 'List Credits',
                'description' => 'List Invoice Ninja credits with optional filters and pagination.',
                'icon' => 'ph:receipt',
            ],
            'invoiceninja_list_expenses' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListExpenses',
                'type' => 'read',
                'name' => 'List Expenses',
                'description' => 'List Invoice Ninja expenses with optional filters and pagination.',
                'icon' => 'ph:currency-dollar',
            ],
            'invoiceninja_list_invoices' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListInvoices',
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices from Invoice Ninja. Supports filtering by client, status, and date range with pagination.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_list_payments' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListPayments',
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List payments from Invoice Ninja. Supports filtering by client, invoice, status, and date range with pagination.',
                'icon' => 'ph:credit-card',
            ],
            'invoiceninja_list_products' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListProducts',
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List products from Invoice Ninja. Supports filtering by product key, custom value, and text search with pagination.',
                'icon' => 'ph:package',
            ],
            'invoiceninja_list_projects' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListProjects',
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List Invoice Ninja projects with optional filters and pagination.',
                'icon' => 'ph:briefcase',
            ],
            'invoiceninja_list_purchase_orders' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListPurchaseOrders',
                'type' => 'read',
                'name' => 'List Purchase Orders',
                'description' => 'List Invoice Ninja purchase orders with optional filters and pagination.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_list_quotes' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListQuotes',
                'type' => 'read',
                'name' => 'List Quotes',
                'description' => 'List Invoice Ninja quotes with optional filters and pagination.',
                'icon' => 'ph:quotes',
            ],
            'invoiceninja_list_recurring_invoices' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListRecurringInvoices',
                'type' => 'read',
                'name' => 'List Recurring Invoices',
                'description' => 'List Invoice Ninja recurring invoices with optional filters and pagination.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_list_tasks' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListTasks',
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List Invoice Ninja tasks with optional filters and pagination.',
                'icon' => 'ph:check-square',
            ],
            'invoiceninja_list_tax_rates' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListTaxRates',
                'type' => 'read',
                'name' => 'List Tax Rates',
                'description' => 'List Invoice Ninja tax rates with optional filters and pagination.',
                'icon' => 'ph:percent',
            ],
            'invoiceninja_list_users' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListUsers',
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Invoice Ninja users.',
                'icon' => 'ph:user',
            ],
            'invoiceninja_list_vendors' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaListVendors',
                'type' => 'read',
                'name' => 'List Vendors',
                'description' => 'List Invoice Ninja vendors with optional filters and pagination.',
                'icon' => 'ph:storefront',
            ],
            'invoiceninja_ping' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaPing',
                'type' => 'read',
                'name' => 'Ping',
                'description' => 'Call the Invoice Ninja ping endpoint.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_refund_payment' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaRefundPayment',
                'type' => 'write',
                'name' => 'Refund Payment',
                'description' => 'Refund an Invoice Ninja payment.',
                'icon' => 'ph:credit-card',
            ],
            'invoiceninja_statics' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaStatics',
                'type' => 'read',
                'name' => 'Statics',
                'description' => 'Fetch Invoice Ninja static reference data used by selectors.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_update_client' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdateClient',
                'type' => 'write',
                'name' => 'Update Client',
                'description' => 'Update an Invoice Ninja client. Mutating client requests should include child contacts when changing contact data.',
                'icon' => 'ph:users',
            ],
            'invoiceninja_update_credit' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdateCredit',
                'type' => 'write',
                'name' => 'Update Credit',
                'description' => 'Update an Invoice Ninja credit by ID.',
                'icon' => 'ph:receipt',
            ],
            'invoiceninja_update_expense' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdateExpense',
                'type' => 'write',
                'name' => 'Update Expense',
                'description' => 'Update an Invoice Ninja expense by ID.',
                'icon' => 'ph:currency-dollar',
            ],
            'invoiceninja_update_invoice' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdateInvoice',
                'type' => 'write',
                'name' => 'Update Invoice',
                'description' => 'Update an Invoice Ninja invoice by ID.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_update_payment' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdatePayment',
                'type' => 'write',
                'name' => 'Update Payment',
                'description' => 'Update an Invoice Ninja payment by ID.',
                'icon' => 'ph:credit-card',
            ],
            'invoiceninja_update_product' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdateProduct',
                'type' => 'write',
                'name' => 'Update Product',
                'description' => 'Update an Invoice Ninja product by ID.',
                'icon' => 'ph:package',
            ],
            'invoiceninja_update_project' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdateProject',
                'type' => 'write',
                'name' => 'Update Project',
                'description' => 'Update an Invoice Ninja project by ID.',
                'icon' => 'ph:briefcase',
            ],
            'invoiceninja_update_purchase_order' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdatePurchaseOrder',
                'type' => 'write',
                'name' => 'Update Purchase Order',
                'description' => 'Update an Invoice Ninja purchase order by ID.',
                'icon' => 'ph:database',
            ],
            'invoiceninja_update_quote' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdateQuote',
                'type' => 'write',
                'name' => 'Update Quote',
                'description' => 'Update an Invoice Ninja quote by ID.',
                'icon' => 'ph:quotes',
            ],
            'invoiceninja_update_recurring_invoice' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdateRecurringInvoice',
                'type' => 'write',
                'name' => 'Update Recurring Invoice',
                'description' => 'Update an Invoice Ninja recurring invoice by ID.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_update_task' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdateTask',
                'type' => 'write',
                'name' => 'Update Task',
                'description' => 'Update an Invoice Ninja task by ID.',
                'icon' => 'ph:check-square',
            ],
            'invoiceninja_update_tax_rate' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdateTaxRate',
                'type' => 'write',
                'name' => 'Update Tax Rate',
                'description' => 'Update an Invoice Ninja tax rate by ID.',
                'icon' => 'ph:percent',
            ],
            'invoiceninja_update_vendor' => [
                'class' => 'OpenCompany\\Integrations\\InvoiceNinja\\Tools\\InvoiceNinjaUpdateVendor',
                'type' => 'write',
                'name' => 'Update Vendor',
                'description' => 'Update an Invoice Ninja vendor by ID.',
                'icon' => 'ph:storefront',
            ],
        ];
    }

    /**
     * Path to the JavaScript API reference documentation.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/invoiceninja.md';
    }

    /**
     * Credential fields for the integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Instance URL', 'required' => false, 'default' => 'https://invoicing.co'],
        ];
    }

    /**
     * Indicate this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, with optional multi-account credential resolution.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the InvoiceNinjaService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): InvoiceNinjaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new InvoiceNinjaService(
                apiToken: $creds->get('invoiceninja', 'api_token', '', $account),
                baseUrl: $creds->get('invoiceninja', 'url', 'https://invoicing.co', $account),
            );
        }

        return app(InvoiceNinjaService::class);
    }
}
