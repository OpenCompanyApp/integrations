<?php

namespace OpenCompany\Integrations\EmailOctopus;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class EmailOctopusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EmailOctopusService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new EmailOctopusService(
                apiKey: $creds->get('email-octopus', 'api_key', ''),
                baseUrl: $creds->get('email-octopus', 'url', 'https://emailoctopus.com/api'),
                listId: $creds->get('email-octopus', 'list_id', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new EmailOctopusToolProvider());
        }
    }
}
