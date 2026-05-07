<?php

namespace OpenCompany\Integrations\GoogleContacts;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Contacts integration with Laravel's service container.
 *
 * Binds GoogleContactsService from host credentials and registers the generated
 * GoogleContactsToolProvider with the shared provider registry.
 */
class GoogleContactsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleContactsService::class, function ($app): GoogleContactsService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleContactsService(accessToken: $creds?->get('google-contacts', 'access_token', '') ?? '', baseUrl: $creds?->get('google-contacts', 'url', 'https://people.googleapis.com') ?? 'https://people.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleContactsToolProvider);
    }
}
