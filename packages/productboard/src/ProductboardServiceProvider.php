<?php

namespace OpenCompany\Integrations\Productboard;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ProductboardServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ProductboardService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ProductboardService(
                accessToken: $creds->get('productboard', 'access_token', ''),
                baseUrl: $creds->get('productboard', 'url', 'https://api.productboard.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ProductboardToolProvider());
        }
    }
}
