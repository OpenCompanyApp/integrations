<?php

namespace OpenCompany\Integrations\Patreon;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PatreonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PatreonService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PatreonService(
                accessToken: $creds->get('patreon', 'access_token', ''),
                baseUrl: $creds->get('patreon', 'url', 'https://www.patreon.com/api/oauth2/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PatreonToolProvider());
        }
    }
}
