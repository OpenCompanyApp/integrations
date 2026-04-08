<?php

namespace OpenCompany\Integrations\Whereby;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class WherebyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WherebyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WherebyService(
                accessToken: $creds->get('whereby', 'access_token', ''),
                baseUrl: $creds->get('whereby', 'url', 'https://api.whereby.dev/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WherebyToolProvider());
        }
    }
}
