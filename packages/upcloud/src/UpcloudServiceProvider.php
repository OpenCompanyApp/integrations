<?php

namespace OpenCompany\Integrations\Upcloud;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class UpcloudServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UpcloudService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new UpcloudService(
                accessToken: $creds->get('upcloud', 'access_token', ''),
                baseUrl: $creds->get('upcloud', 'url', 'https://api.upcloud.com/1.3'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new UpcloudToolProvider());
        }
    }
}
