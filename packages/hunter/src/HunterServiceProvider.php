<?php

namespace OpenCompany\Integrations\Hunter;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the HunterService singleton and bootstraps Hunter tools.
 */
class HunterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HunterService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HunterService(
                apiKey: $creds->get('hunter', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HunterToolProvider());
        }
    }
}
