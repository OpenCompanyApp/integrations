<?php

namespace OpenCompany\Integrations\Xero;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Xero\Tools\XeroCreateBankTransaction;
use OpenCompany\Integrations\Xero\Tools\XeroCreateContact;
use OpenCompany\Integrations\Xero\Tools\XeroCreateInvoice;
use OpenCompany\Integrations\Xero\Tools\XeroCreatePayment;
use OpenCompany\Integrations\Xero\Tools\XeroGetCurrentUser;
use OpenCompany\Integrations\Xero\Tools\XeroGetContact;
use OpenCompany\Integrations\Xero\Tools\XeroGetInvoice;
use OpenCompany\Integrations\Xero\Tools\XeroListAccounts;
use OpenCompany\Integrations\Xero\Tools\XeroListBankTransactions;
use OpenCompany\Integrations\Xero\Tools\XeroListContacts;
use OpenCompany\Integrations\Xero\Tools\XeroListInvoices;
use OpenCompany\Integrations\Xero\Tools\XeroListOrganisations;
use OpenCompany\Integrations\Xero\Tools\XeroListPayments;
use OpenCompany\Integrations\Xero\Tools\XeroUpdateContact;
use OpenCompany\Integrations\Xero\Tools\XeroUpdateInvoice;

/**
 * Registers all Xero tools and provides integration metadata.
 *
 * Provides tool definitions, configuration schema, connection testing,
 * and credential resolution for the Xero accounting integration.
 */
class XeroToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'xero';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'accounting, invoicing, payments',
            'description' => 'Cloud accounting software',
            'icon' => 'ph:building-office',
            'logo' => 'simple-icons:xero',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Xero',
            'description' => 'Cloud accounting — invoices, contacts, payments, bank transactions, and reporting',
            'icon' => 'ph:building-office',
            'logo' => 'simple-icons:xero',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.xero.com/documentation/api/accounting/overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'eyJhbGciOi...',
                'hint' => 'OAuth2 access token obtained from the Xero OAuth2 flow.',
                'required' => true,
            ],
            [
                'key' => 'tenant_id',
                'type' => 'string',
                'label' => 'Tenant ID',
                'placeholder' => 'e.g. 297c459e-...',
                'hint' => 'The Xero tenant ID for the organisation. Found in the Xero OAuth2 token response.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Xero connection by fetching the connected organisations.
     *
     * @param  array<string, mixed>  $config  Configuration containing access_token and tenant_id
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $tenantId = $config['tenant_id'] ?? '';

        if (empty($accessToken) || empty($tenantId)) {
            return ['success' => false, 'error' => 'Access token and tenant ID are required. Obtain them from the Xero OAuth2 flow.'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->withHeaders([
                    'Xero-Tenant-Id' => $tenantId,
                    'Accept' => 'application/json',
                ])
                ->timeout(10)
                ->get('https://api.xero.com/api.xro/2.0/Organisations');

            if ($response->successful()) {
                $json = $response->json() ?? [];
                $orgs = $json['Organisations'] ?? [];
                $name = $orgs[0]['Name'] ?? 'Unknown Organisation';

                return [
                    'success' => true,
                    'message' => "Connected to Xero organisation: {$name}",
                ];
            }

            $error = $response->json('Message') ?? $response->json('Title') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Xero API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'tenant_id' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Invoices
            'xero_create_invoice' => [
                'class' => XeroCreateInvoice::class,
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a Xero invoice.',
                'icon' => 'ph:file-text',
            ],
            'xero_get_invoice' => [
                'class' => XeroGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Retrieve a Xero invoice by ID.',
                'icon' => 'ph:file-text',
            ],
            'xero_list_invoices' => [
                'class' => XeroListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List Xero invoices.',
                'icon' => 'ph:files',
            ],
            'xero_update_invoice' => [
                'class' => XeroUpdateInvoice::class,
                'type' => 'write',
                'name' => 'Update Invoice',
                'description' => 'Update a Xero invoice.',
                'icon' => 'ph:pencil-simple',
            ],
            // Contacts
            'xero_create_contact' => [
                'class' => XeroCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a Xero contact.',
                'icon' => 'ph:user-plus',
            ],
            'xero_get_contact' => [
                'class' => XeroGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Retrieve a Xero contact by ID.',
                'icon' => 'ph:user',
            ],
            'xero_list_contacts' => [
                'class' => XeroListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List Xero contacts.',
                'icon' => 'ph:users',
            ],
            'xero_update_contact' => [
                'class' => XeroUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update a Xero contact.',
                'icon' => 'ph:pencil-simple',
            ],
            // Payments
            'xero_create_payment' => [
                'class' => XeroCreatePayment::class,
                'type' => 'write',
                'name' => 'Create Payment',
                'description' => 'Create a Xero payment.',
                'icon' => 'ph:money',
            ],
            'xero_list_payments' => [
                'class' => XeroListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List Xero payments.',
                'icon' => 'ph:money',
            ],
            // Accounts
            'xero_list_accounts' => [
                'class' => XeroListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List Xero chart of accounts.',
                'icon' => 'ph:wallet',
            ],
            // Bank Transactions
            'xero_create_bank_transaction' => [
                'class' => XeroCreateBankTransaction::class,
                'type' => 'write',
                'name' => 'Create Bank Transaction',
                'description' => 'Create a Xero bank transaction.',
                'icon' => 'ph:bank',
            ],
            'xero_list_bank_transactions' => [
                'class' => XeroListBankTransactions::class,
                'type' => 'read',
                'name' => 'List Bank Transactions',
                'description' => 'List Xero bank transactions.',
                'icon' => 'ph:bank',
            ],
            // Users
            'xero_get_current_user' => [
                'class' => XeroGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current Xero user.',
                'icon' => 'ph:user-circle',
            ],
            // Organisations
            'xero_list_organisations' => [
                'class' => XeroListOrganisations::class,
                'type' => 'read',
                'name' => 'List Organisations',
                'description' => 'List connected Xero organisations.',
                'icon' => 'ph:buildings',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/xero.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'tenant_id', 'type' => 'string', 'label' => 'Tenant ID', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with resolved service.
     *
     * @param  string  $class  Fully-qualified tool class name
     * @param  array<string, mixed>  $context  Optional context with account credentials
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the XeroService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context  Optional context containing account info
     */
    private function resolveService(array $context = []): XeroService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new XeroService(
                accessToken: $creds->get('xero', 'access_token', '', $account),
                tenantId: $creds->get('xero', 'tenant_id', '', $account),
            );
        }

        return app(XeroService::class);
    }
}
