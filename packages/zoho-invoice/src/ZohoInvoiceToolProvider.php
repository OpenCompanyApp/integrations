<?php

namespace OpenCompany\Integrations\ZohoInvoice;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
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
 * Tool provider for the Zoho Invoice integration.
 *
 * Declares 7 tools for managing invoices, contacts, items, payments,
 * and user profile. Implements ConfigurableIntegration for the settings UI
 * and supports multi-account via resolveService().
 */
class ZohoInvoiceToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'zoho_invoice';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'invoices, contacts, items, payments',
            'description' => 'Invoicing & accounting',
            'icon' => 'ph:invoice',
            'logo' => 'simple-icons:zoho',
        ];
    }

    // ── ConfigurableIntegration ───────────────────────────

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoho Invoice',
            'description' => 'Online invoicing and billing management',
            'icon' => 'ph:invoice',
            'logo' => 'simple-icons:zoho',
            'category' => 'accounting',
            'badge' => 'verified',
            'docs_url' => 'https://www.zoho.com/invoice/api/v3/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Zoho OAuth access token',
                'hint' => 'Generate an OAuth token from your Zoho API console at <code>https://api-console.zoho.com</code>',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://invoice.zoho.com/api/v3',
                'hint' => 'Use the default for Zoho Invoice global, or your region-specific URL (e.g. <code>https://invoice.zoho.eu/api/v3</code>)',
                'default' => 'https://invoice.zoho.com/api/v3',
            ],
            [
                'key' => 'organization_id',
                'type' => 'text',
                'label' => 'Organization ID',
                'placeholder' => 'e.g., 1234567890',
                'hint' => 'Find your Organization ID in Zoho Invoice under Settings → Organization Profile',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://invoice.zoho.com/api/v3', '/');
        $organizationId = $config['organization_id'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10);

            $params = [];
            if ($organizationId) {
                $params['organization_id'] = $organizationId;
            }

            $response = $http->get($baseUrl . '/users/me', $params);

            if ($response->successful()) {
                $name = $response->json('user.name') ?? $response->json('user.email') ?? 'Unknown';
                return [
                    'success' => true,
                    'message' => "Connected to Zoho Invoice as {$name}.",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Zoho Invoice API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
            'organization_id' => 'nullable|string',
        ];
    }

    // ── Tools ─────────────────────────────────────────────

    public function tools(): array
    {
        return [
            'zohoinvoice_list_invoices' => [
                'class' => ZohoInvoiceListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices with optional filters by status, date, or customer.',
                'icon' => 'ph:list-bullets',
            ],
            'zohoinvoice_get_invoice' => [
                'class' => ZohoInvoiceGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Get full details of a single invoice by ID.',
                'icon' => 'ph:clipboard-text',
            ],
            'zohoinvoice_create_invoice' => [
                'class' => ZohoInvoiceCreateInvoice::class,
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a new invoice for a customer.',
                'icon' => 'ph:plus-circle',
            ],
            'zohoinvoice_list_contacts' => [
                'class' => ZohoInvoiceListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts (customers and vendors).',
                'icon' => 'ph:users',
            ],
            'zohoinvoice_list_items' => [
                'class' => ZohoInvoiceListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List items (products and services).',
                'icon' => 'ph:package',
            ],
            'zohoinvoice_list_payments' => [
                'class' => ZohoInvoiceListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List payments received.',
                'icon' => 'ph:credit-card',
            ],
            'zohoinvoice_get_current_user' => [
                'class' => ZohoInvoiceGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    // ── Shared ────────────────────────────────────────────

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoho-invoice.md';
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
    {
        return new $class($this->resolveService($context));
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
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ZohoInvoiceService(
                accessToken: $creds->get('zoho_invoice', 'access_token', '', $account),
                baseUrl: $creds->get('zoho_invoice', 'base_url', 'https://invoice.zoho.com/api/v3', $account),
                organizationId: $creds->get('zoho_invoice', 'organization_id', '', $account),
            );
        }

        return app(ZohoInvoiceService::class);
    }
}
