<?php

namespace OpenCompany\Integrations\Stability;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Stability AI integration with Laravel.
 *
 * Binds the HTTP client from stored credentials and adds the tool provider to
 * the shared registry when the host application exposes it.
 */
class StabilityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(StabilityService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new StabilityService(
                apiKey: $creds->get('stability', 'api_key', ''),
                baseUrl: $creds->get('stability', 'url', 'https://api.stability.ai'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new StabilityToolProvider());
        }
    }
}
