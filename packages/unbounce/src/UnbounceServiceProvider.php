<?php

namespace OpenCompany\Integrations\Unbounce;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class UnbounceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UnbounceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new UnbounceService(
                accessToken: $creds->get('unbounce', 'access_token', ''),
                baseUrl: $creds->get('unbounce', 'url', 'https://api.unbounce.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new UnbounceToolProvider());
        }
    }
}
