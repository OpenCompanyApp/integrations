<?php

namespace OpenCompany\Integrations\Etsy;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class EtsyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EtsyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new EtsyService(
                accessToken: $creds->get('etsy', 'access_token', ''),
                shopId: $creds->get('etsy', 'shop_id', ''),
                baseUrl: $creds->get('etsy', 'base_url', 'https://openapi.etsy.com/v3/application'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new EtsyToolProvider());
        }
    }
}
