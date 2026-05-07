<?php

namespace OpenCompany\Integrations\Vultr;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Vultr integration with Laravel's service container.
 *
 * Binds VultrService from host credentials and registers the tool provider
 * with the shared ToolProviderRegistry during boot.
 */
class VultrServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VultrService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new VultrService(
                accessToken: (string) $creds->get('vultr', 'access_token', ''),
                baseUrl: (string) $creds->get('vultr', 'url', 'https://api.vultr.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new VultrToolProvider);
        }
    }
}
