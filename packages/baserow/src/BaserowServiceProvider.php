<?php

namespace OpenCompany\Integrations\Baserow;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Baserow integration.
 *
 * Registers the BaserowService singleton and bootstraps the Baserow tool provider.
 */
class BaserowServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BaserowService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BaserowService(
                apiToken: $creds->get('baserow', 'api_token', ''),
                baseUrl:  $creds->get('baserow', 'base_url', 'https://api.baserow.io/api'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BaserowToolProvider());
        }
    }
}
