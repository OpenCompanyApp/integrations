<?php

namespace OpenCompany\Integrations\Mailgun;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Mailgun integration.
 *
 * Registers the MailgunService singleton and bootstraps the Mailgun tool provider.
 */
class MailgunServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MailgunService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MailgunService(
                apiKey: $creds->get('mailgun', 'api_key', ''),
                domain: $creds->get('mailgun', 'domain', ''),
                baseUrl: $creds->get('mailgun', 'base_url', 'https://api.mailgun.net/v3'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MailgunToolProvider());
        }
    }
}
