<?php

namespace OpenCompany\Integrations\Mailtrap;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MailtrapServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MailtrapService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MailtrapService(
                apiToken: $creds->get('mailtrap', 'api_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MailtrapToolProvider());
        }
    }
}
