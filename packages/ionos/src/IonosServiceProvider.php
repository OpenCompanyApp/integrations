<?php

namespace OpenCompany\Integrations\Ionos;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class IonosServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(IonosService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new IonosService(
                accessToken: $creds->get('ionos', 'access_token', ''),
                baseUrl: $creds->get('ionos', 'url', 'https://api.ionos.com/cloudapi/v6'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new IonosToolProvider());
        }
    }
}
