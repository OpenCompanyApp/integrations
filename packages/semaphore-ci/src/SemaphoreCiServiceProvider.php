<?php

namespace OpenCompany\Integrations\SemaphoreCi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Semaphore CI integration with Laravel.
 *
 * Binds the Semaphore API client from host credentials and registers the tool
 * provider when the shared registry is available.
 */
class SemaphoreCiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SemaphoreCiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SemaphoreCiService(
                apiToken: $creds->get('semaphore-ci', 'api_token', ''),
                baseUrl: $creds->get('semaphore-ci', 'url', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new SemaphoreCiToolProvider());
        }
    }
}
