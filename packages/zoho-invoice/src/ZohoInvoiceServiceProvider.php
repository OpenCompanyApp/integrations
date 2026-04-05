<?php

namespace OpenCompany\Integrations\ZohoInvoice;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Zoho Invoice integration.
 *
 * Registers the ZohoInvoiceService singleton with credentials from the
 * CredentialResolver, and boots the ToolProvider into the registry.
 */
class ZohoInvoiceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZohoInvoiceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZohoInvoiceService(
                accessToken: $creds->get('zoho_invoice', 'access_token', ''),
                baseUrl: $creds->get('zoho_invoice', 'base_url', 'https://invoice.zoho.com/api/v3'),
                organizationId: $creds->get('zoho_invoice', 'organization_id', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZohoInvoiceToolProvider());
        }
    }
}
