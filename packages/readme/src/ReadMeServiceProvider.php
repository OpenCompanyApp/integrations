<?php

namespace OpenCompany\Integrations\ReadMe;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the ReadMe integration with Laravel's service container.
 *
 * Binds ReadMeService using host credentials and registers the provider with
 * the ToolProviderRegistry during boot.
 */
class ReadMeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ReadMeService::class, function ($app): ReadMeService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new ReadMeService(apiToken: $creds?->get('readme', 'api_token', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new ReadMeToolProvider);
        }
    }
}
