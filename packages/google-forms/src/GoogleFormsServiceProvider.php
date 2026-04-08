<?php

namespace OpenCompany\Integrations\GoogleForms;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GoogleFormsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleFormsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoogleFormsService(
                accessToken: $creds->get('google-forms', 'access_token', ''),
                baseUrl: $creds->get('google-forms', 'url', 'https://forms.googleapis.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoogleFormsToolProvider());
        }
    }
}
