<?php

namespace OpenCompany\Integrations\Baserow;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Baserow integration with Laravel's service container.
 *
 * Binds BaserowService with stored credentials and registers the tool provider
 * when the host exposes the integration registry.
 */
class BaserowServiceProvider extends ServiceProvider
{
    /**
     * Register the Baserow API client singleton.
     */
    public function register(): void
    {
        $this->app->singleton(BaserowService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BaserowService(
                accessToken: $creds->get('baserow', 'access_token', ''),
                baseUrl: $creds->get('baserow', 'url', 'https://api.baserow.io'),
                authScheme: $creds->get('baserow', 'auth_scheme', 'Token'),
            );
        });
    }

    /**
     * Register the Baserow tool provider with the host registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BaserowToolProvider());
        }
    }
}
