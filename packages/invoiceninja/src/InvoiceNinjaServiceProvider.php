<?php

namespace OpenCompany\Integrations\InvoiceNinja;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Invoice Ninja integration.
 *
 * Registers the InvoiceNinjaService as a singleton and boots the
 * PlausibleToolProvider into the ToolProviderRegistry when available.
 */
class InvoiceNinjaServiceProvider extends ServiceProvider
{
    /**
     * Register the InvoiceNinjaService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(InvoiceNinjaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new InvoiceNinjaService(
                apiToken: $creds->get('invoiceninja', 'api_token', ''),
                baseUrl: $creds->get('invoiceninja', 'url', 'https://invoicing.yourdomain.com'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new InvoiceNinjaToolProvider());
        }
    }
}
