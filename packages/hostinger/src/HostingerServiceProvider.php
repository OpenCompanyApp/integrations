<?php

namespace OpenCompany\Integrations\Hostinger;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class HostingerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HostingerService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HostingerService(
                accessToken: $creds->get('hostinger', 'access_token', ''),
                baseUrl: $creds->get('hostinger', 'url', 'https://developers.hostinger.com/api'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HostingerToolProvider());
        }
    }
}
