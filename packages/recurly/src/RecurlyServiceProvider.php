<?php

namespace OpenCompany\Integrations\Recurly;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Recurly integration with Laravel's service container.
 *
 * Binds the Recurly service from stored credentials and registers the
 * tool provider with the shared registry when available.
 */
class RecurlyServiceProvider extends ServiceProvider
{
    /**
     * Register the Recurly service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(RecurlyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RecurlyService(
                apiKey: $creds->get('recurly', 'api_key', ''),
                subdomain: $creds->get('recurly', 'subdomain', ''),
            );
        });
    }

    /**
     * Boot the Recurly service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RecurlyToolProvider());
        }
    }
}
