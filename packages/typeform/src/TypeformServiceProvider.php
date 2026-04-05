<?php

namespace OpenCompany\Integrations\Typeform;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Typeform integration.
 *
 * Registers the TypeformService singleton and bootstraps the Typeform tool provider.
 */
class TypeformServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TypeformService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TypeformService(
                accessToken: $creds->get('typeform', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TypeformToolProvider());
        }
    }
}
