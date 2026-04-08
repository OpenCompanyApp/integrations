<?php

namespace OpenCompany\Integrations\Prismic;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PrismicServiceProvider extends ServiceProvider
{
    /**
     * Register the Prismic service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(PrismicService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PrismicService(
                accessToken: $creds->get('prismic', 'access_token', ''),
                repository: $creds->get('prismic', 'repository', ''),
            );
        });
    }

    /**
     * Boot the Prismic service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PrismicToolProvider());
        }
    }
}
