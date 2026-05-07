<?php

namespace OpenCompany\Integrations\Brevo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Brevo integration with Laravel's service container.
 *
 * Binds BrevoService with host-provided credentials and registers the tool
 * provider when the integration registry is available.
 */
class BrevoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BrevoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BrevoService(
                apiKey: (string) $creds->get('brevo', 'api_key', ''),
                baseUrl: (string) $creds->get('brevo', 'url', 'https://api.brevo.com/v3'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BrevoToolProvider());
        }
    }
}
