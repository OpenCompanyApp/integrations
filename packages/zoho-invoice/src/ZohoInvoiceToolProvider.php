<?php

namespace OpenCompany\Integrations\ZohoInvoice;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ZohoInvoice\Tools\ZohoInvoiceListInvoices;
use OpenCompany\Integrations\ZohoInvoice\Tools\ZohoInvoiceGetInvoice;
use OpenCompany\Integrations\ZohoInvoice\Tools\ZohoInvoiceCreateInvoice;
use OpenCompany\Integrations\ZohoInvoice\Tools\ZohoInvoiceListContacts;
use OpenCompany\Integrations\ZohoInvoice\Tools\ZohoInvoiceListItems;
use OpenCompany\Integrations\ZohoInvoice\Tools\ZohoInvoiceListPayments;
use OpenCompany\Integrations\ZohoInvoice\Tools\ZohoInvoiceGetCurrentUser;

/**
 * Registers the integration provider and exposes its tools.
 */
class ZohoInvoiceToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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



public function appName(): string
    {
        return 'zoho-invoice';
    }

public function appMeta(): array
    {
        return [
            'label' => 'Zoho Invoice',
            'description' => 'Invoicing & accounting',
            'icon' => 'ph:invoice',
            'logo' => 'simple-icons:zoho',
        ];
    }

public function integrationMeta(): array
    {
        return [
            'name' => 'Zoho Invoice',
            'description' => 'Online invoicing and billing management',
            'icon' => 'ph:invoice',
            'logo' => 'simple-icons:zoho',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.zoho.com/invoice/api/v3/',
        ];
    }
        public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Validate that required credentials were supplied for this integration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        foreach ($this->credentialFields() as $field) {
            if (($field['required'] ?? true) && empty($config[$field['key']])) {
                return [
                    'success' => false,
                    'error' => ($field['label'] ?? $field['key']) . ' is required.',
                ];
            }
        }

        return [
            'success' => true,
            'message' => 'Required credentials are configured. API access will be verified when tools run.',
        ];
    }
public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'base_url' => 'nullable|string',
            'organization_id' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'zohoinvoice_list_invoices' => [
                'class' => ZohoInvoiceListInvoices::class,
                'type' => 'read',
                'name' => 'Zohoinvoice List Invoices',
                'description' => 'List invoices from Zoho Invoice. Supports filtering by status (draft, sent, overdue, paid, void, partially_paid), customer, and date range.',
                'icon' => 'ph:wrench',
            ],
            'zohoinvoice_get_invoice' => [
                'class' => ZohoInvoiceGetInvoice::class,
                'type' => 'read',
                'name' => 'Zohoinvoice Get Invoice',
                'description' => 'Get full details of a single invoice by its ID, including line items, totals, payments, and notes.',
                'icon' => 'ph:wrench',
            ],
            'zohoinvoice_create_invoice' => [
                'class' => ZohoInvoiceCreateInvoice::class,
                'type' => 'write',
                'name' => 'Zohoinvoice Create Invoice',
                'description' => 'Create a new invoice in Zoho Invoice. Requires at minimum a customer_id and one line item. Returns the created invoice with its ID and total.',
                'icon' => 'ph:wrench',
            ],
            'zohoinvoice_list_contacts' => [
                'class' => ZohoInvoiceListContacts::class,
                'type' => 'read',
                'name' => 'Zohoinvoice List Contacts',
                'description' => 'List contacts (customers and vendors) from Zoho Invoice. Supports filtering by type (customer or vendor) and pagination.',
                'icon' => 'ph:wrench',
            ],
            'zohoinvoice_list_items' => [
                'class' => ZohoInvoiceListItems::class,
                'type' => 'read',
                'name' => 'Zohoinvoice List Items',
                'description' => 'List items (products and services) from Zoho Invoice. Use item IDs when creating invoices with line items.',
                'icon' => 'ph:wrench',
            ],
            'zohoinvoice_list_payments' => [
                'class' => ZohoInvoiceListPayments::class,
                'type' => 'read',
                'name' => 'Zohoinvoice List Payments',
                'description' => 'List payments received in Zoho Invoice. Supports filtering by customer, date range, and payment mode.',
                'icon' => 'ph:wrench',
            ],
            'zohoinvoice_get_current_user' => [
                'class' => ZohoInvoiceGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Zohoinvoice Get Current User',
                'description' => 'Get the authenticated user\'s profile from Zoho Invoice, including name, email, and role.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/zoho-invoice.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://invoice.zoho.com/api/v3'],
            ['key' => 'organization_id', 'type' => 'string', 'label' => 'Organization ID', 'required' => false],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool class with the appropriate service instance.
     *
     * Supports multi-account: when $context['account'] is set, resolves
     * credentials for that specific account. Otherwise uses the container
     * singleton (default credentials).
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ZohoInvoiceService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ZohoInvoiceService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            $get = static function (string $key, mixed $default = '') use ($creds, $account): mixed {
                $value = $creds->get('zoho-invoice', $key, null, $account);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('zoho_invoice', $key, $default, $account);
            };

            return new ZohoInvoiceService(
                accessToken: $get('access_token'),
                baseUrl: $get('base_url', 'https://invoice.zoho.com/api/v3'),
                organizationId: $get('organization_id'),
            );
        }

        return app(ZohoInvoiceService::class);
    }
}
