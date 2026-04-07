<?php

namespace OpenCompany\Integrations\Zoom;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ZoomServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZoomService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZoomService(
                accessToken: $creds->get('zoom', 'access_token', ''),
                baseUrl: $creds->get('zoom', 'url', 'https://api.zoom.us/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZoomToolProvider());
        }
    }
}
