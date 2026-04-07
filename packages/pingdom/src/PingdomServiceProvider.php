<?php

namespace OpenCompany\Integrations\Pingdom;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PingdomServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PingdomService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PingdomService(
                apiKey: $creds->get('pingdom', 'api_key', ''),
                baseUrl: $creds->get('pingdom', 'url', 'https://api.pingdom.com/api/3.1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PingdomToolProvider());
        }
    }
}
