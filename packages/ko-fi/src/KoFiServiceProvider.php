<?php

namespace OpenCompany\Integrations\KoFi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class KoFiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KoFiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KoFiService(
                accessToken: $creds->get('ko-fi', 'access_token', ''),
                baseUrl: $creds->get('ko-fi', 'url', 'https://ko-fi.com/api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KoFiToolProvider());
        }
    }
}
