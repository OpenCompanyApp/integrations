<?php

namespace OpenCompany\Integrations\Eventbrite;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class EventbriteServiceProvider extends ServiceProvider
{
    /**
     * Register the Eventbrite service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(EventbriteService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new EventbriteService(
                token: $creds->get('eventbrite', 'token', ''),
                organizationId: $creds->get('eventbrite', 'organization_id', ''),
                baseUrl: $creds->get('eventbrite', 'url', 'https://www.eventbriteapi.com/v3'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new EventbriteToolProvider());
        }
    }
}
