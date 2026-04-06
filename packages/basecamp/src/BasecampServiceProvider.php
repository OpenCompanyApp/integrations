<?php

namespace OpenCompany\Integrations\Basecamp;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Basecamp 3 integration.
 *
 * Registers the BasecampService singleton and auto-discovers
 * the tool provider with the ToolProviderRegistry.
 */
class BasecampServiceProvider extends ServiceProvider
{
    /**
     * Register the BasecampService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(BasecampService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            $baseUrl = $creds->get('basecamp', 'url', 'https://3.basecampapi.com');
            $accountId = $creds->get('basecamp', 'account_id', '');

            return new BasecampService(
                accessToken: $creds->get('basecamp', 'access_token', ''),
                accountId: $accountId,
                baseUrl: $baseUrl,
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BasecampToolProvider());
        }
    }
}
