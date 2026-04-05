<?php

namespace OpenCompany\Integrations\Bitbucket;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Bitbucket integration with Laravel's service container.
 *
 * Binds the BitbucketService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class BitbucketServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BitbucketService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new BitbucketService(
                apiKey: $creds->get('bitbucket', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BitbucketToolProvider());
        }
    }
}
