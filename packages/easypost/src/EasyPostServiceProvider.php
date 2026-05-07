<?php

namespace OpenCompany\Integrations\EasyPost;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the EasyPost integration with Laravel.
 *
 * Binds EasyPostService using host credentials and registers the tool provider
 * with the shared registry when available.
 */
class EasyPostServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EasyPostService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new EasyPostService(
                apiKey: $creds->get('easypost', 'api_key', ''),
                baseUrl: $creds->get('easypost', 'url', 'https://api.easypost.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new EasyPostToolProvider());
        }
    }
}
