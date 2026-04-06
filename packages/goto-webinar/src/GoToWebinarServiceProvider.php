<?php

namespace OpenCompany\Integrations\GoToWebinar;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GoToWebinarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoToWebinarService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoToWebinarService(
                accessToken: $creds->get('goto-webinar', 'access_token', ''),
                baseUrl: $creds->get('goto-webinar', 'url', 'https://api.getgo.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoToWebinarToolProvider());
        }
    }
}
