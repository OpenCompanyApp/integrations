<?php

namespace OpenCompany\Integrations\Resend;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the ResendService singleton and bootstraps Resend tools.
 */
class ResendServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ResendService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ResendService(
                apiKey: $creds->get('resend', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ResendToolProvider());
        }
    }
}
