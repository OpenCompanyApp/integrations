<?php

namespace OpenCompany\Integrations\ElasticEmail;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers Elastic Email services and tools with Laravel hosts.
 */
class ElasticEmailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ElasticEmailService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ElasticEmailService(
                apiKey: $creds->get('elastic-email', 'api_key', ''),
                baseUrl: $creds->get('elastic-email', 'url', 'https://api.elasticemail.com/v4'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ElasticEmailToolProvider());
        }
    }
}
