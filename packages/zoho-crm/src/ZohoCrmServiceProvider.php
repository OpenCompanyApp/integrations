<?php

namespace OpenCompany\Integrations\ZohoCrm;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the ZohoCrmService singleton and bootstraps Zoho CRM tools.
 */
class ZohoCrmServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZohoCrmService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZohoCrmService(
                accessToken: $creds->get('zoho_crm', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZohoCrmToolProvider());
        }
    }
}
