<?php

namespace OpenCompany\Integrations\AmazonSes;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class AmazonSesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AmazonSesService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AmazonSesService(
                accessToken: $creds->get('amazon-ses', 'access_token', ''),
                baseUrl: $creds->get('amazon-ses', 'url', 'https://email.us-east-1.amazonaws.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AmazonSesToolProvider());
        }
    }
}
