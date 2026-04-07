<?php

namespace OpenCompany\Integrations\BuyMeACoffee;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class BuyMeACoffeeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BuyMeACoffeeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BuyMeACoffeeService(
                accessToken: $creds->get('buymeacoffee', 'access_token', ''),
                baseUrl: $creds->get('buymeacoffee', 'url', 'https://developers.buymeacoffee.com/api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BuyMeACoffeeToolProvider());
        }
    }
}
