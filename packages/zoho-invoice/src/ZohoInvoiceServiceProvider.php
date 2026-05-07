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
            $get = static function (string $key, mixed $default = '') use ($creds): mixed {
                $value = $creds->get('zoho-invoice', $key, null);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('zoho_invoice', $key, $default);
            };

            return new ZohoInvoiceService(
                accessToken: $get('access_token'),
                baseUrl: $get('base_url', 'https://invoice.zoho.com/api/v3'),
                organizationId: $get('organization_id'),
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
