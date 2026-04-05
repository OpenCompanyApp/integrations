<?php

namespace OpenCompany\Integrations\Mailchimp;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the MailchimpService singleton and bootstraps Mailchimp tools.
 */
class MailchimpServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MailchimpService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MailchimpService(
                apiKey: $creds->get('mailchimp', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MailchimpToolProvider());
        }
    }
}
