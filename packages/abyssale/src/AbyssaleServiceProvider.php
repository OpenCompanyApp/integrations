<?php

namespace OpenCompany\Integrations\Abyssale;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers Abyssale services and tool provider with Laravel.
 */
class AbyssaleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AbyssaleService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AbyssaleService(
                apiKey: $creds->get('abyssale', 'access_token', ''),
                baseUrl: $creds->get('abyssale', 'url', 'https://api.abyssale.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AbyssaleToolProvider());
        }
    }
}
