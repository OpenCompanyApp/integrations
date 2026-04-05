<?php

namespace OpenCompany\Integrations\Vimeo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class VimeoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VimeoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new VimeoService(
                accessToken: $creds->get('vimeo', 'access_token', ''),
                baseUrl: $creds->get('vimeo', 'url', 'https://api.vimeo.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new VimeoToolProvider());
        }
    }
}
