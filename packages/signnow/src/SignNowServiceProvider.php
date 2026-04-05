<?php

namespace OpenCompany\Integrations\SignNow;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SignNowServiceProvider extends ServiceProvider
{
    /**
     * Register the SignNow service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(SignNowService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SignNowService(
                accessToken: $creds->get('signnow', 'access_token', ''),
                baseUrl: $creds->get('signnow', 'url', 'https://api.signnow.com'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SignNowToolProvider());
        }
    }
}
