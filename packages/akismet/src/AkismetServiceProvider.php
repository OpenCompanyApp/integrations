<?php

namespace OpenCompany\Integrations\Akismet;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Akismet integration with Laravel's service container.
 *
 * Binds AkismetService using host credentials and registers AkismetToolProvider
 * with the shared ToolProviderRegistry during boot.
 */
class AkismetServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AkismetService::class, function ($app): AkismetService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new AkismetService(
                apiKey: $creds?->get('akismet', 'api_key', '') ?? '',
                blog: $creds?->get('akismet', 'blog', '') ?? '',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new AkismetToolProvider);
        }
    }
}
