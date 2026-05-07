<?php

namespace OpenCompany\Integrations\AddEvent;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the AddEvent Calendar and Events API integration.
 *
 * Binds the AddEventService with credentials from the host resolver and
 * registers the AddEvent tool provider when the registry is available.
 */
class AddEventServiceProvider extends ServiceProvider
{
    /**
     * Register the AddEventService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(AddEventService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AddEventService(
                accessToken: $creds->get('addevent', 'access_token', ''),
                baseUrl: $creds->get('addevent', 'url', 'https://api.addevent.com/calevent/v2'),
            );
        });
    }

    /**
     * Register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AddEventToolProvider());
        }
    }
}
