<?php

namespace OpenCompany\Integrations\Kintone;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class KintoneServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KintoneService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KintoneService(
                accessToken: $creds->get('kintone', 'access_token', ''),
                domain: $creds->get('kintone', 'domain', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KintoneToolProvider());
        }
    }
}
