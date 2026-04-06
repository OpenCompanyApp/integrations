<?php

namespace OpenCompany\Integrations\Loops;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class LoopsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LoopsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LoopsService(
                apiKey: $creds->get('loops', 'api_key', ''),
                baseUrl: $creds->get('loops', 'url', 'https://app.loops.so/api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LoopsToolProvider());
        }
    }
}
