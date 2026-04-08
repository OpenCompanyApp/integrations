<?php

namespace OpenCompany\Integrations\AuthZero;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Auth0 integration package.
 *
 * Registers the {@see AuthZeroService} as a singleton (credentials resolved at
 * resolution time) and bootstraps the {@see AuthZeroToolProvider} into the
 * central ToolProviderRegistry.
 */
class AuthZeroServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AuthZeroService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AuthZeroService(
                accessToken: $creds->get('auth-zero', 'access_token', ''),
                domain: $creds->get('auth-zero', 'domain', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AuthZeroToolProvider());
        }
    }
}
