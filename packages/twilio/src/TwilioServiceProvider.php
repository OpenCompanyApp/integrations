<?php

namespace OpenCompany\Integrations\Twilio;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Twilio integration package.
 *
 * Registers the TwilioService as a singleton and bootstraps the tool provider.
 */
class TwilioServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TwilioService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TwilioService(
                accountSid: $creds->get('twilio', 'account_sid', ''),
                authToken: $creds->get('twilio', 'auth_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TwilioToolProvider());
        }
    }
}
