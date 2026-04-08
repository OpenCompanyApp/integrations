<?php

namespace OpenCompany\Integrations\Aws;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class AwsServiceProvider extends ServiceProvider
{
    /**
     * Register the AWS service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(AwsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AwsService(
                accessToken: $creds->get('aws', 'access_token', ''),
                baseUrl: $creds->get('aws', 'base_url', 'https://api.aws.amazon.com'),
            );
        });
    }

    /**
     * Boot the service provider and register with the ToolProviderRegistry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AwsToolProvider());
        }
    }
}
