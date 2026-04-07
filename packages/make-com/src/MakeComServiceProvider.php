<?php

namespace OpenCompany\Integrations\MakeCom;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Make.com integration.
 *
 * Registers the MakeComService singleton and bootstraps the Make.com tool provider.
 */
class MakeComServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MakeComService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MakeComService(
                apiToken: $creds->get('make-com', 'api_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MakeComToolProvider());
        }
    }
}
