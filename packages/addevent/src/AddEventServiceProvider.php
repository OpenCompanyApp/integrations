<?php

namespace OpenCompany\Integrations\AddEvent;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class AddEventServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AddEventService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AddEventService(
                accessToken: $creds->get('addevent', 'access_token', ''),
                baseUrl: $creds->get('addevent', 'url', 'https://api.addevent.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AddEventToolProvider());
        }
    }
}
