<?php

namespace OpenCompany\Integrations\Lark;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class LarkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LarkService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LarkService(
                accessToken: $creds->get('lark', 'access_token', ''),
                baseUrl: $creds->get('lark', 'url', 'https://open.larksuite.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LarkToolProvider());
        }
    }
}
