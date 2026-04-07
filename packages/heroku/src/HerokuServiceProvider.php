<?php

namespace OpenCompany\Integrations\Heroku;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class HerokuServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HerokuService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HerokuService(
                apiKey: $creds->get('heroku', 'api_key', ''),
                baseUrl: $creds->get('heroku', 'url', 'https://api.heroku.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HerokuToolProvider());
        }
    }
}
