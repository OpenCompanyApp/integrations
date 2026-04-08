<?php

namespace OpenCompany\Integrations\Sinch;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Sinch integration.
 *
 * Registers the SinchService singleton and bootstraps the Sinch tool provider.
 */
class SinchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SinchService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SinchService(
                servicePlanId: $creds->get('sinch', 'service_plan_id', ''),
                apiToken: $creds->get('sinch', 'api_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SinchToolProvider());
        }
    }
}
