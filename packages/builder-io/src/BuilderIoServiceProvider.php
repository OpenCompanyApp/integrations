<?php

namespace OpenCompany\Integrations\BuilderIo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the BuilderIoService singleton and bootstraps Builder.io tools.
 */
class BuilderIoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BuilderIoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BuilderIoService(
                apiKey: $creds->get('builder-io', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BuilderIoToolProvider());
        }
    }
}
