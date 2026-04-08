<?php

namespace OpenCompany\Integrations\MailerLite;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the MailerLite integration.
 *
 * Registers the MailerLiteService as a singleton and bootstraps
 * the tool provider into the integration registry.
 */
class MailerLiteServiceProvider extends ServiceProvider
{
    /**
     * Register MailerLite services into the container.
     */
    public function register(): void
    {
        $this->app->singleton(MailerLiteService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MailerLiteService(
                apiKey: $creds->get('mailerlite', 'api_key', ''),
            );
        });
    }

    /**
     * Boot the MailerLite tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MailerLiteToolProvider());
        }
    }
}
