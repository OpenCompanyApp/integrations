<?php

namespace OpenCompany\Integrations\Webex;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class WebexServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WebexService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WebexService(
                accessToken: $creds->get('webex', 'access_token', ''),
                baseUrl: $creds->get('webex', 'url', 'https://webexapis.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WebexToolProvider());
        }
    }
}
