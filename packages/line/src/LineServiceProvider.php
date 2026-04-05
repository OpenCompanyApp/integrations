<?php

namespace OpenCompany\Integrations\Line;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class LineServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LineService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LineService(
                accessToken: $creds->get('line', 'access_token', ''),
                baseUrl: $creds->get('line', 'url', 'https://api.line.me/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LineToolProvider());
        }
    }
}
