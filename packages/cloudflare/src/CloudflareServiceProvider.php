<?php

namespace OpenCompany\Integrations\Cloudflare;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CloudflareServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CloudflareService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CloudflareService(
                accessToken: $creds->get('cloudflare', 'access_token', ''),
                baseUrl: $creds->get('cloudflare', 'url', 'https://api.cloudflare.com/client/v4'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CloudflareToolProvider());
        }
    }
}
