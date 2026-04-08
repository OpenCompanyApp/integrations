<?php

namespace OpenCompany\Integrations\Motion;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MotionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MotionService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MotionService(
                accessToken: $creds->get('motion', 'access_token', ''),
                baseUrl: $creds->get('motion', 'url', 'https://api.usemotion.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MotionToolProvider());
        }
    }
}
