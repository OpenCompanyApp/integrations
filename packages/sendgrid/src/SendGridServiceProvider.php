<?php

namespace OpenCompany\Integrations\Sendgrid;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SendGridServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SendGridService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SendGridService(
                apiKey: $creds->get('sendgrid', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SendGridToolProvider());
        }
    }
}
