<?php

namespace OpenCompany\Integrations\FreshworksCrm;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FreshworksCrmServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FreshworksCrmService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            $domain = $creds->get('freshworks_crm', 'domain', '');
            $baseUrl = $domain
                ? "https://{$domain}.myfreshworks.com/crm/sales"
                : $creds->get('freshworks_crm', 'base_url', '');

            return new FreshworksCrmService(
                apiKey: $creds->get('freshworks_crm', 'api_key', ''),
                baseUrl: $baseUrl,
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FreshworksCrmToolProvider());
        }
    }
}
