<?php

namespace OpenCompany\Integrations\Fal;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FalService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FalService(
                apiKey: $creds->get('fal', 'api_key', ''),
                baseUrl: $creds->get('fal', 'url', 'https://queue.fal.run'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FalToolProvider());
        }
    }
}
