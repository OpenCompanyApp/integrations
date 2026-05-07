<?php

namespace OpenCompany\Integrations\Mailgun;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Mailgun integration with Laravel's service container.
 *
 * Binds MailgunService with host-provided credentials and registers the tool
 * provider when the integration registry is available.
 */
class MailgunServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MailgunService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MailgunService(
                apiKey: (string) $creds->get('mailgun', 'api_key', ''),
                domain: (string) $creds->get('mailgun', 'domain', ''),
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