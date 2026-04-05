<?php

namespace OpenCompany\Integrations\Salesforce;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the SalesforceService singleton and bootstraps Salesforce tools.
 */
class SalesforceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SalesforceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SalesforceService(
                accessToken: $creds->get('salesforce', 'access_token', ''),
                instanceUrl: $creds->get('salesforce', 'instance_url', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SalesforceToolProvider());
        }
    }
}
