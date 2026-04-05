<?php

namespace OpenCompany\Integrations\Box;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class BoxServiceProvider extends ServiceProvider
{
    /**
     * Register the Box service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(BoxService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BoxService(
                accessToken: $creds->get('box', 'access_token', ''),
                baseUrl: $creds->get('box', 'url', 'https://api.box.com/2.0'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BoxToolProvider());
        }
    }
}
