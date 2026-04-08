<?php

namespace OpenCompany\Integrations\Mailjet;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MailjetServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MailjetService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MailjetService(
                apiKey: $creds->get('mailjet', 'api_key', ''),
                apiSecret: $creds->get('mailjet', 'api_secret', ''),
                baseUrl: $creds->get('mailjet', 'url', 'https://api.mailjet.com/v3'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MailjetToolProvider());
        }
    }
}
