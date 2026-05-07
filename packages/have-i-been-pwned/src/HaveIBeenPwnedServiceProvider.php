<?php

namespace OpenCompany\Integrations\HaveIBeenPwned;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Have I Been Pwned integration with Laravel's service container.
 *
 * Binds the HIBP API client using optional host credentials and registers the
 * tool provider with the shared ToolProviderRegistry when available.
 */
class HaveIBeenPwnedServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HaveIBeenPwnedService::class, function ($app): HaveIBeenPwnedService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new HaveIBeenPwnedService(apiKey: $creds?->get('have-i-been-pwned', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new HaveIBeenPwnedToolProvider);
        }
    }
}
