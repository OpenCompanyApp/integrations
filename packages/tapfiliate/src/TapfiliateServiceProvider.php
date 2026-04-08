<?php

namespace OpenCompany\Integrations\Tapfiliate;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TapfiliateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TapfiliateService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TapfiliateService(
                apiKey: $creds->get('tapfiliate', 'api_key', ''),
                baseUrl: $creds->get('tapfiliate', 'url', 'https://api.tapfiliate.com/1.5'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TapfiliateToolProvider());
        }
    }
}
