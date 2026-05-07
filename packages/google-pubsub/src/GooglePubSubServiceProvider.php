<?php

namespace OpenCompany\Integrations\GooglePubSub;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Pub/Sub integration with Laravel's service container.
 *
 * Binds GooglePubSubService from host credentials and registers the generated
 * GooglePubSubToolProvider with the shared provider registry.
 */
class GooglePubSubServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GooglePubSubService::class, function ($app): GooglePubSubService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GooglePubSubService(accessToken: $creds?->get('google-pubsub', 'access_token', '') ?? '', baseUrl: $creds?->get('google-pubsub', 'url', 'https://pubsub.googleapis.com') ?? 'https://pubsub.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GooglePubSubToolProvider);
    }
}