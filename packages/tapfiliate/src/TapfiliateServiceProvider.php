<?php

namespace OpenCompany\Integrations\Tapfiliate;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Tapfiliate integration with Laravel's service container.
 *
 * Binds the Tapfiliate API client and registers the tool provider for discovery.
 */
class TapfiliateServiceProvider extends ServiceProvider
{
    /**
     * Register the Tapfiliate service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(TapfiliateService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TapfiliateService(
                apiKey: $creds->get('tapfiliate', 'api_key', ''),
                baseUrl: $creds->get('tapfiliate', 'url', 'https://api.tapfiliate.com/1.6'),
            );
        });
    }

    /**
     * Register the Tapfiliate tool provider when the registry is available.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TapfiliateToolProvider());
        }
    }
}
