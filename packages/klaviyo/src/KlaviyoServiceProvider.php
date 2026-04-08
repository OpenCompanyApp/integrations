<?php

namespace OpenCompany\Integrations\Klaviyo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the KlaviyoService singleton and bootstraps Klaviyo tools.
 */
class KlaviyoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KlaviyoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KlaviyoService(
                apiKey: $creds->get('klaviyo', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KlaviyoToolProvider());
        }
    }
}
