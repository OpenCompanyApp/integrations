<?php

namespace OpenCompany\Integrations\OpenWeather;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the OpenWeather integration with Laravel's service container.
 *
 * Binds OpenWeatherService using host credentials and registers the provider
 * with the shared ToolProviderRegistry during boot.
 */
class OpenWeatherServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OpenWeatherService::class, function ($app): OpenWeatherService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new OpenWeatherService(apiKey: $creds?->get('openweather', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new OpenWeatherToolProvider);
        }
    }
}
