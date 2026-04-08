<?php

namespace OpenCompany\Integrations\Okta;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class OktaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OktaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new OktaService(
                apiToken: $creds->get('okta', 'api_token', ''),
                domain: $creds->get('okta', 'domain', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new OktaToolProvider());
        }
    }
}
