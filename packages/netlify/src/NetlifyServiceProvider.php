<?php

namespace OpenCompany\Integrations\Netlify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class NetlifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(NetlifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new NetlifyService(
                accessToken: $creds->get('netlify', 'access_token', ''),
                baseUrl: $creds->get('netlify', 'url', 'https://api.netlify.com/api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new NetlifyToolProvider());
        }
    }
}
