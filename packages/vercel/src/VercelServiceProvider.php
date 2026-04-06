<?php

namespace OpenCompany\Integrations\Vercel;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class VercelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VercelService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new VercelService(
                accessToken: $creds->get('vercel', 'access_token', ''),
                baseUrl: $creds->get('vercel', 'base_url', 'https://api.vercel.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new VercelToolProvider());
        }
    }
}
