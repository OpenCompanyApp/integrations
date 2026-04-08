<?php

namespace OpenCompany\Integrations\Render2;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class RenderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RenderService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RenderService(
                apiKey: $creds->get('render2', 'api_key', ''),
                baseUrl: $creds->get('render2', 'url', 'https://api.render.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RenderToolProvider());
        }
    }
}
