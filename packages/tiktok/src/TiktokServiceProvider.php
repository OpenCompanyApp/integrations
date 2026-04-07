<?php

namespace OpenCompany\Integrations\TikTok;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TiktokServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TiktokService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TiktokService(
                accessToken: $creds->get('tiktok', 'access_token', ''),
                baseUrl: $creds->get('tiktok', 'base_url', 'https://business-api.tiktok.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TiktokToolProvider());
        }
    }
}
