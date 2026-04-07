<?php

namespace OpenCompany\Integrations\Vault;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the HashiCorp Vault integration with Laravel's service container.
 *
 * Binds the VaultService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class VaultServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VaultService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new VaultService(
                token: $creds->get('vault', 'token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new VaultToolProvider());
        }
    }
}
