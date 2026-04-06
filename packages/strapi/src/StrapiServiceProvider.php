<?php

namespace OpenCompany\Integrations\Strapi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class StrapiServiceProvider extends ServiceProvider
{
    /**
     * Register the Strapi service as a singleton.
     */
    public function register(): void
    {
        $this->app->singleton(StrapiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new StrapiService(
                apiToken: $creds->get('strapi', 'api_token', ''),
                baseUrl: $creds->get('strapi', 'url', 'https://localhost:1337'),
            );
        });
    }

    /**
     * Boot the Strapi tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new StrapiToolProvider());
        }
    }
}
