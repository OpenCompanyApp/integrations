<?php

namespace OpenCompany\Integrations\Readwise;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Readwise integration with Laravel.
 *
 * Binds the Readwise API client from host credentials and registers the tool
 * provider with the shared registry when available.
 */
class ReadwiseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ReadwiseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ReadwiseService(
                accessToken: $creds->get('readwise', 'access_token', ''),
                baseUrl: $creds->get('readwise', 'url', 'https://readwise.io'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new ReadwiseToolProvider());
        }
    }
}
