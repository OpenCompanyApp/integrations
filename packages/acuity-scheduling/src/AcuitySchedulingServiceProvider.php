<?php

namespace OpenCompany\Integrations\AcuityScheduling;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Acuity Scheduling integration with Laravel.
 *
 * Binds the AcuitySchedulingService singleton and registers its tool provider
 * for discovery when the shared registry is available.
 */
class AcuitySchedulingServiceProvider extends ServiceProvider
{
    /**
     * Register the Acuity Scheduling service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(AcuitySchedulingService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AcuitySchedulingService(
                accessToken: $creds->get('acuity-scheduling', 'access_token', ''),
                baseUrl: $creds->get('acuity-scheduling', 'url', 'https://acuityscheduling.com/api/v1'),
                userId: $creds->get('acuity-scheduling', 'user_id', ''),
                apiKey: $creds->get('acuity-scheduling', 'api_key', ''),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AcuitySchedulingToolProvider());
        }
    }
}
