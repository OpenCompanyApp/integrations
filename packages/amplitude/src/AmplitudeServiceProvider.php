<?php

namespace OpenCompany\Integrations\Amplitude;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * AmplitudeServiceProvider — Laravel service provider for the Amplitude integration.
 *
 * Registers the AmplitudeService singleton (resolving credentials from the
 * CredentialResolver) and boots the tool provider into the ToolProviderRegistry.
 */
class AmplitudeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AmplitudeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AmplitudeService(
                apiKey: $creds->get('amplitude', 'api_key', ''),
                baseUrl: $creds->get('amplitude', 'url', 'https://api.amplitude.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AmplitudeToolProvider());
        }
    }
}
