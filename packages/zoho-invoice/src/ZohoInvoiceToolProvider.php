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

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

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
        return 'zoho_invoice';
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
            'category' => 'accounting',
            'badge' => 'verified',
            'docs_url' => 'https://www.zoho.com/invoice/api/v3/',
        ];
    }public function credentialFields(): array
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
