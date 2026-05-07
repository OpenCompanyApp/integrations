<?php

namespace OpenCompany\Integrations\Resend;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Resend integration with Laravel's service container.
 *
 * Binds ResendService from host credentials and registers the tool provider
 * with the shared ToolProviderRegistry during boot.
 */
class ResendServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ResendService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new ResendService(apiKey: (string) $creds->get('resend', 'api_key', ''), baseUrl: (string) $creds->get('resend', 'url', 'https://api.resend.com'));
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new ResendToolProvider);
        }
    }
}
