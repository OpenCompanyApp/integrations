<?php

namespace OpenCompany\Integrations\AmazonSes;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers Amazon SES services and tools with Laravel.
 */
class AmazonSesServiceProvider extends ServiceProvider
{
    /**
     * Register the signed Amazon SES service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(AmazonSesService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AmazonSesService(
                accessKeyId: $creds->get('amazon-ses', 'access_key_id', ''),
                secretAccessKey: $creds->get('amazon-ses', 'secret_access_key', ''),
                region: $creds->get('amazon-ses', 'region', 'us-east-1'),
                sessionToken: $creds->get('amazon-ses', 'session_token', ''),
                baseUrl: $creds->get('amazon-ses', 'url', ''),
            );
        });
    }

    /**
     * Register the Amazon SES tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AmazonSesToolProvider());
        }
    }
}
