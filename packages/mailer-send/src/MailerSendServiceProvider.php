<?php

namespace OpenCompany\Integrations\MailerSend;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MailerSendServiceProvider extends ServiceProvider
{
    /**
     * Register the MailerSend service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(MailerSendService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MailerSendService(
                apiToken: $creds->get('mailer-send', 'api_token', ''),
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
                ->register(new MailerSendToolProvider());
        }
    }
}
