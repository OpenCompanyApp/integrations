<?php

namespace OpenCompany\Integrations\GoogleForms;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Forms integration with Laravel's service container.
 *
 * Binds GoogleFormsService from host credentials and registers the generated
 * GoogleFormsToolProvider with the shared provider registry.
 */
class GoogleFormsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleFormsService::class, function ($app): GoogleFormsService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleFormsService(accessToken: $creds?->get('google-forms', 'access_token', '') ?? '', baseUrl: $creds?->get('google-forms', 'url', 'https://forms.googleapis.com') ?? 'https://forms.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleFormsToolProvider);
    }
}
