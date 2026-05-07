<?php

namespace OpenCompany\Integrations\Beehiiv;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the beehiiv integration with Laravel's service container.
 */
class BeehiivServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BeehiivService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new BeehiivService($creds->get('beehiiv', 'api_key', ''), $creds->get('beehiiv', 'publication_id', ''), $creds->get('beehiiv', 'url', 'https://api.beehiiv.com/v2'));
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new BeehiivToolProvider);
        }
    }
}