<?php

namespace OpenCompany\Integrations\ConstantContact;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Constant Contact integration.
 *
 * Registers the ConstantContactService as a singleton (resolving default credentials)
 * and boots the tool provider into the ToolProviderRegistry.
 */
class ConstantContactServiceProvider extends ServiceProvider
{
    /**
     * Register the ConstantContactService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ConstantContactService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ConstantContactService(
                accessToken: $creds->get('constantcontact', 'access_token', ''),
            );
        });
    }

    /**
     * Boot the Constant Contact tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ConstantContactToolProvider());
        }
    }
}
