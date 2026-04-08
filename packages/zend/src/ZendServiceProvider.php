<?php

namespace OpenCompany\Integrations\Zend;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ZendServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZendService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZendService(
                accessToken: $creds->get('zend', 'access_token', ''),
                baseUrl: $creds->get('zend', 'url', 'https://api.zendesk.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZendToolProvider());
        }
    }
}
