<?php

namespace OpenCompany\Integrations\PandaDoc;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PandaDocServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PandaDocService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PandaDocService(
                accessToken: $creds->get('pandadoc', 'access_token', ''),
                baseUrl: $creds->get('pandadoc', 'url', 'https://api.pandadoc.com/public/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PandaDocToolProvider());
        }
    }
}
