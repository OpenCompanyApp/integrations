<?php

namespace OpenCompany\Integrations\Avalara;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Avalara integration with Laravel's service container.
 */
class AvalaraServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AvalaraService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AvalaraService(
                accessToken: $creds->get('avalara', 'access_token', ''),
                accountId: $creds->get('avalara', 'account_id', ''),
                licenseKey: $creds->get('avalara', 'license_key', ''),
                companyId: $creds->get('avalara', 'company_id', ''),
                baseUrl: $creds->get('avalara', 'base_url', 'https://rest.avatax.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AvalaraToolProvider);
        }
    }
}