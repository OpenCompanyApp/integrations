<?php

namespace OpenCompany\Integrations\Monday;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the MondayService singleton and bootstraps Monday.com tools.
 */
class MondayServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MondayService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MondayService(
                apiToken: $creds->get('monday', 'api_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MondayToolProvider());
        }
    }
}
